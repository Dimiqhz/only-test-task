import axios from 'axios'

const api = axios.create({
    baseURL: '/api',
    headers: {
        'Accept': 'application/json',
    },
})

/**
 * Получить массив доступных машин
 * @param {{ start_at: string, end_at: string, model?: string, category?: number }} params
 */
export function fetchAvailableCars(params) {
    return api.get('available-cars', { params })
}

/**
 * Получить список всех категорий комфорта
 * (предполагается, что есть backend‐эндпоинт /api/comfort-categories)
 */
export function fetchComfortCategories() {
    return api.get('comfort-categories')
}
