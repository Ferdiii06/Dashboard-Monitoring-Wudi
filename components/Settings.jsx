import { useState } from 'react'
import { Link } from 'react-router-dom'
function Settings({ user }) {
  const [profile, setProfile] = useState({
    name: user?.username || 'Ferdi',
    email: user?.email || 'ferdi@pens.ac.id',
    role: 'Administrator'
  })

  const [notifications, setNotifications] = useState({
    emailAlerts: true,
    securityAlerts: true,
    systemUpdate: false
  })

  return (
    <div id="Settings" className="flex min-h-screen bg-slate-50 text-slate-900">
      {/* Sidebar Placeholder */}
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

      <main className="flex-1 px-6 py-8 overflow-y-auto">
        <div className="mx-auto max-w-4xl">
          
          <div className="mb-8">
            <h1 className="text-3xl font-bold text-slate-900">Settings</h1>
            <p className="text-slate-500">Kelola preferensi akun dan konfigurasi sistem WUDI.</p>
          </div>

          <div className="space-y-6">
            
            {/* PROFILE SECTION */}
            <section className="rounded-[2rem] border border-slate-200 bg-white p-8 shadow-sm">
              <h2 className="text-lg font-bold mb-6 flex items-center gap-2">
                <span className="h-2 w-2 rounded-full bg-yellow-600"></span>
                Admin Profile
              </h2>
              <div className="grid gap-6 md:grid-cols-2">
                <div className="space-y-2">
                  <label className="text-xs font-bold text-slate-500 uppercase">Username</label>
                  <input 
                    type="text" 
                    value={profile.name}
                    onChange={(e) => setProfile({...profile, name: e.target.value})}
                    className="w-full rounded-xl border border-slate-200 bg-slate-50 p-3 text-sm focus:ring-2 focus:ring-yellow-900 focus:outline-none" 
                  />
                </div>
                <div className="space-y-2">
                  <label className="text-xs font-bold text-slate-500 uppercase">Email Address</label>
                  <input 
                    type="email" 
                    value={profile.email}
                    onChange={(e) => setProfile({...profile, email: e.target.value})}
                    className="w-full rounded-xl border border-slate-200 bg-slate-50 p-3 text-sm focus:ring-2 focus:ring-yellow-900 focus:outline-none" 
                  />
                </div>
              </div>
            </section>

            {/* SECURITY & API CONFIG */}
            <section className="rounded-[2rem] border border-slate-200 bg-white p-8 shadow-sm">
              <h2 className="text-lg font-bold mb-6 flex items-center gap-2">
                <span className="h-2 w-2 rounded-full bg-red-500"></span>
                System & API Keys
              </h2>
              <div className="space-y-4">
                <div className="flex flex-col gap-2">
                  <label className="text-xs font-bold text-slate-500 uppercase">Gemini AI API Key</label>
                  <input 
                    type="password" 
                    placeholder="••••••••••••••••"
                    className="w-full rounded-xl border border-slate-200 bg-slate-50 p-3 text-sm font-mono focus:ring-2 focus:ring-yellow-900 focus:outline-none" 
                  />
                </div>
                <div className="flex flex-col gap-2">
                  <label className="text-xs font-bold text-slate-500 uppercase">Supabase Service Role Key</label>
                  <input 
                    type="password" 
                    placeholder="••••••••••••••••"
                    className="w-full rounded-xl border border-slate-200 bg-slate-50 p-3 text-sm font-mono focus:ring-2 focus:ring-yellow-900 focus:outline-none" 
                  />
                </div>
              </div>
            </section>

            {/* NOTIFICATIONS SWITCH */}
            <section className="rounded-[2rem] border border-slate-200 bg-white p-8 shadow-sm">
              <h2 className="text-lg font-bold mb-6">Notifications</h2>
              <div className="space-y-4">
                <div className="flex items-center justify-between py-2">
                  <div>
                    <p className="text-sm font-bold">Security Alerts</p>
                    <p className="text-xs text-slate-500">Dapatkan notifikasi jika terdeteksi penyerangan atau brute force.</p>
                  </div>
                  <input 
                    type="checkbox" 
                    checked={notifications.securityAlerts}
                    onChange={() => setNotifications({...notifications, securityAlerts: !notifications.securityAlerts})}
                    className="h-5 w-5 accent-yellow-950"
                  />
                </div>
                <div className="flex items-center justify-between py-2 border-t border-slate-50">
                  <div>
                    <p className="text-sm font-bold">System Maintenance</p>
                    <p className="text-xs text-slate-500">Beritahu saya mengenai pembaruan sistem dan downtime.</p>
                  </div>
                  <input 
                    type="checkbox" 
                    checked={notifications.systemUpdate}
                    onChange={() => setNotifications({...notifications, systemUpdate: !notifications.systemUpdate})}
                    className="h-5 w-5 accent-yellow-950"
                  />
                </div>
              </div>
            </section>

            {/* ACTION BUTTONS */}
            <div className="flex justify-end gap-4 pb-10">
              <button className="rounded-xl px-6 py-3 text-sm font-bold text-slate-500 hover:text-slate-800 transition">Discard Changes</button>
              <button className="rounded-2xl bg-yellow-950 px-8 py-3 text-sm font-bold text-white hover:bg-yellow-900 transition-all shadow-lg shadow-yellow-950/20 active:scale-95">
                Save Settings
              </button>
            </div>

          </div>
        </div>
      </main>
    </div>
  )
}

export default Settings