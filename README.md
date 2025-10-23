# API Data Fetcher Project

## Database Access

**CP:** https://cpanel.ezyro.com  
**Username:** ezyro_40238896  
**Password:** df29f9  
**Database:** ezyro_40238896_apidatafetcher  

## Database Tables

- `sales` - данные о продажах
- `orders` - данные о заказах  
- `stocks` - данные о складах
- `incomes` - данные о доходах

## Использование

```php
// app/Services/ApiService.php

private $baseUrl = ''; // Хост:Порт
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
