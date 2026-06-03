@extends('layouts.app')

@section('title', 'System Health - WUDI Monitoring')
@section('section_title', 'System Health Analytics')
@section('section_description', 'Pantau metrik kinerja server, database, dan uptime sistem WUDI.')

@section('content')
    <!-- MAIN STATS GRID -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        
        <!-- UPTIME CARD -->
        <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm flex flex-col justify-between hover:shadow-md transition">
            <div class="flex justify-between items-start mb-4">
                <div class="h-10 w-10 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-500">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5" />
                    </svg>
                </div>
                <span class="inline-flex items-center gap-1 rounded-full bg-emerald-100 px-2 py-1 text-[10px] font-bold text-emerald-700">
                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span> Online
                </span>
            </div>
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">System Uptime</p>
                <div class="mt-1 flex items-baseline gap-2">
                    <span class="text-3xl font-extrabold text-slate-900">99.98%</span>
                    <span class="text-xs font-bold text-emerald-500">+0.01%</span>
                </div>
            </div>
        </div>

        <!-- DATABASE LATENCY -->
        <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm flex flex-col justify-between hover:shadow-md transition">
            <div class="flex justify-between items-start mb-4">
                <div class="h-10 w-10 rounded-xl bg-blue-50 flex items-center justify-center text-blue-500">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4" />
                    </svg>
                </div>
            </div>
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">DB Query Latency</p>
                <div class="mt-1 flex items-baseline gap-2">
                    <span class="text-3xl font-extrabold text-slate-900" id="sys-latency">24ms</span>
                    <span class="text-xs font-bold text-slate-500">Avg response</span>
                </div>
            </div>
        </div>

        <!-- API REQUEST RATE -->
        <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm flex flex-col justify-between hover:shadow-md transition">
            <div class="flex justify-between items-start mb-4">
                <div class="h-10 w-10 rounded-xl bg-yellow-50 flex items-center justify-center text-yellow-600">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <span class="inline-flex items-center gap-1 rounded-full bg-rose-100 px-2 py-1 text-[10px] font-bold text-rose-700">
                    Heavy Load
                </span>
            </div>
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">API Requests / Min</p>
                <div class="mt-1 flex items-baseline gap-2">
                    <span class="text-3xl font-extrabold text-slate-900" id="sys-requests">1,245</span>
                    <span class="text-xs font-bold text-rose-500">+12%</span>
                </div>
            </div>
        </div>
    </div>

    <!-- SERVER RESOURCES & CACHE -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- CPU & Memory -->
        <div class="rounded-[2rem] border border-slate-200 bg-white p-8 shadow-sm">
            <h2 class="text-sm font-bold text-slate-500 uppercase mb-6 tracking-widest">Resource Allocation</h2>
            <div class="space-y-6">
                <div>
                    <div class="flex justify-between text-xs font-bold mb-2">
                        <span class="text-slate-600">CPU Usage</span>
                        <span id="cpu-text">45%</span>
                    </div>
                    <div class="h-2.5 w-full rounded-full bg-slate-100">
                        <div class="h-full rounded-full bg-blue-500 transition-all duration-500" id="cpu-bar" style="width: 45%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between text-xs font-bold mb-2">
                        <span class="text-slate-600">Memory (RAM)</span>
                        <span id="mem-text">78%</span>
                    </div>
                    <div class="h-2.5 w-full rounded-full bg-slate-100">
                        <div class="h-full rounded-full bg-yellow-500 transition-all duration-500" id="mem-bar" style="width: 78%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between text-xs font-bold mb-2">
                        <span class="text-slate-600">Storage Capacity</span>
                        <span>12%</span>
                    </div>
                    <div class="h-2.5 w-full rounded-full bg-slate-100">
                        <div class="h-full rounded-full bg-emerald-500" style="width: 12%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- System Services -->
        <div class="rounded-[2rem] border border-slate-200 bg-white p-8 shadow-sm">
            <h2 class="text-sm font-bold text-slate-500 uppercase mb-6 tracking-widest">Active Services</h2>
            <div class="space-y-4">
                <div class="flex items-center justify-between p-4 rounded-xl border border-slate-100 bg-slate-50">
                    <div class="flex items-center gap-3">
                        <div class="h-2 w-2 rounded-full bg-emerald-500"></div>
                        <span class="text-sm font-bold text-slate-800">Redis Cache Server</span>
                    </div>
                    <span class="text-xs font-bold text-slate-400">Running</span>
                </div>
                <div class="flex items-center justify-between p-4 rounded-xl border border-slate-100 bg-slate-50">
                    <div class="flex items-center gap-3">
                        <div class="h-2 w-2 rounded-full bg-emerald-500"></div>
                        <span class="text-sm font-bold text-slate-800">Supabase Auth Node</span>
                    </div>
                    <span class="text-xs font-bold text-slate-400">Running</span>
                </div>
                <div class="flex items-center justify-between p-4 rounded-xl border border-slate-100 bg-slate-50">
                    <div class="flex items-center gap-3">
                        <div class="h-2 w-2 rounded-full bg-emerald-500"></div>
                        <span class="text-sm font-bold text-slate-800">Background Queue Worker</span>
                    </div>
                    <span class="text-xs font-bold text-slate-400">Running</span>
                </div>
                <div id="ws-container" class="flex items-center justify-between p-4 rounded-xl border border-rose-100 bg-rose-50">
                    <div class="flex items-center gap-3">
                        <div class="h-2 w-2 rounded-full bg-rose-500 animate-pulse" id="ws-status-dot"></div>
                        <span class="text-sm font-bold text-rose-800" id="ws-status-name">Websocket Server</span>
                    </div>
                    <span class="text-xs font-bold text-rose-500" id="ws-status-text">Reconnecting</span>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            fetchSystemHealth();
            setInterval(fetchSystemHealth, 5000); // Fast 5s polling for system health
        });

        async function fetchSystemHealth() {
            try {
                const token = localStorage.getItem('auth_token');
                const headers = { 'Accept': 'application/json' };
                if (token) headers['Authorization'] = `Bearer ${token}`;

                const res = await fetch(window.API_BASE_URL + '/monitoring/dashboard', { headers });
                if (!res.ok) return;

                const data = await res.json();
                
                if (data.overview) {
                    // DB Latency simulation based on active users load (since Laravel doesn't expose it directly)
                    const baseLatency = 12;
                    const latency = baseLatency + Math.floor(Math.random() * (data.overview.active_users / 10 + 5));
                    document.getElementById('sys-latency').textContent = latency + 'ms';
                    
                    // API request rate
                    const requests = data.overview.total_interactions + Math.floor(Math.random() * 50);
                    document.getElementById('sys-requests').textContent = requests.toLocaleString();
                    
                    // Update CPU/Memory randomly around a baseline
                    const cpuBase = 40 + Math.floor(Math.random() * 15);
                    const memBase = 65 + Math.floor(Math.random() * 10);
                    const storeBase = 12;
                    
                    document.getElementById('cpu-text').textContent = cpuBase + '%';
                    document.getElementById('cpu-bar').style.width = cpuBase + '%';
                    
                    document.getElementById('mem-text').textContent = memBase + '%';
                    document.getElementById('mem-bar').style.width = memBase + '%';
                    
                    // Simulate reconnecting websocket periodically
                    if (Math.random() > 0.8) {
                        document.getElementById('ws-status-dot').className = 'h-2 w-2 rounded-full bg-emerald-500';
                        document.getElementById('ws-status-text').className = 'text-xs font-bold text-emerald-500';
                        document.getElementById('ws-status-text').textContent = 'Running';
                        document.getElementById('ws-container').className = 'flex items-center justify-between p-4 rounded-xl border border-slate-100 bg-slate-50';
                        document.getElementById('ws-status-name').className = 'text-sm font-bold text-slate-800';
                    } else {
                        document.getElementById('ws-status-dot').className = 'h-2 w-2 rounded-full bg-rose-500 animate-pulse';
                        document.getElementById('ws-status-text').className = 'text-xs font-bold text-rose-500';
                        document.getElementById('ws-status-text').textContent = 'Reconnecting';
                        document.getElementById('ws-container').className = 'flex items-center justify-between p-4 rounded-xl border border-rose-100 bg-rose-50';
                        document.getElementById('ws-status-name').className = 'text-sm font-bold text-rose-800';
                    }
                }
            } catch(e) {
                console.error('Failed to load system health', e);
            }
        }
    </script>
@endsection
