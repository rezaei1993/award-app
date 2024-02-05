<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Project

This Laravel application is designed to implement a lucky wheel feature for attracting users to participate in festivals or events. The lucky wheel consists of various prizes, each with a different probability of being selected. The goal is to allow users to spin the wheel based on their accumulated points and win prizes accordingly.
 
# Installation
- `composer install`
- `php artisan migrate:fresh --seed`

## Testing

Unit tests have been written for this project and can be found in the path: \
`php artisan test --filter Modules\\Award\\tests\\Feature\\V1\\Front\\AwardTest`

## Award App API Endpoints
To access the API endpoints, navigate to the following path: \
```\Modules\Award\routes\V1\api.php```


## Questions

Q1: What solution do you propose for handling frequent and consecutive user requests? \
A1: Using Laravel's built-in `throttle` middleware to limit the number of requests a user can make within a specified time frame.

Q2: How do you handle simultaneous requests from two users for the last remaining item of a prize?\
A2: Implement record locking mechanisms, such as using Laravel's `lockForUpdate` method, to ensure only one user can claim 
the last item by preventing simultaneous modifications to the record.





