import { useEffect, useState } from 'react'
import { Link,  } from 'react-router-dom'
// Data simulasi yang diperbarui dengan Task Completion Rate

const mockData = {
  totalInteractions: "24,842",
  activeUsers: 842,
  chatAiAccuracy: "94.8%",
  productivityTrends: "+12.5% vs last week",
  // Fitur baru menggantikan Performance
  taskCompletion: {
    rate: "82%",
    completed: 420,
    pending: 92,
  },
  attacks: [],
}

function Dashboard({ user, onLogout }) {
  const [data, setData] = useState(mockData)
  const [setLoading] = useState(true)

  useEffect(() => {
    let mounted = true
    const fetchMonitoring = async () => {
      setLoading(true)
      try {
        const res = await fetch('/api/monitoring')
        if (!res.ok) throw new Error('no-api')
        const json = await res.json()
        if (mounted) setData(json)
      } catch {
        if (mounted) setData(mockData)
      } finally {
        if (mounted) setLoading(false)
      }
    }

    fetchMonitoring()
    const interval = setInterval(fetchMonitoring, 10000)
    return () => {
      mounted = false
      clearInterval(interval)
    }
  }, [])

  return (
    <div className="flex min-h-screen bg-slate-50 text-slate-900">
      
      {/* --- SIDEBAR --- */}
      <aside className="hidden w-64 border-r border-slate-200 bg-[#fff2dc] lg:block">
        <div className="flex h-full flex-col p-6">
          <div className="mb-10 flex items-center gap-3">
            <img className="h-10 w-10 rounded-lg" src="public/LogoWudi.png" alt="Wudi Logo" />
            <span className="text-xl font-bold tracking-tight">WUDI Panel</span>
          </div>
          
          <nav className="flex-1 space-y-2">
            <Link to="/dashboard" id="dashboard" className="flex items-center justify-start h-10 px-4 w-full rounded-xl bg-yellow-950 hover:bg-yellow-800 transition cursor-pointer text-sm font-medium text-white">
              Dashboard
            </Link>
            <Link to="/analytics" id="analytics" className="flex items-center justify-start h-10 px-4 w-full rounded-xl bg-yellow-950 hover:bg-yellow-800 transition cursor-pointer text-sm font-medium text-white">
              Analytics
            </Link>
            <Link to="/report" id="report" className="flex items-center justify-start h-10 px-4 w-full rounded-xl bg-yellow-950 hover:bg-yellow-800 transition cursor-pointer text-sm font-medium text-white">
              Report
            </Link>
            <Link to="/settings" id="settings" className="flex items-center justify-start h-10 px-4 w-full rounded-xl bg-yellow-950 hover:bg-yellow-800 transition cursor-pointer text-sm font-medium text-white">
              Settings
            </Link>
          </nav>

          <div className="mt-auto pt-6">
            <div className="rounded-2xl bg-slate-900 p-4 text-white">
              <p className="text-xs text-slate-400">System Status</p>
              <p className="text-sm font-medium">All systems normal</p>
            </div>
          </div>
        </div>
      </aside>

      {/* --- MAIN CONTENT --- */}
      <main className="flex-1 overflow-y-auto px-6 py-8">
        <div className="mx-auto max-w-6xl">
          
          {/* HEADER */}
          <div className="mb-8 flex flex-col gap-4 rounded-[2.5rem] border border-slate-200 bg-white p-8 shadow-sm sm:flex-row sm:items-center sm:justify-between">
            <div>
              <p className="text-xs uppercase tracking-[0.2em] text-slate-400 font-bold">Dashboard Monitoring</p>
              <h1 className="mt-2 text-3xl font-bold text-slate-900">Hello, {user?.username} </h1>
              <p className="mt-1 text-slate-500 text-sm">Berikut ringkasan aktivitas tugas Wudi hari ini.</p>
            </div>
            <button
              onClick={onLogout}
              className="rounded-2xl bg-rose-50 px-6 py-3 text-sm font-bold text-rose-600 transition hover:bg-rose-600 hover:text-white"
            >
              Logout
            </button>
          </div>

          {/* GRID METRICS */}
          <div className="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            
            <div className="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
              <div className="flex items-center gap-4">
                <div className="rounded-2xl bg-blue-50 p-3 text-blue-600">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"><path d="m3 21 1.9-5.7a8.5 8.5 0 1 1 3.8 3.8z"/></svg>
                </div>
                <h2 className="text-sm font-bold text-slate-500 uppercase">Total Interaction</h2>
              </div>
              <p className="mt-4 text-4xl font-bold text-slate-900">{data.totalInteractions}</p>
              <div className="mt-2 flex items-center gap-1 text-xs text-emerald-600 font-medium">
                <span>↑ 8.2% from yesterday</span>
              </div> 
            </div>

            <div className="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
              <div className="flex items-center gap-4">
                <div className="rounded-2xl bg-emerald-50 p-3 text-emerald-600">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
                <h2 className="text-sm font-bold text-slate-500 uppercase">Active Users</h2>
              </div>
              <p className="mt-4 text-4xl font-bold text-slate-900">{data.activeUsers}</p>
              <p className="mt-2 text-xs text-slate-400 font-medium tracking-wide">Real-time concurrent users</p>
            </div>

            <div className="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
              <div className="flex items-center gap-4">
                <div className="rounded-2xl bg-purple-50 p-3 text-purple-600">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"><path d="M12 2a10 10 0 1 0 10 10 4 4 0 0 1-5-5 4 4 0 0 1-5-5Z"/><path d="m12.1 7.1 1.6 1.6 4.3-4.3"/></svg>
                </div>
                <h2 className="text-sm font-bold text-slate-500 uppercase">Chat AI Accuracy</h2>
              </div>
              <p className="mt-4 text-4xl font-bold text-slate-900">{data.chatAiAccuracy}</p>
              <div className="mt-2 h-1.5 w-full rounded-full bg-slate-100">
                <div className="h-full rounded-full bg-purple-500" style={{ width: '94%' }}></div>
              </div>
            </div>

            <div className="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm lg:col-span-2">
              <div className="flex items-center justify-between">
                <div className="flex items-center gap-4">
                  <div className="rounded-2xl bg-orange-50 p-3 text-orange-600">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"><path d="M3 3v18h18"/><path d="m19 9-5 5-4-4-3 3"/></svg>
                  </div>
                  <div>
                    <h2 className="text-sm font-bold text-slate-500 uppercase">Productivity Trends</h2>
                    <p className="text-2xl font-bold text-slate-900">{data.productivityTrends}</p>
                  </div>
                </div>
                <div className="text-right">
                  <span className="rounded-lg bg-slate-100 px-3 py-1 text-xs font-bold text-slate-600">WEEKLY VIEW</span>
                </div>
              </div>
              <div className="mt-6 flex items-end gap-2 h-24">
                {[40, 70, 45, 90, 65, 80, 95].map((h, i) => (
                  <div key={i} className="flex-1 rounded-t-lg bg-orange-100 transition-all hover:bg-orange-400" style={{ height: `${h}%` }}></div>
                ))}
              </div>
            </div>

            {/* --- TASK COMPLETION RATE (PENGGANTI PERFORMANCE ANALYTIC) --- */}
            <div className="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
              <div className="flex items-center gap-4 mb-4">
                <div className="rounded-2xl bg-emerald-50 p-3 text-emerald-600">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"/><path d="m9 12 2 2 4-4"/></svg>
                </div>
                <h2 className="text-sm font-bold text-slate-500 uppercase">Task Completion</h2>
              </div>
              
              <div className="flex items-baseline gap-2">
                <p className="text-4xl font-bold text-slate-900">{data.taskCompletion.rate}</p>
                <span className="text-xs font-bold text-emerald-600">HIGH</span>
              </div>

              <div className="mt-6 space-y-4">
                <div>
                  <div className="flex justify-between text-xs font-bold mb-1 uppercase tracking-wide">
                    <span>Completed</span>
                    <span className="text-slate-900">{data.taskCompletion.completed}</span>
                  </div>
                  <div className="h-2 w-full rounded-full bg-slate-100">
                    <div className="h-full rounded-full bg-emerald-500 transition-all duration-500" style={{ width: data.taskCompletion.rate }}></div>
                  </div>
                </div>
                
                <div className="flex justify-between items-center pt-3 border-t border-slate-100">
                  <span className="text-xs text-slate-400 font-bold uppercase">Pending Tasks</span>
                  <span className="text-xs text-amber-600 font-bold">{data.taskCompletion.pending}</span>
                </div>
              </div>
            </div>

          </div>

          {/* SECURITY SECTION */}
          <div className="mt-8 rounded-[2.5rem] border border-slate-200 bg-white p-8 shadow-sm">
            <div className="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
              <div>
                <h2 className="text-xl font-bold text-slate-900">Security & Logs</h2>
                <p className="text-sm text-slate-500">Pemantauan insiden keamanan secara real-time.</p>
              </div>
              <div className="flex gap-3">
                <button onClick={() => setData(prev => ({...prev, attacks: []}))} className="rounded-xl border border-slate-300 px-5 py-2.5 text-xs font-bold text-slate-700 hover:bg-slate-100 transition">Clear Logs</button>
                <button className="rounded-xl bg-slate-900 px-5 py-2.5 text-xs font-bold text-white hover:bg-slate-800 transition">Export CSV</button>
              </div>
            </div>
            
            <div className="mt-8 overflow-hidden rounded-2xl border border-slate-100 bg-slate-50 p-6 text-center text-sm text-slate-400 font-medium">
              Belum ada log aktivitas keamanan terdeteksi.
            </div>
          </div>

        </div>
      </main>
    </div>
  ) 
}

export default Dashboard;