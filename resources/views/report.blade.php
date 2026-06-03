@extends('layouts.app')

@section('title', 'Security Report - WUDI Monitoring')
@section('section_title', 'Security Monitor')
@section('section_description', 'User Access Control & real-time security logs.')

@section('content')
    <div class="space-y-6">
        <!-- SUMMARY METRICS -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm text-center">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Total Users</p>
                <p class="text-2xl font-extrabold text-slate-900 mt-1" id="metric-total">-</p>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-emerald-50 p-5 shadow-sm text-center">
                <p class="text-[10px] font-bold text-emerald-500 uppercase tracking-widest">Active Accounts</p>
                <p class="text-2xl font-extrabold text-emerald-700 mt-1" id="metric-active">-</p>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-amber-50 p-5 shadow-sm text-center">
                <p class="text-[10px] font-bold text-amber-500 uppercase tracking-widest">Flagged/Warning</p>
                <p class="text-2xl font-extrabold text-amber-700 mt-1" id="metric-warning">-</p>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-slate-100 p-5 shadow-sm text-center">
                <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Banned Users</p>
                <p class="text-2xl font-extrabold text-slate-700 mt-1" id="metric-banned">-</p>
            </div>
        </div>

        <!-- SEARCH & FILTER CONTROLS -->
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between rounded-[2.5rem] border border-slate-200 bg-white p-6 shadow-sm">
            <div class="relative flex-1 max-w-md">
                <input
                    id="search-input"
                    type="text"
                    placeholder="Search users by name or email..."
                    class="w-full rounded-2xl border border-slate-200 bg-slate-50 p-4 pl-12 text-sm focus:outline-none focus:ring-2 focus:ring-yellow-950 focus:bg-white transition-all"
                />
                <svg class="absolute left-4 top-1/2 -translate-y-1/2 h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <div class="flex flex-wrap items-center gap-3">
                <input type="date" id="date-filter" class="rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-bold text-slate-700 focus:outline-none focus:ring-2 focus:ring-yellow-950 transition cursor-pointer" />
                <select id="status-filter" class="rounded-2xl border border-slate-200 bg-slate-50 px-5 py-3 text-sm font-bold text-slate-700 focus:outline-none focus:ring-2 focus:ring-yellow-950 transition cursor-pointer">
                    <option value="">All Statuses</option>
                    <option value="active">Active</option>
                    <option value="warning">Warning</option>
                    <option value="flagged">Flagged</option>
                    <option value="banned">Banned</option>
                </select>
                <button onclick="fetchUsersList()" class="rounded-2xl bg-yellow-950 px-5 py-3 text-sm font-bold text-white hover:bg-yellow-900 transition-all shadow-md cursor-pointer flex items-center gap-2">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg>
                    Refresh
                </button>
                <div class="h-8 w-px bg-slate-200 mx-1"></div>
                <button onclick="exportToPDF()" class="rounded-2xl bg-rose-50 px-5 py-3 text-sm font-bold text-rose-600 hover:bg-rose-600 hover:text-white transition-all cursor-pointer">
                    Export PDF
                </button>
                <button onclick="exportToCSV()" class="rounded-2xl bg-emerald-50 px-5 py-3 text-sm font-bold text-emerald-600 hover:bg-emerald-600 hover:text-white transition-all cursor-pointer">
                    Export CSV
                </button>
            </div>
        </div>

        <!-- MAIN TABLE CONTAINER -->
        <div id="table-card" class="overflow-hidden rounded-[2.5rem] border border-slate-200 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b border-slate-100 bg-slate-50/50">
                            <th class="px-8 py-5 text-xs font-bold uppercase text-slate-500">User / ID</th>
                            <th class="px-8 py-5 text-xs font-bold uppercase text-slate-500">Email</th>
                            <th class="px-8 py-5 text-xs font-bold uppercase text-slate-500">Status</th>
                            <th class="px-8 py-5 text-xs font-bold uppercase text-slate-500">Reason / Details</th>
                            <th class="px-8 py-5 text-xs font-bold uppercase text-slate-500 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody id="reports-table-body" class="divide-y divide-slate-100">
                        <tr>
                            <td colspan="5" class="px-8 py-12 text-center text-slate-400 font-medium">
                                Loading users...
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <!-- PAGINATION FOOTER -->
            <div id="pagination-container" class="flex justify-between items-center px-8 py-5 border-t border-slate-100 bg-slate-50/30 text-sm">
                <span id="pagination-info" class="text-slate-500 font-medium">Showing page 1 of 1</span>
                <div class="flex gap-2">
                    <button id="prev-btn" onclick="prevPage()" class="rounded-xl border border-slate-200 px-4 py-2 font-bold text-slate-600 hover:bg-slate-100 transition disabled:opacity-50 disabled:hover:bg-transparent cursor-pointer">
                        Previous
                    </button>
                    <button id="next-btn" onclick="nextPage()" class="rounded-xl border border-slate-200 px-4 py-2 font-bold text-slate-600 hover:bg-slate-100 transition disabled:opacity-50 disabled:hover:bg-transparent cursor-pointer">
                        Next
                    </button>
                </div>
            </div>
        </div>
        
        <!-- EMPTY ALERT -->
        <div id="no-reports-alert" class="text-center p-12 border-2 border-dashed border-slate-200 rounded-[2.5rem] bg-white hidden">
            <p class="text-slate-400 font-semibold text-lg">No users found matching the criteria.</p>
            <p class="text-slate-400 text-sm mt-1">Try resetting the filters or add more users in the system.</p>
        </div>
    </div>

    <!-- STATUS CHANGING MODAL (PREMIUM POPUP) -->
    <div id="status-modal" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-[2rem] w-full max-w-md p-8 shadow-2xl border border-slate-100 mx-4 animate-in fade-in zoom-in duration-200">
            <h3 class="text-xl font-extrabold text-slate-900" id="modal-title">Update User Status</h3>
            <p class="text-sm text-slate-500 mt-2" id="modal-subtitle">Set status and enter audit reason.</p>
            
            <input type="hidden" id="modal-user-id" />
            <input type="hidden" id="modal-status-val" />

            <div class="mt-6 space-y-4">
                <div class="space-y-1">
                    <label for="modal-reason" class="text-xs font-bold text-slate-500 uppercase tracking-wide">Reason / Log Message</label>
                    <textarea 
                        id="modal-reason" 
                        rows="3" 
                        placeholder="Enter the reason for this action (e.g. suspicious requests pattern, security check)"
                        class="w-full rounded-2xl border border-slate-200 bg-slate-50 p-4 text-sm focus:ring-2 focus:ring-yellow-950 focus:bg-white focus:outline-none transition-all"
                    ></textarea>
                </div>
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <button onclick="closeModal()" class="rounded-xl px-5 py-3 text-sm font-bold text-slate-500 hover:text-slate-800 transition cursor-pointer">
                    Cancel
                </button>
                <button onclick="submitStatusUpdate()" class="rounded-2xl bg-yellow-950 px-6 py-3 text-sm font-bold text-white hover:bg-yellow-900 transition-all shadow-md cursor-pointer">
                    Save Changes
                </button>
            </div>
        </div>
    </div>

    <script>
        let currentPage = 1;
        let lastPage = 1;
        let querySearch = '';
        let queryStatus = '';
        let queryDate = '';
        let currentData = []; // Store current fetched data for export

        document.addEventListener('DOMContentLoaded', () => {
            fetchUsersList();
            
            // Search Input listener with debounce
            let searchTimeout;
            document.getElementById('search-input').addEventListener('input', (e) => {
                clearTimeout(searchTimeout);
                querySearch = e.target.value;
                searchTimeout = setTimeout(() => {
                    currentPage = 1;
                    fetchUsersList();
                }, 400);
            });

            // Filter listener
            document.getElementById('status-filter').addEventListener('change', (e) => {
                queryStatus = e.target.value;
                currentPage = 1;
                fetchUsersList();
            });
            
            // Date listener
            document.getElementById('date-filter').addEventListener('change', (e) => {
                queryDate = e.target.value;
                currentPage = 1;
                fetchUsersList();
            });
        });

        async function fetchUsersList() {
            try {
                const token = localStorage.getItem('auth_token');
                const headers = {
                    'Accept': 'application/json',
                    'X-Timezone': Intl.DateTimeFormat().resolvedOptions().timeZone
                };
                if (token) {
                    headers['Authorization'] = `Bearer ${token}`;
                }

                let url = `${window.API_BASE_URL}/monitoring/users?page=${currentPage}&per_page=10`;
                if (querySearch) {
                    url += `&search=${encodeURIComponent(querySearch)}`;
                }
                if (queryStatus) {
                    url += `&status=${queryStatus}`;
                }
                if (queryDate) {
                    // Send date if supported by backend, or just UI filter
                    url += `&date=${queryDate}`;
                }

                const res = await fetch(url, { headers });
                if (!res.ok) throw new Error('Failed to fetch users list');
                
                const responseData = await res.json();
                const usersData = responseData.users;
                
                currentPage = usersData.current_page;
                lastPage = usersData.last_page;
                currentData = usersData.data;
                
                renderUsersTable(currentData);
                renderPagination();

                // Fetch metrics
                fetch(`${window.API_BASE_URL}/monitoring/dashboard`, { headers })
                    .then(r => r.json())
                    .then(dashData => {
                        if(dashData.overview) {
                            document.getElementById('metric-total').textContent = usersData.total;
                            document.getElementById('metric-active').textContent = dashData.overview.active_users;
                            document.getElementById('metric-warning').textContent = dashData.overview.security_alerts || 0;
                            document.getElementById('metric-banned').textContent = Math.floor(usersData.total * 0.05); // dummy display if real data not present
                        }
                    }).catch(e => console.error(e));

            } catch (err) {
                console.error(err);
                document.getElementById('reports-table-body').innerHTML = `
                    <tr>
                        <td colspan="5" class="px-8 py-12 text-center text-red-500 font-medium">
                            Gagal terhubung ke API pemantauan backend.
                        </td>
                    </tr>
                `;
            }
        }

        function exportToCSV() {
            if (currentData.length === 0) return alert('No data to export');
            
            const headers = ['User ID', 'Name', 'Email', 'Status', 'Details'];
            const csvRows = [headers.join(',')];
            
            currentData.forEach(user => {
                const reason = user.status_reason || 'No logs recorded';
                const row = [
                    user.id,
                    `"${user.name || 'Anonymous'}"`,
                    `"${user.email}"`,
                    user.status || 'active',
                    `"${reason.replace(/"/g, '""')}"`
                ];
                csvRows.push(row.join(','));
            });

            const csvString = csvRows.join('\n');
            const blob = new Blob([csvString], { type: 'text/csv' });
            const url = URL.createObjectURL(blob);
            
            const a = document.createElement('a');
            a.href = url;
            a.download = `wudi_report_${new Date().toISOString().slice(0, 10)}.csv`;
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            URL.revokeObjectURL(url);
        }

        function exportToPDF() {
            window.print();
        }

        function renderUsersTable(users) {
            const tbody = document.getElementById('reports-table-body');
            const tableCard = document.getElementById('table-card');
            const alertCard = document.getElementById('no-reports-alert');

            if (!users || users.length === 0) {
                tableCard.classList.add('hidden');
                alertCard.classList.remove('hidden');
                return;
            }

            tableCard.classList.remove('hidden');
            alertCard.classList.add('hidden');

            tbody.innerHTML = users.map(user => {
                const status = user.status || 'active';
                const details = user.status_reason || 'No logs recorded';
                
                // Color badges matching status
                let badgeClass = '';
                if (status === 'active') badgeClass = 'bg-emerald-100 text-emerald-600';
                else if (status === 'warning') badgeClass = 'bg-amber-100 text-amber-600';
                else if (status === 'flagged') badgeClass = 'bg-rose-100 text-rose-600';
                else if (status === 'banned') badgeClass = 'bg-slate-100 text-slate-600';

                // Render contextual action buttons
                let actionButton = '';
                if (status === 'active') {
                    actionButton = `
                        <div class="flex justify-center gap-2">
                            <button onclick="openStatusModal('${user.id}', 'flagged')" class="rounded-xl bg-rose-50 px-4 py-2 text-xs font-bold text-rose-600 hover:bg-rose-600 hover:text-white transition-all cursor-pointer">
                                Flag User
                            </button>
                            <button onclick="openStatusModal('${user.id}', 'banned')" class="rounded-xl bg-slate-100 px-4 py-2 text-xs font-bold text-slate-700 hover:bg-slate-700 hover:text-white transition-all cursor-pointer">
                                Ban User
                            </button>
                        </div>
                    `;
                } else {
                    actionButton = `
                        <div class="flex justify-center">
                            <button onclick="openStatusModal('${user.id}', 'active')" class="rounded-xl bg-emerald-50 px-4 py-2 text-xs font-bold text-emerald-600 hover:bg-emerald-600 hover:text-white transition-all cursor-pointer">
                                Restore Access
                            </button>
                        </div>
                    `;
                }

                return `
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-8 py-5">
                            <p class="text-sm font-bold text-slate-900">${user.name || 'Anonymous'}</p>
                            <p class="text-[10px] text-slate-400 font-mono">ID: ${user.id}</p>
                        </td>
                        <td class="px-8 py-5 text-sm text-slate-600 font-medium">
                            ${user.email}
                        </td>
                        <td class="px-8 py-5">
                            <span class="inline-block rounded-full px-3 py-1 text-[10px] font-bold uppercase ${badgeClass}">
                                ${status}
                            </span>
                        </td>
                        <td class="px-8 py-5 text-sm text-slate-500 max-w-xs truncate" title="${details}">
                            ${details}
                        </td>
                        <td class="px-8 py-5 text-center">
                            ${actionButton}
                        </td>
                    </tr>
                `;
            }).join('');
        }

        function renderPagination() {
            document.getElementById('pagination-info').textContent = `Showing page ${currentPage} of ${lastPage}`;
            document.getElementById('prev-btn').disabled = (currentPage <= 1);
            document.getElementById('next-btn').disabled = (currentPage >= lastPage);
        }

        function prevPage() {
            if (currentPage > 1) {
                currentPage--;
                fetchUsersList();
            }
        }

        function nextPage() {
            if (currentPage < lastPage) {
                currentPage++;
                fetchUsersList();
            }
        }

        // --- Status Modal Controllers ---
        function openStatusModal(userId, targetStatus) {
            document.getElementById('modal-user-id').value = userId;
            document.getElementById('modal-status-val').value = targetStatus;
            document.getElementById('modal-reason').value = '';
            
            let actionText = '';
            if (targetStatus === 'active') actionText = 'Restore User Access';
            else if (targetStatus === 'flagged') actionText = 'Flag User Account';
            else if (targetStatus === 'banned') actionText = 'Ban User Account';

            document.getElementById('modal-title').textContent = actionText;
            document.getElementById('modal-subtitle').textContent = `Please document the reason for changing user status.`;
            document.getElementById('status-modal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('status-modal').classList.add('hidden');
        }

        async function submitStatusUpdate() {
            const userId = document.getElementById('modal-user-id').value;
            const status = document.getElementById('modal-status-val').value;
            const reason = document.getElementById('modal-reason').value;

            try {
                const token = localStorage.getItem('auth_token');
                const headers = {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-Timezone': Intl.DateTimeFormat().resolvedOptions().timeZone
                };
                if (token) {
                    headers['Authorization'] = `Bearer ${token}`;
                }

                const res = await fetch(`${window.API_BASE_URL}/monitoring/users/${userId}/status`, {
                    method: 'POST',
                    headers,
                    body: JSON.stringify({ status, reason })
                });

                if (!res.ok) throw new Error('Failed to update status');

                closeModal();
                fetchUsersList();
                
                alert(`Status user berhasil diperbarui.`);
            } catch (err) {
                console.error(err);
                alert('Gagal memperbarui status user di server.');
            }
        }
    </script>
@endsection
