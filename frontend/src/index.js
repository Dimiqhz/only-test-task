import React from 'react'
import ReactDOM from 'react-dom/client'
import 'bootstrap/dist/css/bootstrap.min.css'
import AvailableCarsPage from './pages/AvailableCarsPage'

const rootEl = document.getElementById('root')
const root = ReactDOM.createRoot(rootEl)
root.render(
    <React.StrictMode>
        <AvailableCarsPage />
    </React.StrictMode>
)
