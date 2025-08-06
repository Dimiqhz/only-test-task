# Only Test Task — Backend (Laravel)

Это репозиторий с API для бронирования служебных автомобилей. Фронтенд пока ещё доделываю =)

---

## 📦 Технологии

- PHP 8.1+  
- Laravel 12 
- MySQL / SQLite (для локальных тестов)  
- Docker & Docker Compose  
- Laravel Sanctum (session-based SPA auth)  

---

## 🚀 Быстрый старт

1. **Склонируйте репозиторий**  
   ```bash
   git clone https://github.com/Dimiqhz/only-test-task.git
   cd only-test-task
   ```

2. **Скопируйте .env**  
   ```bash
   cp .env.example .env
   ```
   Отредактируйте при необходимости параметры БД (по умолчанию MySQL в Docker).

3. **Соберите и поднимите контейнеры**  
   ```bash
   docker-compose up -d --build
   ```

4. **Установите PHP-зависимости**  
   ```bash
   docker-compose exec php composer install
   ```

5. **Установите JS-зависимости (для будущего фронтенда)**  
   ```bash
   docker-compose exec node npm install
   ```

6. **Сгенерируйте ключ Laravel**  
   ```bash
   docker-compose exec php php artisan key:generate
   ```

7. **Примените миграции и сиды**  
   ```bash
   docker-compose exec php php artisan migrate:fresh --seed
   ```

8. **(Опционально) Проверьте сиды в Tinker**  
   ```bash
   docker-compose exec php php artisan tinker
   >>> App\Models\ComfortCategory::all()->pluck('name','level');
   ```

---

## 🔐 Аутентификация (Laravel Sanctum)

1. **Получение CSRF-cookie**  
   ```bash
   curl -c cookie.txt http://localhost/sanctum/csrf-cookie
   ```
2. **Вход**  
   ```bash
   curl -b cookie.txt -c cookie.txt      -H "Content-Type: application/json"      -X POST http://localhost/api/login      -d '{"email":"test@example.com","password":"secret"}'
   ```
3. **Проверка текущего пользователя**  
   ```bash
   curl -b cookie.txt http://localhost/api/user
   ```
4. **Выход**  
   ```bash
   curl -b cookie.txt -X POST http://localhost/api/logout
   ```

> **Учётка для тестов**:  
> В Tinker создан пользователь  
> `test@example.com` / `secret`  

---

## 📑 API-эндпоинты

Все маршруты под префиксом `/api` и (кроме `/login`, `/sanctum/csrf-cookie`) защищены `auth:sanctum`.

| Метод | URI                          | Описание                                          |
|-------|------------------------------|---------------------------------------------------|
| GET   | `/sanctum/csrf-cookie`       | Установка CSRF-cookie для SPA                     |
| POST  | `/api/login`                 | Логин (email + password)                          |
| POST  | `/api/logout`                | Логаут                                           |
| GET   | `/api/user`                  | Данные текущего аутентифицированного пользователя |
| GET   | `/api/comfort-categories`    | Список всех категорий комфорта                    |
| GET   | `/api/available-cars`        | Список свободных машин (фильтры через query-string) |

**Параметры `/api/available-cars`:**

- `start_at` (required, ISO-datetime)  
- `end_at`   (required, ISO-datetime)  
- `model`    (optional, string)  
- `category` (optional, integer, `comfort_categories.id`)  

Пример:

```bash
curl -b cookie.txt   "http://localhost/api/available-cars?start_at=2025-08-07T09:00:00&end_at=2025-08-07T10:00:00"
```

---

## 🛠️ Структура проекта (корень `/backend`)

```
app/
  Http/
    Controllers/Api/
      AvailableCarsController.php
      ComfortCategoryController.php
      AuthController.php
    Requests/
      AvailableCarsRequest.php
  Models/
    Car.php
    CarModel.php
    ComfortCategory.php
    Driver.php
    Position.php
    Reservation.php
    User.php
database/
  migrations/
    *_create_positions_table.php
    *_create_comfort_categories_table.php
    *_create_comfort_category_position_table.php
    *_create_car_models_table.php
    *_create_cars_table.php
    *_create_drivers_table.php
    *_create_reservations_table.php
  seeders/
    DatabaseSeeder.php
routes/
  api.php
  web.php
```

---

## 🐳 Docker Compose

- **php** — PHP-FPM + Composer  
- **node** — Node/Vite (dev-сервер)  
- **nginx** — прокси: `/api` → PHP, всё остальное → Vite  
- **db** — MySQL 8.0  

Основные команды:

```bash
docker-compose build php nginx node
docker-compose up -d
docker-compose exec php artisan migrate:fresh --seed
docker-compose exec node npm run dev
```

---

## 📖 Дальнейшие шаги

- Допилить фронтенд на React 18 + Bootstrap 5  
- Собрать production-бандл `npm run build` и раздавать из `backend/public`  
- Покрыть тестами контроллеры и модели  

---
