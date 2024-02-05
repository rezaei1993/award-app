<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Award\App\Http\Controllers\V1\Front\AwardController;
use Modules\Award\App\Http\Middleware\LoginRandomUserMiddleware;

/*
    |--------------------------------------------------------------------------
    | API Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register API routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | is assigned the "api" middleware group. Enjoy building your API!
    |
*/

Route::get('lucky-wheel', AwardController::class)->name('lucky-wheel')
    ->middleware([LoginRandomUserMiddleware::class, 'throttle:5,1']);

