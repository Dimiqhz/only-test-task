import React, { useEffect, useState } from 'react'
import { fetchAvailableCars, fetchComfortCategories } from '../api/cars'
import FilterForm from '../components/FilterForm'
import CarCard from '../components/CarCard'

export default function AvailableCarsPage() {
    const [cars, setCars]           = useState([])
    const [categories, setCategories] = useState([])
    const [loading, setLoading]     = useState(false)
    const [error, setError]         = useState(null)

    useEffect(() => {
        fetchComfortCategories()
            .then(res => setCategories(res.data.data || res.data))
            .catch(() => setCategories([]))
    }, [])

    const handleFilter = filters => {
        setLoading(true)
        setError(null)
        fetchAvailableCars(filters)
            .then(res => {
                setCars(res.data.data)
            })
            .catch(err => {
                console.error(err)
                setError('Не удалось загрузить данные. Попробуйте снова.')
            })
            .finally(() => setLoading(false))
    }

    return (
        <div className="container py-4">
            <h1 className="mb-4">Доступные служебные автомобили</h1>

            <FilterForm onFilter={handleFilter} categories={categories} />

            {loading && <p>Загрузка…</p>}
            {error   && <div className="alert alert-danger">{error}</div>}

            {/* Список машин */}
            {(!loading && cars.length === 0) && (
                <p>Нет доступных машин по заданным параметрам.</p>
            )}
            {cars.map(car => (
                <CarCard key={car.id} car={car} />
            ))}
        </div>
    )
}
