import { useState } from 'react'
import { Link } from 'react-router-dom'

const analyticsData = {
  taskDistribution: [
    { category: 'Work', count: 145, color: 'bg-blue-500' },
    { category: 'Personal', count: 89, color: 'bg-emerald-500' },
    { category: 'Study', count: 112, color: 'bg-purple-500' },
    { category: 'Health', count: 42, color: 'bg-rose-500' },
  ],
  monthlyStats: [
    { month: 'Jan', tasks: 320 },
    { month: 'Feb', tasks: 450 },
    { month: 'Mar', tasks: 380 },
    { month: 'Apr', tasks: 520 },
    { month: 'May', tasks: 610 },
  ],
  userEngagement: {
    avgSession: '12m 45s',
    retentionRate: '78%',
    dailyActive: '842'
  }
}

function Analytics() {
  const [data] = useState(analyticsData)

  return (
    <div id="Analytics" className="flex min-h-screen bg-slate-50 text-slate-900">
      {/* Sidebar Placeholder - Sebaiknya di-refactor ke komponen terpisah agar konsisten */}
      <aside className="hidden w-64 border-r border-slate-200 bg-[#fff2dc] lg:block">
        <div className="flex h-full flex-col p-6">
          <div className="mb-10 flex items-center gap-3">
            <img className="h-10 w-10 rounded-lg" src="public/LogoWudi.png" alt="Logo" />
            <span className="text-xl font-bold tracking-tight">WUDI Panel</span>
          </div>
         <nav className="flex-1 space-y-2">
            <div id="dashboard" className="flex items-center h-10 w-full rounded-xl bg-yellow-950 hover:bg-yellow-800 transition cursor-pointer">
              <Link to="/dashboard" className="text-sm font-medium text-white ml-4">Dashboard</Link>
            </div>
            <div id="analytics" className="flex items-center h-10 w-full rounded-xl bg-yellow-950 hover:bg-yellow-800 transition cursor-pointer">
              <Link to="/analytics" className="text-sm font-medium text-white ml-4">Analytics</Link>
            </div>
            <div id="report" className="flex items-center h-10 w-full rounded-xl bg-yellow-950 hover:bg-yellow-800 transition cursor-pointer">
              <Link to="/report" className="text-sm font-medium text-white ml-4">Report</Link>
            </div>
            <div id="settings" className="flex items-center h-10 w-full rounded-xl bg-yellow-950 hover:bg-yellow-800 transition cursor-pointer">
              <Link to="/settings" className="text-sm font-medium text-white ml-4">Settings</Link>
            </div>
          </nav>
        </div>
      </aside>

      <main className="flex-1 overflow-y-auto px-6 py-8">
        <div className="mx-auto max-w-6xl">
          
          {/* HEADER */}
          <div className="mb-8 rounded-[2.5rem] border border-slate-200 bg-white p-8 shadow-sm">
            <p className="text-xs uppercase tracking-[0.2em] text-slate-400 font-bold">Data Insight</p>
            <h1 className="mt-2 text-3xl font-bold text-slate-900">Advanced Analytics</h1>
            <p className="mt-1 text-slate-500 text-sm">Analisis mendalam mengenai ekosistem dan perilaku pengguna Wudi.</p>
          </div>

          <div className="grid gap-6 lg:grid-cols-3">
            
            {/* TASK DISTRIBUTION (Kategori) */}
            <div className="rounded-[2rem] border border-slate-200 bg-white p-8 shadow-sm lg:col-span-1">
              <h2 className="text-sm font-bold text-slate-500 uppercase mb-6">Task Distribution</h2>
              <div className="space-y-6">
                {data.taskDistribution.map((item, idx) => (
                  <div key={idx}>
                    <div className="flex justify-between text-xs font-bold mb-2">
                      <span className="text-slate-600">{item.category}</span>
                      <span>{item.count} tasks</span>
                    </div>
                    <div className="h-2 w-full rounded-full bg-slate-100 text-[0px]">
                      <div 
                        className={`h-full rounded-full ${item.color} transition-all duration-1000`} 
                        style={{ width: `${(item.count / 400) * 100}%` }}
                      >.</div>
                    </div>
                  </div>
                ))}
              </div>
            </div>

            {/* GROWTH CHART PLACEHOLDER */}
            <div className="rounded-[2rem] border border-slate-200 bg-white p-8 shadow-sm lg:col-span-2">
              <div className="flex justify-between items-center mb-8">
                <h2 className="text-sm font-bold text-slate-500 uppercase">Monthly Productivity Growth</h2>
                <select className="text-xs font-bold bg-slate-50 border-none rounded-lg p-2 focus:ring-0">
                  <option>Last 5 Months</option>
                  <option>Year 2026</option>
                </select>
              </div>
              <div className="flex items-end justify-between gap-4 h-48">
                {data.monthlyStats.map((stat, idx) => (
                  <div key={idx} className="flex-1 flex flex-col items-center gap-3">
                    <div 
                      className="w-full rounded-xl bg-gradient-to-t from-yellow-900 to-yellow-700 transition-all hover:scale-105"
                      style={{ height: `${(stat.tasks / 700) * 100}%` }}
                    ></div>
                    <span className="text-[10px] font-bold text-slate-400 uppercase">{stat.month}</span>
                  </div>
                ))}
              </div>
            </div>

            {/* ENGAGEMENT METRICS */}
            <div className="rounded-[2rem] border border-slate-200 bg-[#1a1c1e] p-8 shadow-sm lg:col-span-3">
              <div className="grid md:grid-cols-3 gap-8">
                <div className="text-center md:text-left border-b md:border-b-0 md:border-r border-slate-700 pb-6 md:pb-0">
                  <p className="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Avg. Session Time</p>
                  <h3 className="text-3xl font-bold text-white mt-2">{data.userEngagement.avgSession}</h3>
                  <p className="text-xs text-emerald-400 font-medium mt-1">↑ 2.1% focus time</p>
                </div>
                <div className="text-center md:text-left border-b md:border-b-0 md:border-r border-slate-700 pb-6 md:pb-0">
                  <p className="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Retention Rate</p>
                  <h3 className="text-3xl font-bold text-white mt-2">{data.userEngagement.retentionRate}</h3>
                  <p className="text-xs text-slate-400 font-medium mt-1">Loyal Wudi Users</p>
                </div>
                <div className="text-center md:text-left">
                  <p className="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Daily Active</p>
                  <h3 className="text-3xl font-bold text-white mt-2">{data.userEngagement.dailyActive}</h3>
                  <p className="text-xs text-blue-400 font-medium mt-1">Real-time interactions</p>
                </div>
              </div>
            </div>

          </div>
        </div>
      </main>
    </div>
  )
}

export default Analytics;