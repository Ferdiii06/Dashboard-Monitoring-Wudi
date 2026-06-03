@extends('layouts.app')

@section('title', 'Security Logs - WUDI Monitoring')
@section('section_title', 'Security Logs')
@section('section_description', 'Pantau jejak aktivitas, peringatan keamanan, dan potensi ancaman sistem.')

@section('content')
    <!-- SECURITY METRICS GRID -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
            <div class="h-10 w-10 rounded-xl bg-slate-100 flex items-center justify-center text-slate-500 mb-4">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
            </div>
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Login Attempts</p>
            <p class="text-2xl font-extrabold text-slate-900 mt-1">1,024</p>
        </div>

        <div class="rounded-[2rem] border border-rose-200/50 bg-rose-50/30 p-6 shadow-sm">
            <div class="h-10 w-10 rounded-xl bg-rose-100 flex items-center justify-center text-rose-500 mb-4">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>
            <p class="text-[10px] font-bold text-rose-500 uppercase tracking-widest">Failed Logins</p>
            <p class="text-2xl font-extrabold text-slate-900 mt-1">42</p>
        </div>

        <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
            <div class="h-10 w-10 rounded-xl bg-yellow-100 flex items-center justify-center text-yellow-600 mb-4">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Password Resets</p>
            <p class="text-2xl font-extrabold text-slate-900 mt-1">15</p>
        </div>

        <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
            <div class="h-10 w-10 rounded-xl bg-purple-100 flex items-center justify-center text-purple-600 mb-4">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                </svg>
            </div>
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Blocked IPs</p>
            <p class="text-2xl font-extrabold text-slate-900 mt-1">7</p>
        </div>
    </div>

    <!-- SECURITY AUDIT LIST -->
    <div class="rounded-[2.5rem] border border-slate-200 bg-white p-8 shadow-sm">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-lg font-bold text-slate-900 flex items-center gap-3">
                <span class="h-3 w-3 rounded-full bg-slate-800"></span>
                Recent Security Audit Logs
            </h2>
            <div class="flex items-center gap-2">
                <select class="rounded-xl border border-slate-200 bg-slate-50 px-4 py-2 text-xs font-bold text-slate-600 focus:outline-none">
                    <option value="all">All Events</option>
                    <option value="warnings">Warnings Only</option>
                    <option value="critical">Critical Only</option>
                </select>
                <button onclick="exportSecurityCSV()" class="rounded-xl bg-yellow-950 px-4 py-2 text-xs font-bold text-white hover:bg-yellow-900 transition cursor-pointer">
                    Export CSV
                </button>
            </div>
        </div>

        <div class="space-y-4">
            <!-- Normal Event -->
            <div class="flex items-center justify-between p-5 rounded-2xl border border-slate-100 bg-slate-50 hover:bg-white hover:shadow-sm transition">
                <div class="flex items-center gap-4">
                    <div class="h-10 w-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-slate-900">Successful Login</p>
                        <p class="text-xs text-slate-500 mt-1">User: admin@wudi.com | IP: 192.168.1.5</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-xs font-bold text-slate-400">Just now</p>
                </div>
            </div>

            <!-- Warning Event -->
            <div class="flex items-center justify-between p-5 rounded-2xl border border-yellow-200/50 bg-yellow-50/30 hover:bg-white hover:shadow-sm transition">
                <div class="flex items-center gap-4">
                    <div class="h-10 w-10 rounded-full bg-yellow-100 text-yellow-600 flex items-center justify-center">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-slate-900">Multiple Failed Logins</p>
                        <p class="text-xs text-slate-500 mt-1">IP: 45.33.12.9 (Tokyo, JP) attempted 5 times.</p>
                    </div>
                </div>
                <div class="text-right">
                    <span class="inline-flex items-center gap-1 rounded-full bg-yellow-100 px-2 py-1 text-[9px] font-bold text-yellow-700 mb-1 uppercase tracking-widest">Warning</span>
                    <p class="text-xs font-bold text-slate-400">12 mins ago</p>
                </div>
            </div>

            <!-- Critical Event -->
            <div class="flex items-center justify-between p-5 rounded-2xl border border-rose-200/50 bg-rose-50/30 hover:bg-white hover:shadow-sm transition">
                <div class="flex items-center gap-4">
                    <div class="h-10 w-10 rounded-full bg-rose-100 text-rose-600 flex items-center justify-center">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-slate-900">Account Locked</p>
                        <p class="text-xs text-slate-500 mt-1">User account <strong>dody.kurniawan</strong> locked due to brute force protection.</p>
                    </div>
                </div>
                <div class="text-right">
                    <span class="inline-flex items-center gap-1 rounded-full bg-rose-100 px-2 py-1 text-[9px] font-bold text-rose-700 mb-1 uppercase tracking-widest">Critical</span>
                    <p class="text-xs font-bold text-slate-400">2 hrs ago</p>
                </div>
            </div>
        </div>
        
        <div class="mt-6 flex justify-center">
            <button class="text-sm font-bold text-slate-500 hover:text-slate-800 transition" onclick="alert('No older logs available in the local database.')">
                Load Older Logs
            </button>
        </div>
    </div>

    <script>
        function exportSecurityCSV() {
            const logs = [
                ['Time', 'Level', 'Event', 'Details'],
                ['Just now', 'Normal', 'Successful Login', 'User: admin@wudi.com | IP: 192.168.1.5'],
                ['12 mins ago', 'Warning', 'Multiple Failed Logins', 'IP: 45.33.12.9 (Tokyo, JP) attempted 5 times.'],
                ['2 hrs ago', 'Critical', 'Account Locked', 'User account dody.kurniawan locked due to brute force protection.']
            ];

            const csvContent = logs.map(e => e.map(field => `"${field}"`).join(',')).join('\n');
            const blob = new Blob([csvContent], { type: 'text/csv' });
            const url = URL.createObjectURL(blob);
            
            const a = document.createElement('a');
            a.href = url;
            a.download = `wudi_security_logs_${new Date().toISOString().slice(0, 10)}.csv`;
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            URL.revokeObjectURL(url);
        }
    </script>
@endsection
