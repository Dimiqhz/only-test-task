import React from 'react'
import PropTypes from 'prop-types'

/**
 * Отображает одну машину
 * @param {{ car: {
 *   id: number,
 *   model: string,
 *   category: string,
 *   license: string,
 *   driver_name: string,
 *   driver_phone: string
 * }}} props
 */
export default function CarCard({ car }) {
    return (
        <div className="card mb-3">
            <div className="card-body">
                <h5 className="card-title">{car.model}</h5>
                <h6 className="card-subtitle mb-2 text-muted">Категория: {car.category}</h6>
                <p className="card-text">
                    <strong>Номер:</strong> {car.license}<br/>
                    <strong>Водитель:</strong> {car.driver_name}<br/>
                    <strong>Контакт:</strong> {car.driver_phone || '—'}
                </p>
            </div>
        </div>
    )
}

CarCard.propTypes = {
    car: PropTypes.shape({
        id:           PropTypes.number.isRequired,
        model:        PropTypes.string.isRequired,
        category:     PropTypes.string.isRequired,
        license:      PropTypes.string.isRequired,
        driver_name:  PropTypes.string.isRequired,
        driver_phone: PropTypes.string,
    }).isRequired,
}
