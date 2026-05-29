import { useState } from 'react'
import { Link } from 'react-router-dom'
const initialReportData = [
  { id: 'USR-882', date: '2026-05-20', category: 'Security', task: 'Brute Force Attempt detected from IP 192.168.1.1', status: 'Flagged', user: 'Unknown/Attacker' },
  { id: 'USR-420', date: '2026-05-19', category: 'Study', task: 'Scraping Data Instagram BPJS', status: 'Active', user: 'Ferdi' },
  { id: 'USR-128', date: '2026-05-19', category: 'Personal', task: 'Akses Berlebihan ke API', status: 'Warning', user: 'User_X' },
  { id: 'USR-004', date: '2026-05-18', category: 'Work', task: 'Integrasi Supabase Auth', status: 'Active', user: 'Admin_Dev' },
]

function Report() {
  const [reports, setReports] = useState(initialReportData)

  const handleBlockUser = (id, userName) => {
    const confirmBlock = window.confirm(`Apakah Anda yakin ingin memblokir akses dan menghapus data sesi untuk ${userName}?`);
    
    if (confirmBlock) {
      // Simulasi penghapusan data dari state
      const updatedReports = reports.filter(item => item.id !== id);
      setReports(updatedReports);
      alert(`User ${userName} telah diblokir dan akses diputus.`);
    }
  }

  return (
    <div id="Report" className="flex min-h-screen bg-slate-50 text-slate-900">
      {/* Sidebar tetap sama seperti sebelumnya */}
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

      <main className="flex-1 px-6 py-8">
        <div className="mx-auto max-w-6xl">
          
          <div className="mb-8 flex flex-col justify-between gap-4 rounded-[2.5rem] border border-slate-200 bg-white p-8 shadow-sm md:flex-row md:items-center">
            <div>
              <p className="text-xs uppercase tracking-widest text-red-500 font-bold">Security Monitor</p>
              <h1 className="mt-1 text-3xl font-bold text-slate-900">User Access Control</h1>
            </div>
          </div>

          <div className="overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-sm">
            <div className="overflow-x-auto">
              <table className="w-full text-left">
                <thead>
                  <tr className="border-b border-slate-100 bg-slate-50/50">
                    <th className="px-8 py-5 text-xs font-bold uppercase text-slate-500">User / ID</th>
                    <th className="px-8 py-5 text-xs font-bold uppercase text-slate-500">Activity</th>
                    <th className="px-8 py-5 text-xs font-bold uppercase text-slate-500">Status</th>
                    <th className="px-8 py-5 text-xs font-bold uppercase text-slate-500 text-center">Action</th>
                  </tr>
                </thead>
                <tbody className="divide-y divide-slate-100">
                  {reports.map((item) => (
                    <tr key={item.id} className="hover:bg-slate-50 transition-colors">
                      <td className="px-8 py-5">
                        <p className="text-sm font-bold text-slate-900">{item.user}</p>
                        <p className="text-[10px] text-slate-400 font-mono">{item.id}</p>
                      </td>
                      <td className="px-8 py-5">
                        <p className="text-sm text-slate-700">{item.task}</p>
                        <p className="text-[10px] text-slate-400">{item.date}</p>
                      </td>
                      <td className="px-8 py-5">
                        <span className={`inline-block rounded-full px-3 py-1 text-[10px] font-bold uppercase ${
                          item.status === 'Flagged' ? 'bg-red-100 text-red-600' : 
                          item.status === 'Warning' ? 'bg-amber-100 text-amber-600' : 'bg-emerald-100 text-emerald-600'
                        }`}>
                          {item.status}
                        </span>
                      </td>
                      <td className="px-8 py-5 text-center">
                        <button 
                          onClick={() => handleBlockUser(item.id, item.user)}
                          className="rounded-xl bg-red-50 px-4 py-2 text-xs font-bold text-red-600 hover:bg-red-600 hover:text-white transition-all"
                        >
                          Block Access
                        </button>
                      </td>
                    </tr>
                  ))}
                </tbody>
              </table>
            </div>
          </div>
          
          {reports.length === 0 && (
            <div className="mt-10 text-center p-10 border-2 border-dashed border-slate-200 rounded-[2rem]">
              <p className="text-slate-400 font-medium">Semua ancaman telah diatasi atau tidak ada user aktif.</p>
            </div>
          )}
        </div>
      </main>
    </div>
  )
}

export default Report