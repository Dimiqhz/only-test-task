import React, { useState, useContext } from 'react'
import { useNavigate } from 'react-router-dom'
import { AuthContext } from '../contexts/AuthContext'

export default function LoginPage() {
    const [email, setEmail] = useState('')
    const [password, setPassword] = useState('')
    const [error, setError] = useState('')
    const { login } = useContext(AuthContext)
    const nav = useNavigate()

    const handleSubmit = async e => {
        e.preventDefault()
        setError('')
        try {
            await login(email, password)
            nav('/', { replace: true })
        } catch {
            setError('Неверный email или пароль')
        }
    }

    return (
        <div className="d-flex justify-content-center align-items-center vh-100">
            <form className="card p-4" style={{minWidth: '320px'}} onSubmit={handleSubmit}>
                <h3 className="mb-3">Вход</h3>
                {error && <div className="alert alert-danger">{error}</div>}
                <div className="mb-3">
                    <label className="form-label">Email</label>
                    <input
                        type="email"
                        className="form-control"
                        required
                        value={email}
                        onChange={e => setEmail(e.target.value)}
                    />
                </div>
                <div className="mb-3">
                    <label className="form-label">Пароль</label>
                    <input
                        type="password"
                        className="form-control"
                        required
                        value={password}
                        onChange={e => setPassword(e.target.value)}
                    />
                </div>
                <button type="submit" className="btn btn-primary w-100">Войти</button>
            </form>
        </div>
    )
}
