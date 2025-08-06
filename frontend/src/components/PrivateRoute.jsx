import React, { useContext } from 'react'
import { Navigate } from 'react-router-dom'
import { AuthContext } from '../contexts/AuthContext'

/**
 * Оборачивает защищённые маршруты.
 * Показывает <Navigate> на /login, если нет user.
 * @param {{ children: JSX.Element }} props
 */
export default function PrivateRoute({ children }) {
    const auth = useContext(AuthContext)

    if (auth.loading) {
        return <p className="text-center mt-5">Проверка сессии…</p>
    }

    return auth.user ? children : <Navigate to="/login" replace />
}
