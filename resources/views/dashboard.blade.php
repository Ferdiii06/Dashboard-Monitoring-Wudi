@extends('layouts.app')

@section('title', 'Dashboard - WUDI Monitoring')

@section('content')
    <!-- Hide the default header to render high-fidelity mockup header -->
    <style>
        #layout-header {
            display: none !important;
        }
    </style>

    <!-- HIGH-FIDELITY DASHBOARD HEADER -->
    <div class="mb-8 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between relative">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Dashboard</h1>
        </div>
        
        <div class="flex flex-wrap items-center gap-4">
            <!-- Search Bar -->
            <div class="relative min-w-[240px]">
                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </span>
                <input 
                    type="text" 
                    id="header-search-input"
                    placeholder="Search users..." 
                    class="w-full rounded-full border border-slate-200 bg-white py-2.5 pl-10 pr-4 text-sm text-slate-800 placeholder-slate-400 shadow-sm focus:border-yellow-950/30 focus:outline-none focus:ring-2 focus:ring-yellow-950/10 transition"
                />
            </div>


            <!-- Notification Bell Icon Button -->
            <button 
                id="notification-bell-btn"
                onclick="toggleNotificationDropdown(event)"
                class="relative flex h-10 w-10 items-center justify-center rounded-full border border-slate-200 bg-white text-slate-600 shadow-sm hover:bg-slate-50 transition cursor-pointer focus:outline-none"
            >
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
                <span id="notification-unread-badge" class="absolute top-1 right-1 h-3.5 w-3.5 rounded-full bg-red-500 text-[8px] font-bold text-white flex items-center justify-center hidden">0</span>
            </button>

            <!-- Chat/Comments Icon Button -->
            <button 
                id="ai-chat-btn"
                onclick="toggleAiAssistantDrawer(event)"
                class="flex h-10 w-10 items-center justify-center rounded-full border border-slate-200 bg-white text-slate-600 shadow-sm hover:bg-slate-50 transition cursor-pointer focus:outline-none"
            >
                <img class="h-6 w-6 object-contain" src="/Logo.png" alt="AI Assistant" />
            </button>

            <!-- User Header Profile Avatar -->
            <a href="/settings" class="h-10 w-10 rounded-full border-2 border-[#3c2a21]/20 bg-yellow-950 text-white flex items-center justify-center font-bold text-xs shadow-sm overflow-hidden" id="header-avatar-container">
                <span id="header-avatar-initials">WA</span>
                <img id="header-avatar-img" class="h-full w-full object-cover rounded-full hidden" src="" alt="Avatar" />
            </a>
        </div>
    </div>

    <!-- MAIN TWO-COLUMN DASHBOARD GRID -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- LEFT COLUMN (2/3 width on Desktop): OVERVIEW & PERFORMANCE CHART -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- OVERVIEW CONTAINER -->
            <div class="rounded-[2.5rem] border border-slate-200 bg-white p-8 shadow-sm">
                <!-- Overview Header -->
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-slate-900">Overview</h2>
                    <div class="relative">
                        <select id="overview-filter" class="appearance-none bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 pr-8 text-xs font-bold text-slate-600 focus:outline-none cursor-pointer">
                            <option value="Today" selected>Today</option>
                            <option value="Last 7 days">Last 7 days</option>
                            <option value="Last month">Last month</option>
                        </select>
                        <span class="absolute inset-y-0 right-3 flex items-center pointer-events-none text-slate-400">
                            <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </span>
                    </div>
                </div>

                <!-- Metrics Subcards -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <!-- Card 1: Active Users -->
                    <div class="rounded-3xl border border-slate-100 bg-slate-50/50 p-6 flex flex-col justify-between">
                        <div class="flex items-center gap-3">
                            <div class="h-8 w-8 rounded-full bg-emerald-50 flex items-center justify-center text-emerald-600">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Active Users</span>
                        </div>
                        <div class="mt-4 flex items-baseline gap-3">
                            <h3 id="active-users" class="text-4xl font-extrabold text-slate-900 tracking-tight">0</h3>
                            <!-- Percentage Trend Badge -->
                            <span id="active-users-trend" class="inline-flex items-center gap-1 rounded-full px-2.5 py-1 text-xs font-extrabold transition-all duration-300">
                                <!-- arrow and text inserted by JS -->
                            </span>
                        </div>
                        <p class="mt-2 text-xs text-slate-400" id="active-users-trend-label">vs last month</p>
                    </div>

                    <!-- Card 2: Total API Requests -->
                    <div class="rounded-3xl border border-slate-100 bg-slate-50/50 p-6 flex flex-col justify-between">
                        <div class="flex items-center gap-3">
                            <div class="h-8 w-8 rounded-full bg-[#3c2a21]/5 flex items-center justify-center text-[#3c2a21]">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                            </div>
                            <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Total Interactions</span>
                        </div>
                        <div class="mt-4 flex items-baseline gap-3">
                            <h3 id="total-interactions" class="text-4xl font-extrabold text-slate-900 tracking-tight">0</h3>
                            <!-- Percentage Trend Badge -->
                            <span id="api-requests-trend" class="inline-flex items-center gap-1 rounded-full px-2.5 py-1 text-xs font-extrabold transition-all duration-300">
                                <!-- arrow and text inserted by JS -->
                            </span>
                        </div>
                        <p class="mt-2 text-xs text-slate-400" id="api-requests-trend-label">vs last month</p>
                    </div>

                </div>

                <!-- New Customers/Agents section at bottom of Overview -->
                <div class="mt-8 pt-6 border-t border-slate-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h4 class="text-sm font-extrabold text-slate-900">New Joined Users</h4>
                        <p class="text-xs text-slate-400 mt-0.5">Latest user registrations in Wudi.</p>
                        
                        <div class="mt-4 flex items-center gap-3">
                            <div class="flex -space-x-2" id="overview-avatars-row">
                                <!-- Avatars generated dynamically -->
                            </div>
                            <div class="text-xs font-bold text-slate-500" id="overview-avatars-summary">
                                <!-- Summary text generated dynamically -->
                            </div>
                        </div>
                    </div>
                    <div class="shrink-0 flex items-center sm:mt-6" id="security-status-badge-container">
                        <!-- Dynamic Security Pill Badge -->
                    </div>
                </div>
            </div>

            <!-- PERFORMANCE / PRODUCT VIEW CHART CONTAINER -->
            <div class="rounded-[2.5rem] border border-slate-200 bg-white p-8 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-bold text-slate-900" id="chart-title">Sistem Traffic Analytics</h2>
                    <div class="relative">
                        <select id="chart-filter" class="appearance-none bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 pr-8 text-xs font-bold text-slate-600 focus:outline-none cursor-pointer">
                            <option value="last_7_days">Last 7 days</option>
                            <option value="this_month">This month</option>
                        </select>
                        <span class="absolute inset-y-0 right-3 flex items-center pointer-events-none text-slate-400">
                            <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </span>
                    </div>
                </div>

                <!-- Big Request Value -->
                <div class="mb-6">
                    <span class="text-3xl font-extrabold text-slate-950 tracking-tight" id="chart-main-value">0 Requests</span>
                </div>

                <!-- Bar Chart Wrapper -->
                <div class="relative mt-8 flex items-end justify-between gap-3 h-48 border-b border-slate-100 pb-2" id="chart-bars-container">
                    <!-- Grid background lines -->
                    <div class="absolute inset-x-0 bottom-12 border-t border-slate-100/80"></div>
                    <div class="absolute inset-x-0 bottom-24 border-t border-slate-100/80"></div>
                    <div class="absolute inset-x-0 bottom-36 border-t border-slate-100/80"></div>
                </div>
                <!-- X-Axis Labels -->
                <div class="flex justify-between mt-2 px-1 text-[10px] font-bold text-slate-400" id="chart-labels-container">
                    <!-- Labels by JS -->
                </div>
            </div>
        </div>

        <!-- RIGHT COLUMN (1/3 width on Desktop): POPULAR PRODUCTS & RECENT COMMENTS -->
        <div class="space-y-6">
            
            <!-- MONITORED USERS CONTAINER -->
            <div class="rounded-[2.5rem] border border-slate-200 bg-white p-8 shadow-sm">
                <h2 class="text-xl font-bold text-slate-900 mb-6">Recently Joined Users</h2>
                
                <!-- Users List -->
                <div id="monitored-users-list" class="space-y-4">
                    <div class="text-center py-8 text-slate-400 text-xs font-medium">
                        Loading users...
                    </div>
                </div>

                <div class="mt-6">
                    <a href="/report" class="block w-full text-center rounded-2xl border border-slate-200 bg-white py-3 text-xs font-extrabold text-slate-800 hover:bg-slate-50 transition cursor-pointer shadow-sm">
                        View All Users
                    </a>
                </div>
            </div>

            <!-- COMMENTS / RECENT AUDIT LOGS CONTAINER -->
            <div class="rounded-[2.5rem] border border-slate-200 bg-white p-8 shadow-sm">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-slate-900">System Activity Reports</h2>
                    <button id="clear-logs" class="text-xs font-bold text-slate-400 hover:text-slate-600 transition cursor-pointer">Clear</button>
                </div>

                <!-- Audit Log Items / Comment List -->
                <div id="security-logs-container" class="space-y-4 max-h-[300px] overflow-y-auto pr-1 no-scrollbar">
                    <div class="text-center py-8 text-slate-400 text-xs font-medium">
                        Loading reports...
                    </div>
                </div>
            </div>

        </div>

    </div>

    <!-- Notification Dropdown -->
    <div id="notification-dropdown" class="absolute right-12 top-20 w-80 bg-white rounded-[2rem] border border-slate-200 shadow-2xl p-6 hidden z-50 animate-in fade-in slide-in-from-top-2 duration-200">
        <div class="flex items-center justify-between mb-4 pb-2 border-b border-slate-100">
            <h4 class="text-sm font-extrabold text-slate-900">Notifications</h4>
            <button onclick="markAllNotificationsRead()" class="text-[10px] font-bold text-yellow-900 hover:underline border-0 bg-transparent cursor-pointer">Mark all read</button>
        </div>
        <div id="notification-items-list" class="space-y-3 max-h-60 overflow-y-auto no-scrollbar">
            <div class="text-center py-6 text-slate-400 text-xs font-medium">No notifications.</div>
        </div>
    </div>

    <!-- WUDI AI Assistant Drawer -->
    <div id="ai-assistant-drawer" class="fixed inset-y-0 right-0 w-96 bg-white border-l border-slate-200 z-50 translate-x-full shadow-2xl flex flex-col transition-transform duration-300">
        <div class="p-6 border-b border-slate-100 flex items-center justify-between bg-[#fff8e7]/50">
            <div class="flex items-center gap-3">
                <div class="h-10 w-10 rounded-xl flex items-center justify-center shadow-md">
                    <img class="h-6 w-6 object-contain" src="/Logo.png" alt="Wudi AI Logo" />
                </div>
                <div>
                    <h3 class="text-sm font-extrabold text-slate-900">Wudi AI Assistant</h3>
                    <p class="text-[10px] text-emerald-600 font-bold mt-0.5">• Online Helper</p>
                </div>
            </div>
            <button onclick="toggleAiAssistantDrawer(event)" class="text-slate-400 hover:text-slate-600 transition text-xl font-bold bg-transparent border-0 cursor-pointer focus:outline-none">&times;</button>
        </div>
        
        <!-- Chat body -->
        <div id="ai-chat-body" class="flex-1 p-6 overflow-y-auto space-y-4 no-scrollbar">
            <div class="flex gap-2 items-start">
                <div class="h-7 w-7 rounded-lg flex items-center justify-center shrink-0 shadow-sm">
                    <img class="h-4 w-4 object-contain" src="/Logo.png" alt="Wudi AI Logo" />
                </div>
                <div class="bg-slate-50 text-slate-700 text-xs p-3 rounded-2xl rounded-tl-none leading-relaxed max-w-[80%]">
                    Hello! I am Wudi AI Assistant. How can I help you manage your dashboard today?
                </div>
            </div>
        </div>
        
        <!-- Chat input -->
        <div class="p-4 border-t border-slate-100 bg-slate-50/50">
            <form onsubmit="sendAiMessage(event)" class="flex gap-2">
                <input id="ai-message-input" type="text" placeholder="Type a message..." required class="flex-1 rounded-full border border-slate-200 bg-white px-4 py-2.5 text-xs text-slate-800 focus:ring-2 focus:ring-yellow-950 focus:outline-none transition-all" />
                <button type="submit" class="h-9 w-9 rounded-full bg-[#3c2a21] text-[#fff8e7] flex items-center justify-center hover:bg-[#2a1d17] transition border-0 shrink-0 cursor-pointer">
                    <svg class="h-4 w-4 transform rotate-90" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                    </svg>
                </button>
            </form>
        </div>
    </div>

    <!-- Drawer backdrop overlay -->
    <div id="ai-assistant-backdrop" class="fixed inset-0 bg-slate-900/20 backdrop-blur-sm z-40 hidden cursor-pointer" onclick="toggleAiAssistantDrawer(event)"></div>

    <!-- Page data fetching and synchronization -->
    <script>
        // Store dashboard data globally for filters
        window.dashboardData = null;

        // Set dynamic initials in the dashboard header avatar
        window.addEventListener('user-data-loaded', (e) => {
            const user = e.detail;
            if (user) {
                const initialsEl = document.getElementById('header-avatar-initials');
                if (initialsEl) {
                    const parts = user.name.split(' ');
                    const initials = parts.map(p => p[0]).join('').slice(0, 2).toUpperCase();
                    initialsEl.textContent = initials || 'WA';
                }

                if (user.avatar_url) {
                    const imgEl = document.getElementById('header-avatar-img');
                    if (imgEl) {
                        imgEl.src = user.avatar_url;
                        imgEl.classList.remove('hidden');
                        if (initialsEl) initialsEl.classList.add('hidden');
                    }
                }
            }
        });

        function formatNumber(num) {
            if (num === undefined || num === null) return '0';
            if (num >= 1000000) {
                return (num / 1000000).toFixed(1).replace(/\.0$/, '') + 'm';
            }
            if (num >= 1000) {
                return (num / 1000).toFixed(1).replace(/\.0$/, '') + 'k';
            }
            return num.toLocaleString();
        }

        function updateOverviewCards(range) {
            const data = window.dashboardData;
            if (!data) return;

            const activeEl = document.getElementById('active-users');
            const interactionsEl = document.getElementById('total-interactions');
            const activeTrendEl = document.getElementById('active-users-trend');
            const activeTrendLabel = document.getElementById('active-users-trend-label');
            const apiTrendEl = document.getElementById('api-requests-trend');
            const apiTrendLabel = document.getElementById('api-requests-trend-label');

            let activeVal = 0;
            let interactionVal = 0;
            let activeGrowth = 0;
            let interactionGrowth = 0;

            if (range === 'Today') {
                activeVal = data.active_users?.daily ?? 0;
                interactionVal = data.api?.requests_today ?? 0;
                activeGrowth = data.active_users?.trends?.today ?? 0;
                interactionGrowth = data.api?.trends?.today ?? 0;

                if (activeTrendLabel) activeTrendLabel.textContent = 'vs yesterday';
                if (apiTrendLabel) apiTrendLabel.textContent = 'vs yesterday';
            } else if (range === 'Last 7 days') {
                activeVal = Math.round((data.active_users?.monthly ?? 0) / 2);
                interactionVal = data.charts?.last_7_days 
                    ? data.charts.last_7_days.reduce((acc, curr) => acc + (curr.requests || 0), 0) 
                    : 0;
                activeGrowth = data.active_users?.trends?.last_7_days ?? 0;
                interactionGrowth = data.api?.trends?.last_7_days ?? 0;

                if (activeTrendLabel) activeTrendLabel.textContent = 'vs prev week';
                if (apiTrendLabel) apiTrendLabel.textContent = 'vs prev week';
            } else { // Last month
                activeVal = data.active_users?.monthly ?? 0;
                interactionVal = data.charts?.this_month 
                    ? data.charts.this_month.reduce((acc, curr) => acc + (curr.requests || 0), 0) 
                    : 0;
                activeGrowth = data.active_users?.trends?.last_month ?? 0;
                interactionGrowth = data.api?.trends?.last_month ?? 0;

                if (activeTrendLabel) activeTrendLabel.textContent = 'vs last month';
                if (apiTrendLabel) apiTrendLabel.textContent = 'vs last month';
            }

            if (activeEl) activeEl.textContent = formatNumber(activeVal);
            if (interactionsEl) interactionsEl.textContent = formatNumber(interactionVal);

            updateTrendBadge(activeTrendEl, activeGrowth);
            updateTrendBadge(apiTrendEl, interactionGrowth);
        }

        function updateTrendBadge(el, growth) {
            if (!el) return;
            const isPositive = growth >= 0;
            el.className = `inline-flex items-center gap-1 rounded-full px-2.5 py-1 text-xs font-extrabold ${
                isPositive ? 'bg-emerald-50 text-emerald-600' : 'bg-rose-50 text-rose-600'
            }`;
            el.innerHTML = `
                <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                    ${isPositive 
                        ? '<path stroke-linecap="round" stroke-linejoin="round" d="M5 11l7-7 7 7M5 19l7-7 7 7" />' 
                        : '<path stroke-linecap="round" stroke-linejoin="round" d="M19 13l-7 7-7-7m14-6l-7 7-7-7" />'
                    }
                </svg>
                ${isPositive ? '+' : ''}${growth}%
            `;
        }

        function renderChart(series) {
            const container = document.getElementById('chart-bars-container');
            const labelsContainer = document.getElementById('chart-labels-container');
            if (!container || !labelsContainer || !series || series.length === 0) return;

            // Clear previous elements keep grid lines
            container.innerHTML = `
                <!-- Grid background lines -->
                <div class="absolute inset-x-0 bottom-12 border-t border-slate-100/80"></div>
                <div class="absolute inset-x-0 bottom-24 border-t border-slate-100/80"></div>
                <div class="absolute inset-x-0 bottom-36 border-t border-slate-100/80"></div>
            `;
            labelsContainer.innerHTML = '';

            const maxVal = Math.max(...series.map(d => d.requests || 0), 1);
            const totalRequests = series.reduce((acc, curr) => acc + (curr.requests || 0), 0);

            // Set main value header
            const chartValEl = document.getElementById('chart-main-value');
            if (chartValEl) {
                chartValEl.textContent = formatNumber(totalRequests) + ' Requests';
            }

            // Loop through series up to 8 elements for perfect layout spacing
            const items = series.slice(-8); 
            items.forEach((item, index) => {
                const reqCount = item.requests || 0;
                const pct = (reqCount / maxVal) * 90; // scale to 90% max height
                
                const isMax = reqCount === maxVal && reqCount > 0;
                const barClass = isMax 
                    ? 'bg-[#22c55e]' 
                    : 'bg-[#3c2a21]/20 hover:bg-[#3c2a21]/40 transition-all duration-300 cursor-pointer';

                // Create bar wrapper
                const barDiv = document.createElement('div');
                barDiv.className = `flex-1 relative rounded-t-xl transition-all duration-300 cursor-pointer ${barClass}`;
                barDiv.style.height = `${Math.max(pct, 8)}%`;
                barDiv.title = `${item.label}: ${reqCount.toLocaleString()} requests`;

                // If max, show floating tooltip
                if (isMax) {
                    barDiv.innerHTML = `
                        <div class="absolute -top-10 left-1/2 -translate-x-1/2 bg-slate-900 text-white text-[10px] font-bold px-2 py-1 rounded shadow-md whitespace-nowrap z-10">
                            ${formatNumber(reqCount)}
                            <span class="absolute top-full left-1/2 -translate-x-1/2 border-4 border-transparent border-t-slate-900"></span>
                        </div>
                    `;
                }

                container.appendChild(barDiv);

                // Add label
                const lblSpan = document.createElement('span');
                lblSpan.className = 'flex-1 text-center truncate';
                lblSpan.textContent = item.label;
                labelsContainer.appendChild(lblSpan);
            });
        }

        async function fetchDashboardData() {
            try {
                const token = localStorage.getItem('auth_token');
                const headers = { 'Accept': 'application/json' };
                if (token) {
                    headers['Authorization'] = `Bearer ${token}`;
                }

                const res = await fetch(window.API_BASE_URL + '/monitoring/dashboard', { headers });
                if (!res.ok) throw new Error('Failed to fetch dashboard data');
                const data = await res.json();
                window.dashboardData = data;

                // Sync current selection for overview cards
                const overviewFilter = document.getElementById('overview-filter');
                if (overviewFilter) {
                    updateOverviewCards(overviewFilter.value);
                } else {
                    updateOverviewCards('Today');
                }

                // Sync chart view
                const chartFilter = document.getElementById('chart-filter');
                if (chartFilter) {
                    if (chartFilter.value === 'last_7_days') {
                        renderChart(data.charts?.last_7_days || []);
                    } else {
                        renderChart(data.charts?.this_month || []);
                    }
                }
            } catch (err) {
                console.error(err);
            }
        }

        async function fetchUsersList(searchQuery = '') {
            try {
                const token = localStorage.getItem('auth_token');
                const headers = { 'Accept': 'application/json' };
                if (token) {
                    headers['Authorization'] = `Bearer ${token}`;
                }
                const url = window.API_BASE_URL + '/monitoring/users?per_page=5&sort=created_at' + (searchQuery ? '&search=' + encodeURIComponent(searchQuery) : '');
                const res = await fetch(url, { headers });
                if (!res.ok) throw new Error('Failed to fetch users list');
                const data = await res.json();
                const users = data.users?.data || [];

                // Render Monitored Users Card
                const usersListContainer = document.getElementById('monitored-users-list');
                if (usersListContainer) {
                    if (users.length === 0) {
                        usersListContainer.innerHTML = `
                            <div class="text-center py-8 text-slate-400 text-xs font-medium">
                                No monitored users found.
                            </div>
                        `;
                    } else {
                        usersListContainer.innerHTML = users.map(user => {
                            const name = user.name || 'Wudi User';
                            const initials = name.split(' ').map(p => p[0]).join('').slice(0, 2).toUpperCase();
                            
                            // Status styles
                            let statusClass = 'text-emerald-500 bg-emerald-50';
                            if (user.status === 'warning') statusClass = 'text-amber-500 bg-amber-50';
                            if (user.status === 'flagged') statusClass = 'text-orange-500 bg-orange-50';
                            if (user.status === 'banned') statusClass = 'text-rose-500 bg-rose-50';

                            // Format date
                            const joinedDate = user.created_at ? new Date(user.created_at).toLocaleDateString('id-ID', { month: 'short', year: 'numeric' }) : 'Unknown';

                            return `
                                <div class="flex items-center justify-between py-2.5 border-b border-slate-100 last:border-0">
                                    <div class="flex items-center gap-3">
                                        <div class="h-10 w-10 rounded-xl bg-yellow-950/10 flex items-center justify-center text-yellow-950 font-extrabold text-xs shadow-sm shrink-0">
                                            ${initials}
                                        </div>
                                        <div class="min-w-0">
                                            <h4 class="text-xs font-bold text-slate-800 leading-tight truncate">${name}</h4>
                                            <p class="text-[10px] text-slate-400 truncate mt-0.5">${user.email}</p>
                                        </div>
                                    </div>
                                    <div class="text-right shrink-0">
                                        <p class="text-[9px] font-bold text-slate-400">Joined ${joinedDate}</p>
                                        <span class="inline-block mt-0.5 text-[8px] font-extrabold uppercase tracking-wider ${statusClass} px-1.5 py-0.5 rounded-full">${user.status || 'active'}</span>
                                    </div>
                                </div>
                            `;
                        }).join('');
                    }
                }

                // Render Overview Profiles Section (bottom of overview card)
                const avatarsRow = document.getElementById('overview-avatars-row');
                const avatarsSummary = document.getElementById('overview-avatars-summary');
                if (avatarsRow && avatarsSummary) {
                    if (users.length === 0) {
                        avatarsRow.innerHTML = '';
                        avatarsSummary.innerHTML = '<span class="text-slate-400">No active users online.</span>';
                    } else {
                        const subset = users.slice(0, 5);
                        avatarsRow.innerHTML = subset.map((user, i) => {
                            const name = user.name || 'Wudi User';
                            const initials = name.split(' ').map(p => p[0]).join('').slice(0, 2).toUpperCase();
                            return `
                                <div class="h-8 w-8 rounded-full border-2 border-white bg-[#3c2a21] text-white flex items-center justify-center text-[10px] font-bold shadow-sm" title="${name}">
                                    ${initials}
                                </div>
                            `;
                        }).join('');

                        const namesStr = subset.map(user => (user.name || 'User').split(' ')[0]).join(', ');
                        const remaining = users.length - subset.length;
                        let summaryHtml = `Active now: <span class="text-slate-700 font-extrabold">${namesStr}</span>`;
                        if (remaining > 0) {
                            summaryHtml += ` <span class="text-slate-400 font-medium">(+${remaining} others)</span>`;
                        }

                        // Add navigation link button next to summary
                        summaryHtml += `
                            <a href="/report" class="inline-flex h-6 w-6 items-center justify-center rounded-full border border-slate-200 bg-white text-slate-600 hover:bg-slate-50 transition ml-2 shadow-sm align-middle">
                                <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        `;
                        avatarsSummary.innerHTML = summaryHtml;
                    }
                }
            } catch (err) {
                console.error('fetchUsersList error:', err);
            }
        }

        async function fetchActivityLogs() {
            try {
                const token = localStorage.getItem('auth_token');
                const headers = { 'Accept': 'application/json' };
                if (token) {
                    headers['Authorization'] = `Bearer ${token}`;
                }
                const res = await fetch(window.API_BASE_URL + '/monitoring/activity', { headers });
                if (!res.ok) throw new Error('Failed to fetch activity logs');
                const data = await res.json();
                
                const auditLogs = data.audit || [];
                const logsContainer = document.getElementById('security-logs-container');
                if (logsContainer) {
                    if (auditLogs.length === 0) {
                        logsContainer.innerHTML = `
                            <div class="text-center py-8 text-slate-400 text-xs font-medium">
                                No recent activity reports.
                            </div>
                        `;
                    } else {
                        logsContainer.innerHTML = auditLogs.slice(0, 10).map(item => {
                            const dateObj = new Date(item.occurred_at || item.created_at);
                            const timeStr = dateObj.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
                            
                            const actorName = item.actor?.name || 'System';
                            const initials = actorName.split(' ').map(p => p[0]).join('').slice(0, 2).toUpperCase();
                            
                            let iconBg = 'bg-yellow-950/10 text-yellow-950';
                            if (actorName === 'System') {
                                iconBg = 'bg-[#3c2a21]/15 text-[#3c2a21]';
                            }
                            
                            const actionText = item.action || 'System action executed';

                            return `
                                <div class="flex gap-3 items-start py-2.5 border-b border-slate-100 last:border-0">
                                    <div class="h-8 w-8 rounded-xl ${iconBg} flex items-center justify-center font-extrabold text-[10px] shrink-0 shadow-sm">
                                        ${initials}
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-baseline justify-between">
                                            <h5 class="text-xs font-bold text-[#3c2a21] capitalize truncate pr-2" title="${actionText}">${actionText}</h5>
                                            <span class="text-[9px] font-bold text-slate-400 shrink-0">${timeStr}</span>
                                        </div>
                                        <p class="mt-0.5 text-[10px] text-slate-500 leading-relaxed truncate">
                                            Actor: <span class="font-semibold text-slate-700">${actorName}</span> | IP: ${item.ip_address || 'Internal'}
                                        </p>
                                    </div>
                                </div>
                            `;
                        }).join('');
                    }
                }
            } catch (err) {
                console.error('fetchActivityLogs error:', err);
            }
        }

        // Global variables for Header actions
        let isNotifOpen = false;
        let isAiOpen = false;

        // 2. Notification Dropdown Methods
        window.toggleNotificationDropdown = async function(e) {
            e.stopPropagation();
            const dropdown = document.getElementById('notification-dropdown');
            if (isNotifOpen) {
                dropdown.classList.add('hidden');
                isNotifOpen = false;
            } else {
                dropdown.classList.remove('hidden');
                isNotifOpen = true;
                // Fetch latest notifications
                await loadNotifications();
            }
        };
        
        async function loadNotifications() {
            try {
                const token = localStorage.getItem('auth_token');
                const headers = { 'Accept': 'application/json' };
                if (token) headers['Authorization'] = `Bearer ${token}`;

                const res = await fetch(window.API_BASE_URL + '/notifications', { headers });
                if (!res.ok) throw new Error('Failed to fetch notifications');
                const notifications = await res.json();

                const listEl = document.getElementById('notification-items-list');
                const badgeEl = document.getElementById('notification-unread-badge');
                
                const unread = notifications.filter(n => !n.read_at);
                if (unread.length > 0) {
                    badgeEl.textContent = unread.length;
                    badgeEl.classList.remove('hidden');
                } else {
                    badgeEl.classList.add('hidden');
                }

                if (notifications.length === 0) {
                    listEl.innerHTML = '<div class="text-center py-6 text-slate-400 text-xs font-medium">No notifications.</div>';
                } else {
                    listEl.innerHTML = notifications.slice(0, 15).map(n => {
                        const isUnread = !n.read_at;
                        const bgClass = isUnread ? 'bg-yellow-950/[0.03] border-l-2 border-yellow-950 font-bold' : '';
                        
                        return `
                            <div class="p-3 text-xs text-slate-700 hover:bg-slate-50 rounded-xl transition cursor-pointer ${bgClass}" onclick="markNotificationRead(${n.id})">
                                <p class="leading-relaxed">${n.message}</p>
                                <p class="text-[9px] text-slate-400 mt-1 font-normal">${new Date(n.created_at).toLocaleDateString('id-ID', { hour: '2-digit', minute: '2-digit' })}</p>
                            </div>
                        `;
                    }).join('');
                }
            } catch (err) {
                console.error(err);
            }
        }

        window.markNotificationRead = async function(id) {
            try {
                const token = localStorage.getItem('auth_token');
                const headers = { 'Accept': 'application/json' };
                if (token) headers['Authorization'] = `Bearer ${token}`;

                const res = await fetch(window.API_BASE_URL + `/notifications/${id}/read`, { 
                    method: 'POST',
                    headers 
                });
                if (res.ok) {
                    await loadNotifications();
                }
            } catch (err) {
                console.error(err);
            }
        };

        window.markAllNotificationsRead = async function() {
            try {
                const token = localStorage.getItem('auth_token');
                const headers = { 'Accept': 'application/json' };
                if (token) headers['Authorization'] = `Bearer ${token}`;

                const res = await fetch(window.API_BASE_URL + '/notifications/read-all', { 
                    method: 'POST',
                    headers 
                });
                if (res.ok) {
                    await loadNotifications();
                }
            } catch (err) {
                console.error(err);
            }
        };

        // 3. AI Assistant Drawer Methods
        window.toggleAiAssistantDrawer = function(e) {
            if (e) e.stopPropagation();
            const drawer = document.getElementById('ai-assistant-drawer');
            const backdrop = document.getElementById('ai-assistant-backdrop');
            
            if (isAiOpen) {
                drawer.classList.add('translate-x-full');
                backdrop.classList.add('hidden');
                isAiOpen = false;
            } else {
                drawer.classList.remove('translate-x-full');
                backdrop.classList.remove('hidden');
                isAiOpen = true;
            }
        };

        function cleanMarkdown(text) {
            if (!text) return '';
            text = text.replace(/(\*\*|__)(.*?)\1/g, '$2'); // bold
            text = text.replace(/(\*|_)(.*?)\1/g, '$2');    // italic
            text = text.replace(/^#+\s+/gm, '');            // headers
            text = text.replace(/\[([^\]]+)\]\([^)]+\)/g, '$1'); // links
            text = text.replace(/^\>\s+/gm, '');            // blockquotes
            text = text.replace(/`/g, '');                  // inline code
            return text;
        }

        window.sendAiMessage = async function(e) {
            e.preventDefault();
            const inputEl = document.getElementById('ai-message-input');
            const message = inputEl.value.trim();
            if (!message) return;

            inputEl.value = '';

            const bodyEl = document.getElementById('ai-chat-body');
            
            // Append User message
            bodyEl.innerHTML += `
                <div class="flex gap-2 items-start justify-end">
                    <div class="bg-[#3c2a21] text-white text-xs p-3 rounded-2xl rounded-tr-none leading-relaxed max-w-[80%]">
                        ${message}
                    </div>
                </div>
            `;
            bodyEl.scrollTop = bodyEl.scrollHeight;
            localStorage.setItem('wudi_ai_chat_history', bodyEl.innerHTML);

            // Typing indicator
            const typingId = 'typing-' + Date.now();
            bodyEl.innerHTML += `
                <div class="flex gap-2 items-start" id="${typingId}">
                    <div class="h-7 w-7 rounded-lg flex items-center justify-center shrink-0 shadow-sm">
                        <img class="h-4 w-4 object-contain" src="/Logo.png" alt="Wudi AI Logo" />
                    </div>
                    <div class="bg-slate-50 text-slate-400 text-xs p-3 rounded-2xl rounded-tl-none italic">
                        Wudi AI is thinking...
                    </div>
                </div>
            `;
            bodyEl.scrollTop = bodyEl.scrollHeight;

            try {
                const token = localStorage.getItem('auth_token');
                const headers = { 
                    'Content-Type': 'application/json',
                    'Accept': 'application/json' 
                };
                if (token) headers['Authorization'] = `Bearer ${token}`;

                const res = await fetch(window.API_BASE_URL + '/ai/chat', {
                    method: 'POST',
                    headers,
                    body: JSON.stringify({ message })
                });

                document.getElementById(typingId)?.remove();

                if (res.ok) {
                    const data = await res.json();
                    let responseText = data.message?.content || data.reply || data.response || 'I processed your request.';
                    responseText = cleanMarkdown(responseText);

                    bodyEl.innerHTML += `
                        <div class="flex gap-2 items-start">
                            <div class="h-7 w-7 rounded-lg flex items-center justify-center shrink-0 shadow-sm">
                                <img class="h-4 w-4 object-contain" src="/Logo.png" alt="Wudi AI Logo" />
                            </div>
                            <div class="bg-slate-50 text-slate-700 text-xs p-3 rounded-2xl rounded-tl-none leading-relaxed max-w-[80%] whitespace-pre-wrap">
                                ${responseText}
                            </div>
                        </div>
                    `;
                } else {
                    bodyEl.innerHTML += `
                        <div class="flex gap-2 items-start">
                            <div class="h-7 w-7 rounded-lg flex items-center justify-center shrink-0 shadow-sm">
                                <img class="h-4 w-4 object-contain" src="/Logo.png" alt="Wudi AI Logo" />
                            </div>
                            <div class="bg-slate-50 text-rose-600 text-xs p-3 rounded-2xl rounded-tl-none leading-relaxed max-w-[80%]">
                                AI assistant is temporarily unavailable.
                            </div>
                        </div>
                    `;
                }
                localStorage.setItem('wudi_ai_chat_history', bodyEl.innerHTML);
            } catch (err) {
                document.getElementById(typingId)?.remove();
                bodyEl.innerHTML += `
                    <div class="flex gap-2 items-start">
                        <div class="h-7 w-7 rounded-lg flex items-center justify-center shrink-0 shadow-sm">
                            <img class="h-4 w-4 object-contain" src="/Logo.png" alt="Wudi AI Logo" />
                        </div>
                        <div class="bg-slate-50 text-rose-600 text-xs p-3 rounded-2xl rounded-tl-none leading-relaxed max-w-[80%]">
                            Failed to reach Wudi AI.
                        </div>
                    </div>
                `;
                localStorage.setItem('wudi_ai_chat_history', bodyEl.innerHTML);
            }
            bodyEl.scrollTop = bodyEl.scrollHeight;
        };

        // Initialize fetch loop
        document.addEventListener('DOMContentLoaded', () => {
            // Load chat history
            const chatHistory = localStorage.getItem('wudi_ai_chat_history');
            if (chatHistory) {
                document.getElementById('ai-chat-body').innerHTML = chatHistory;
            }

            fetchDashboardData();
            fetchUsersList();
            fetchActivityLogs();
            loadNotifications();

            // Search Bar Input listener
            const searchInput = document.getElementById('header-search-input');
            if (searchInput) {
                let searchTimeout;
                searchInput.addEventListener('input', (e) => {
                    clearTimeout(searchTimeout);
                    searchTimeout = setTimeout(() => {
                        fetchUsersList(e.target.value);
                    }, 350);
                });
            }

            // Close notification dropdown when clicking outside
            document.addEventListener('click', () => {
                if (isNotifOpen) {
                    document.getElementById('notification-dropdown').classList.add('hidden');
                    isNotifOpen = false;
                }
            });
            document.getElementById('notification-dropdown')?.addEventListener('click', (e) => {
                e.stopPropagation();
            });

            // Setup 12s polling interval
            setInterval(() => {
                fetchDashboardData();
                fetchActivityLogs();
                loadNotifications();
            }, 12000);

            // Connect Overview filter
            const overviewFilter = document.getElementById('overview-filter');
            if (overviewFilter) {
                overviewFilter.addEventListener('change', (e) => {
                    updateOverviewCards(e.target.value);
                });
            }

            // Connect Chart filter
            const chartFilter = document.getElementById('chart-filter');
            if (chartFilter) {
                chartFilter.addEventListener('change', (e) => {
                    if (window.dashboardData) {
                        if (e.target.value === 'last_7_days') {
                            renderChart(window.dashboardData.charts?.last_7_days || []);
                        } else {
                            renderChart(window.dashboardData.charts?.this_month || []);
                        }
                    }
                });
            }

            // Clear comments / logs button action
            const clearBtn = document.getElementById('clear-logs');
            if (clearBtn) {
                clearBtn.addEventListener('click', () => {
                    const logsContainer = document.getElementById('security-logs-container');
                    if (logsContainer) {
                        logsContainer.innerHTML = `
                            <div class="text-center py-8 text-slate-400 text-xs font-medium">
                                No recent activity reports.
                            </div>
                        `;
                    }
                });
            }

            // Sync top header avatar
            window.addEventListener('user-data-loaded', (e) => {
                const user = e.detail;
                if (user) {
                    const initialsEl = document.getElementById('header-avatar-initials');
                    if (initialsEl) {
                        const parts = user.name.split(' ');
                        const initials = parts.map(p => p[0]).join('').slice(0, 2).toUpperCase();
                        initialsEl.textContent = initials || 'WA';
                    }

                    if (user.avatar_url) {
                        const imgEl = document.getElementById('header-avatar-img');
                        if (imgEl) {
                            imgEl.src = user.avatar_url;
                            imgEl.classList.remove('hidden');
                            if (initialsEl) initialsEl.classList.add('hidden');
                        }
                    }
                }
            });
        });
    </script>
@endsection
