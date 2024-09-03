# Тестовое задание "Информатика и Сервис"

## Описание

### Это проект на Laravel 11 с использованием Vue 3, включающий форму подачи заявки и управление лидами.

## Требования
- PHP 8.2
- Composer
- Node.js 22.6
- База данных MySQL/SQLite

## Установка

### 1. Клонирование репозитория
```
git clone https://github.com/VSartVs/test_task.git
cd test_task
```
### 2. Установка зависимостей
```
composer install
npm install
```

### 3. Настройка .env
Скопируйте файл .env.example в .env
```
copy .env.example .env # Windows
cp .env.example .env # Linux
```
Настройте параметры SMTP для отправки писем:
- MAIL_MAILER
- MAIL_HOST
- MAIL_PORT
- MAIL_USERNAME
- MAIL_PASSWORD
- MAIL_ENCRYPTION
- MAIL_FROM_ADDRESS
- MAIL_FROM_NAME

Настройте параметры для подключения базы данных при использовании MySQL:
- DB_DATABASE
- DB_USERNAME
- DB_PASSWORD

При использовании SQLite:
- DB_CONNECTION=sqlite

### 4. Генерация ключа и очистка кэша
```
php artisan key:generate
php artisan optimize
```
### 5. Запуск миграций и сидеров
```
php artisan migrate
php artisan db:seed --class=LeadStatusSeeder
```
### 6. Запуск сервера 
```
php artisan serve
```
### 7. Запуск фронта
Для разработки
```
npm run dev
```
Для продакшн-сборки
```
npm run build
```
