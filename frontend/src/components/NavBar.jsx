import React, { useContext } from 'react'
import { Link, useNavigate } from 'react-router-dom'
import { AuthContext } from '../contexts/AuthContext'

export default function NavBar() {
    const { user, logout } = useContext(AuthContext)
    const nav = useNavigate()

    const handleLogout = async () => {
        await logout()
        nav('/login')
    }

    return (
        <nav className="navbar navbar-expand-lg navbar-light bg-light">
            <div className="container">
                <Link className="navbar-brand" to="/">CarReserve</Link>
                <div className="collapse navbar-collapse">
                    <ul className="navbar-nav ms-auto">
                        {user ? (
                            <>
                                <li className="nav-item">
                                    <span className="nav-link">Привет, {user.name}</span>
                                </li>
                                <li className="nav-item">
                                    <button className="btn btn-outline-secondary" onClick={handleLogout}>
                                        Выйти
                                    </button>
                                </li>
                            </>
                        ) : (
                            <li className="nav-item">
                                <Link className="nav-link" to="/login">Войти</Link>
                            </li>
                        )}
                    </ul>
                </div>
            </div>
        </nav>
    )
}
