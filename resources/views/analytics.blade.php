@extends('layouts.app')

@section('title', 'Analytics - WUDI Monitoring')
@section('section_title', 'Data Insight')
@section('section_description', 'Analisis mendalam mengenai ekosistem dan perilaku pengguna Wudi.')

@section('content')
    <div class="grid gap-6 lg:grid-cols-3">
        
        <!-- TASK DISTRIBUTION -->
        <div class="rounded-[2rem] border border-slate-200 bg-white p-8 shadow-sm lg:col-span-1">
            <h2 class="text-sm font-bold text-slate-500 uppercase mb-6">Task Distribution</h2>
            <div class="space-y-6">
                <div>
                    <div class="flex justify-between text-xs font-bold mb-2">
                        <span class="text-slate-600">Work</span>
                        <span id="dist-work-count">145 tasks</span>
                    </div>
                    <div class="h-2 w-full rounded-full bg-slate-100">
                        <div class="h-full rounded-full bg-blue-500" style="width: 36.25%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between text-xs font-bold mb-2">
                        <span class="text-slate-600">Personal</span>
                        <span id="dist-personal-count">89 tasks</span>
                    </div>
                    <div class="h-2 w-full rounded-full bg-slate-100">
                        <div class="h-full rounded-full bg-emerald-500" style="width: 22.25%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between text-xs font-bold mb-2">
                        <span class="text-slate-600">Study</span>
                        <span id="dist-study-count">112 tasks</span>
                    </div>
                    <div class="h-2 w-full rounded-full bg-slate-100">
                        <div class="h-full rounded-full bg-purple-500" style="width: 28%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between text-xs font-bold mb-2">
                        <span class="text-slate-600">Health</span>
                        <span id="dist-health-count">42 tasks</span>
                    </div>
                    <div class="h-2 w-full rounded-full bg-slate-100">
                        <div class="h-full rounded-full bg-rose-500" style="width: 10.5%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- GROWTH CHART -->
        <div class="rounded-[2rem] border border-slate-200 bg-white p-8 shadow-sm lg:col-span-2">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-sm font-bold text-slate-500 uppercase">Monthly Productivity Growth</h2>
                <select class="text-xs font-bold bg-slate-50 border-none rounded-lg p-2 focus:ring-0">
                    <option>Last 5 Months</option>
                    <option>Year 2026</option>
                </select>
            </div>
            <div id="growth-chart-container" class="flex items-end justify-between gap-4 h-48">
                <div class="flex-1 flex flex-col items-center gap-3">
                    <div class="w-full rounded-xl bg-gradient-to-t from-yellow-900 to-yellow-700 transition-all hover:scale-105" style="height: 45.7%"></div>
                    <span class="text-[10px] font-bold text-slate-400 uppercase">Jan</span>
                </div>
                <div class="flex-1 flex flex-col items-center gap-3">
                    <div class="w-full rounded-xl bg-gradient-to-t from-yellow-900 to-yellow-700 transition-all hover:scale-105" style="height: 64.2%"></div>
                    <span class="text-[10px] font-bold text-slate-400 uppercase">Feb</span>
                </div>
                <div class="flex-1 flex flex-col items-center gap-3">
                    <div class="w-full rounded-xl bg-gradient-to-t from-yellow-900 to-yellow-700 transition-all hover:scale-105" style="height: 54.2%"></div>
                    <span class="text-[10px] font-bold text-slate-400 uppercase">Mar</span>
                </div>
                <div class="flex-1 flex flex-col items-center gap-3">
                    <div class="w-full rounded-xl bg-gradient-to-t from-yellow-900 to-yellow-700 transition-all hover:scale-105" style="height: 74.2%"></div>
                    <span class="text-[10px] font-bold text-slate-400 uppercase">Apr</span>
                </div>
                <div class="flex-1 flex flex-col items-center gap-3">
                    <div class="w-full rounded-xl bg-gradient-to-t from-yellow-900 to-yellow-700 transition-all hover:scale-105" style="height: 87.1%"></div>
                    <span class="text-[10px] font-bold text-slate-400 uppercase">May</span>
                </div>
            </div>
        </div>

        <!-- ENGAGEMENT METRICS -->
        <div class="rounded-[2rem] border border-slate-200 bg-[#1a1c1e] p-8 shadow-sm lg:col-span-3">
            <div class="grid md:grid-cols-3 gap-8">
                <div class="text-center md:text-left border-b md:border-b-0 md:border-r border-slate-700 pb-6 md:pb-0">
                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Total Interactions</p>
                    <h3 class="text-3xl font-bold text-white mt-2" id="metric-interactions">...</h3>
                    <p class="text-xs text-emerald-400 font-medium mt-1">↑ API Requests</p>
                </div>
                <div class="text-center md:text-left border-b md:border-b-0 md:border-r border-slate-700 pb-6 md:pb-0">
                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Monitoring Rate</p>
                    <h3 class="text-3xl font-bold text-white mt-2" id="metric-rate">...</h3>
                    <p class="text-xs text-slate-400 font-medium mt-1">Health Score</p>
                </div>
                <div class="text-center md:text-left">
                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Active Users</p>
                    <h3 class="text-3xl font-bold text-white mt-2" id="metric-active">...</h3>
                    <p class="text-xs text-blue-400 font-medium mt-1">Real-time sessions</p>
                </div>
            </div>
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            fetchAnalyticsData();
            // Refresh every 12 seconds like dashboard
            setInterval(fetchAnalyticsData, 12000);
        });

        async function fetchAnalyticsData() {
            try {
                const token = localStorage.getItem('auth_token');
                const headers = { 'Accept': 'application/json' };
                if (token) headers['Authorization'] = `Bearer ${token}`;

                const res = await fetch(window.API_BASE_URL + '/monitoring/dashboard', { headers });
                if (!res.ok) return;

                const data = await res.json();
                
                // Update Engagement Metrics
                if (data.overview) {
                    document.getElementById('metric-interactions').textContent = data.overview.total_interactions.toLocaleString();
                    document.getElementById('metric-rate').textContent = (data.overview.security_alerts > 0 ? '98%' : '100%');
                    document.getElementById('metric-active').textContent = data.overview.active_users.toLocaleString();
                    
                    // Animate Task Distribution Mock
                    const workTasks = Math.floor(data.overview.total_interactions * 0.3625);
                    const personalTasks = Math.floor(data.overview.total_interactions * 0.2225);
                    const studyTasks = Math.floor(data.overview.total_interactions * 0.28);
                    const healthTasks = Math.floor(data.overview.total_interactions * 0.105);
                    
                    document.getElementById('dist-work-count').textContent = workTasks + ' tasks';
                    document.getElementById('dist-personal-count').textContent = personalTasks + ' tasks';
                    document.getElementById('dist-study-count').textContent = studyTasks + ' tasks';
                    document.getElementById('dist-health-count').textContent = healthTasks + ' tasks';
                }

                // Update Growth Chart based on this_month array
                if (data.charts && data.charts.this_month && data.charts.this_month.length > 0) {
                    // Get last 5 days
                    const last5 = data.charts.this_month.slice(-5);
                    const maxCount = Math.max(...last5.map(d => d.count), 1); // prevent div by zero
                    
                    const chartContainer = document.getElementById('growth-chart-container');
                    chartContainer.innerHTML = last5.map(day => {
                        const heightPct = Math.max((day.count / maxCount) * 100, 10); // min 10%
                        const label = day.date.substring(8, 10) + ' ' + new Date(day.date).toLocaleString('default', { month: 'short' });
                        return `
                            <div class="flex-1 flex flex-col items-center justify-end gap-3 h-full">
                                <div class="w-full rounded-xl bg-gradient-to-t from-yellow-900 to-yellow-700 transition-all hover:scale-105 relative group flex items-end justify-center" style="height: ${heightPct}%">
                                    <div class="absolute -top-8 bg-slate-900 text-white text-[9px] px-2 py-1 rounded hidden group-hover:block whitespace-nowrap z-10">${day.count} activities</div>
                                </div>
                                <span class="text-[10px] font-bold text-slate-400 uppercase">${label}</span>
                            </div>
                        `;
                    }).join('');
                }

            } catch(e) {
                console.error('Failed to load analytics', e);
            }
        }
    </script>
@endsection
