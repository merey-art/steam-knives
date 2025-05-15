Веб-приложение на Laravel для управления каталогом ножей, заказами и корзиной, с полной поддержкой Livewire и адаптивным дизайном на Tailwind CSS.

## Возможности
- Управление категориями и товарами (CRUD)
- Добавление товаров в корзину в реальном времени (Livewire)
- Оформление заказов с автоматической email-рассылкой
- Админ-панель с фильтрацией, поиском и статусами заказов
- Статичная и адаптивная верстка через Tailwind CSS

composer install
npm install && npm run build
cp .env.example .env
php artisan key:generate
php artisan migrate

Запуск локально

php artisan serve

Деплой на Render

Используйте Docker и настройте Start Command:

php artisan migrate --force && php artisan serve --host 0.0.0.0 --port $PORT
![smtp](https://github.com/user-attachments/assets/5d4a987b-8f31-44a1-b9f6-6f995f0b106c)
![test](https://github.com/user-attachments/assets/c392793c-a33e-4956-95a4-3b888ecf2a1c)
