## Установка и настройка

### 1. Установка зависимостей
```
composer install
```

### 2. Настройка файла окружения
Скопируйте пример окружения:
```
cp .env.example .env
```
Настройте параметры подключения к базе данных:
```
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=Sales_AI
DB_USERNAME="db_user"
DB_PASSWORD="db_password"
```

### 3. Генерация ключа приложения
```
php artisan key:generate
```

### 4. Запуск миграций и сидов

```
php artisan migrate
php artisan db:seed # если нужно добавить тестовые данные
```

### 5. Установка Node-пакетов
```
npm install
```

### 6. Работа с Pusher и WebSocket
Проверьте `.env` на наличие параметров подключения:
```
PUSHER_APP_ID=local
PUSHER_APP_KEY=local
PUSHER_APP_SECRET=local
PUSHER_HOST=127.0.0.1
PUSHER_PORT=6001
PUSHER_SCHEME=http
PUSHER_APP_CLUSTER=mt1
```

## Запуск локального сервера Laravel

По умолчанию сервер будет доступен по адресу: [localhost:8000](http://localhost:8000)
## Проверка работы

- API маршруты начинаются с `/api/` (если используются стандартные маршруты из `routes/api.php`).
- Используйте Postman или любой HTTP-клиент для тестирования endpoint-ов.
