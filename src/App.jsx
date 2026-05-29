import { useState } from 'react'
import { Routes, Route, Navigate } from 'react-router-dom'
import Login from '../auth/Login'
import Register from '../auth/Register'
import Dashboard from '../components/Dashboard'
import Analytics from '../components/Analytics'
import Report from '../components/Report'
import Settings from '../components/Settings'
import NotificationOverlay from '../notification/NotificationOverlay'

function App() {
  const [user, setUser] = useState(null)

  // Simulasi fungsi login
  const handleLogin = ({ username, password }) => {
    if (username && password) {
      const newUser = { username }
      setUser(newUser)
      return { success: true }
    }
    return { success: false, message: 'Username dan password harus diisi' }
  }

  // Simulasi fungsi register
  const handleRegister = ({ username, email, password }) => {
    if (username && email && password) {
      return { success: true }
    }
    return { success: false, message: 'Semua field harus diisi' }
  }

  const handleLogout = () => {
    setUser(null)
  }

  return (
    <Routes>
      {/* Route Publik */}
      <Route 
        path="/login" 
        element={<Login onLogin={handleLogin} />} 
      />
      <Route 
        path="/register" 
        element={<Register onRegister={handleRegister} onLogin={handleLogin} />} 
      />

      {/* Route Terproteksi (Hanya bisa diakses jika sudah login) */}
      <Route 
        path="/dashboard" 
        element={user ? <Dashboard user={user} onLogout={handleLogout} /> : <Navigate to="/login" />} 
      />
      <Route 
        path="/analytics" 
        element={user ? <Analytics user={user} /> : <Navigate to="/login" />} 
      />

      <Route 
        path="/report" 
        element={user ? <Report user={user} /> : <Navigate to="/login" />} 
      />

      <Route
        path="/settings"
        element={user ? <Settings user={user} /> : <Navigate to="/login" />} 
      />

      <Route
        path="/notification/NotificationOverlay.jsx"
        element={user ? <NotificationOverlay /> : <Navigate to="/login" />} />
      
      {/* Redirect default ke Dashboard atau Login */}
      <Route 
        path="/" 
        element={<Navigate to={user ? "/dashboard" : "/login"} />} 
      />
    </Routes>
  )
}

export default App