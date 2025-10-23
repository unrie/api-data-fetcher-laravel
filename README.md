# API Data Fetcher Project

## Database Tables

- `sales` - данные о продажах
- `orders` - данные о заказах  
- `stocks` - данные о складах
- `incomes` - данные о доходах

## Использование

```php
// app/Services/ApiService.php

private $baseUrl = ''; // Хост
private $key = ''; // Ключ
```

```bash
# Выгрузка всех данных за период
php artisan fetch:all XXXX-XX-XX XXXX-XX-XX

# Выгрузка отдельных данных
php artisan fetch:sales XXXX-XX-XX XXXX-XX-XX
php artisan fetch:orders XXXX-XX-XX XXXX-XX-XX
php artisan fetch:stocks XXXX-XX-XX XXXX-XX-XX
php artisan fetch:incomes XXXX-XX-XX XXXX-XX-XX
