import { useState } from 'react'


const initialNotifications = [
  { 
    id: 1, 
    type: 'security', 
    title: 'Ancaman Terdeteksi', 
    desc: 'Upaya brute force dari IP 182.1.xx.xx telah diblokir.', 
    time: '2 menit yang lalu',
    priority: 'high'
  },
  { 
    id: 2, 
    type: 'analytics', 
    title: 'Target Tercapai!', 
    desc: 'Produktivitas mingguan Anda naik 12% dibanding bulan lalu.', 
    time: '1 jam yang lalu',
    priority: 'normal'
  },
  { 
    id: 3, 
    type: 'system', 
    title: 'Update Berhasil', 
    desc: 'Integrasi Gemini API kini lebih stabil.', 
    time: '3 jam yang lalu',
    priority: 'low'
  }
]

function NotificationOverlay({ isOpen, onClose }) {
  const [list, setList] = useState(initialNotifications)

  if (!isOpen) return null

  return (
    <div className="absolute right-6 top-20 z-50 w-80 rounded-[2rem] border border-slate-200 bg-white/80 p-4 shadow-2xl backdrop-blur-xl animate-in fade-in zoom-in duration-200">
      <div className="mb-4 flex items-center justify-between px-2">
        <h3 className="text-sm font-bold text-slate-900">Notifications</h3>
        <button onClick={() => setList([])} className="text-[10px] font-bold uppercase text-slate-400 hover:text-red-500">Clear All</button>
      </div>

      <div className="space-y-3 max-h-[400px] overflow-y-auto pr-1">
        {list.length === 0 ? (
          <p className="py-8 text-center text-xs text-slate-400 font-medium">Tidak ada notifikasi baru.</p>
        ) : (
          list.map((n) => (
            <div key={n.id} className="group relative rounded-2xl border border-slate-100 bg-white p-4 hover:border-yellow-200 hover:bg-yellow-50/30 transition-all">
              <div className="flex items-start gap-3">
                <div className={`mt-1 h-2 w-2 shrink-0 rounded-full ${
                  n.type === 'security' ? 'bg-red-500 shadow-[0_0_8px_rgba(239,68,68,0.5)]' : 
                  n.type === 'analytics' ? 'bg-emerald-500' : 'bg-blue-500'
                }`}></div>
                <div>
                  <p className="text-xs font-bold text-slate-900">{n.title}</p>
                  <p className="mt-1 text-[11px] leading-relaxed text-slate-500">{n.desc}</p>
                  <p className="mt-2 text-[9px] font-medium text-slate-400 uppercase tracking-tighter">{n.time}</p>
                </div>
              </div>
            </div>
          ))
        )}
      </div>

      <button 
        onClick={onClose}
        className="mt-4 w-full rounded-xl py-2 text-xs font-bold text-slate-400 hover:bg-slate-100 transition"
      >
        Close
      </button>
    </div>
  )
}

export default NotificationOverlay;