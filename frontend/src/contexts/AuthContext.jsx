import React, { createContext, useState, useEffect } from 'react'
import axios from 'axios'

axios.defaults.withCredentials = true 

/**
 * @typedef {Object} AuthContextValue
 * @property {Object|null} user — данные текущего пользователя
 * @property {boolean} loading — флаг загрузки пользователя
 * @property {(email:string,password:string)=>Promise<void>} login — функция входа
 * @property {()=>Promise<void>} logout — функция выхода
 */

export const AuthContext = createContext(/** @type {AuthContextValue|null} */(null))

/**
 * Провайдер аутентификации: хранит состояние юзера и методы входа/выхода.
 * @param {{ children: React.ReactNode }} props
 */
export function AuthProvider({ children }) {
    const [user, setUser] = useState(null)
    const [loading, setLoading] = useState(true)

    useEffect(() => {
        axios.get('/sanctum/csrf-cookie')
            .then(() => axios.get('/api/user'))
            .then(res => setUser(res.data))
            .catch(() => setUser(null))
            .finally(() => setLoading(false))
    }, [])

    /** @param {string} email @param {string} password */
    const login = async (email, password) => {
        await axios.get('/sanctum/csrf-cookie')
        const res = await axios.post('/api/login', { email, password })
        setUser(res.data.user)
    }

    const logout = async () => {
        await axios.post('/api/logout')
        setUser(null)
    }

    return (
        <AuthContext.Provider value={{ user, loading, login, logout }}>
            {children}
        </AuthContext.Provider>
    )
}
