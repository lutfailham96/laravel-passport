<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Quick Start
- Configure database on .env
- Run database seeder via artisan
```commandline
php artisan db:seed
```
- Run the development server
```commandline
php artisan serve
```

## Endpoint
- /api/user/register [POST]
- /api/user/register [POST]
```json
{
  "email": "user@email.com",
  "password": "12345678"
}
```
- /api/college-student [GET]
- /api/college-student [POST]
```json
{
    "name": "Lutfa Ilham",
    "email": "lutfailham@nocta.my.id",
    "address": "Cepu, Blora, Jawa Tengah",
    "phone": "08xxxxxxxxxxx"
}
```
- /api/college-student/:uuid [GET]
- /api/college-student/:uuid [PUT]
```json
{
    "name": "Lutfa Ilham",
    "address": "Cepu, Blora, Jawa Tengah",
    "phone": "08xxxxxxxxxxx"
}
```

## About Author
- **[Lutfa Ilham](https://facebook.com/lutfa.ibtihajiilham)**

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
