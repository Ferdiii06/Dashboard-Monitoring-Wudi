
import  { useState } from 'react'
import { useNavigate } from 'react-router-dom'

function Register({ onRegister, onLogin }) {
    const [username, setUsername] = useState('')
    const [email, setEmail] = useState('')
    const [password, setPassword] = useState('')
    const [error, setError] = useState(null)
    const navigate = useNavigate()

    const handleSubmit = (e) => {
        e.preventDefault()
        if (!onRegister) return
        const res = onRegister({ username, email, password })
        if (res?.success) {
            if (onLogin) {
                const lr = onLogin({ username, password })
                if (lr?.success) {
                    navigate('/dashboard')
                    return
                }
            }
            navigate('/login')
        } else {
            setError(res?.message || 'Registrasi gagal')
        }
    }

    return (
    <div className="min-h-screen bg-[#fff2dc] flex items-center justify-center p-4">
        <form onSubmit={handleSubmit} className="bg-[#fff8e7] p-8 rounded-3xl shadow-lg flex flex-col gap-5 w-full max-w-md">
            <h1 className="text-2xl font-bold text-gray-900 text-center">Register</h1>
            <input className="border border-gray-300 rounded-lg p-3 bg-white" type="text" name="username" placeholder="Username" value={username} onChange={(e)=>setUsername(e.target.value)} />
            <input className="border border-gray-300 rounded-lg p-3 bg-white" type="email" name="email" placeholder="Email" value={email} onChange={(e)=>setEmail(e.target.value)} />
            <input className="border border-gray-300 rounded-lg p-3 bg-white" type="password" name="password" placeholder="Password" value={password} onChange={(e)=>setPassword(e.target.value)} />
            <button className="bg-yellow-950 text-white p-3 rounded-lg font-semibold" type="submit">Register</button>
            {error && <p className="text-sm text-red-600 text-center">{error}</p>}
        </form>
    </div>
    );
}
export default Register;