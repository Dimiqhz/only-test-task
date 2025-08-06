import React, { useState } from 'react'
import PropTypes from 'prop-types'

/**
 * Форма фильтрации: дата/время, модель, категория
 * @param {{
 *   onFilter: (filters: { start_at: string, end_at: string, model?: string, category?: number }) => void,
 *   categories: Array<{ id: number, name: string }>
 * }} props
 */
export default function FilterForm({ onFilter, categories }) {
    const now = new Date().toISOString().slice(0,16)
    const later = new Date(Date.now() + 3600*1000).toISOString().slice(0,16) // +1 час

    const [startAt, setStartAt] = useState(now)
    const [endAt, setEndAt]     = useState(later)
    const [model, setModel]     = useState('')
    const [category, setCategory] = useState('')

    const handleSubmit = e => {
        e.preventDefault()
        onFilter({
            start_at: startAt,
            end_at: endAt,
            ...(model.trim() ? { model: model.trim() } : {}),
            ...(category ? { category: Number(category) } : {}),
        })
    }

    return (
        <form className="mb-4" onSubmit={handleSubmit}>
            <div className="row g-3 align-items-end">
                {/* Дата/время начала */}
                <div className="col-md-3">
                    <label className="form-label">Начало</label>
                    <input
                        type="datetime-local"
                        className="form-control"
                        value={startAt}
                        onChange={e => setStartAt(e.target.value)}
                        required
                    />
                </div>
                {/* Дата/время конца */}
                <div className="col-md-3">
                    <label className="form-label">Конец</label>
                    <input
                        type="datetime-local"
                        className="form-control"
                        value={endAt}
                        onChange={e => setEndAt(e.target.value)}
                        required
                    />
                </div>
                {/* Фильтр по модели */}
                <div className="col-md-3">
                    <label className="form-label">Модель (часть названия)</label>
                    <input
                        type="text"
                        className="form-control"
                        placeholder="Например, Camry"
                        value={model}
                        onChange={e => setModel(e.target.value)}
                    />
                </div>
                {/* Фильтр по категории */}
                <div className="col-md-2">
                    <label className="form-label">Категория</label>
                    <select
                        className="form-select"
                        value={category}
                        onChange={e => setCategory(e.target.value)}
                    >
                        <option value="">Все</option>
                        {categories.map(cat => (
                            <option key={cat.id} value={cat.id}>{cat.name}</option>
                        ))}
                    </select>
                </div>
                {/* Кнопка отправки */}
                <div className="col-md-1 text-end">
                    <button type="submit" className="btn btn-primary w-100">Показать</button>
                </div>
            </div>
        </form>
    )
}

FilterForm.propTypes = {
    onFilter: PropTypes.func.isRequired,
    categories: PropTypes.arrayOf(PropTypes.shape({
        id:   PropTypes.number.isRequired,
        name: PropTypes.string.isRequired,
    })).isRequired,
}
