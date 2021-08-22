<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
|
| Rota de autorização laravel
*/
Route::redirect('/home', '/');

/*
|--------------------------------------------------------------------------
| Rota para o Vue
|--------------------------------------------------------------------------
|
| Rota para chamar o Vue js
| Rota utilizada como fallback
*/
Route::fallback([HomeController::class, 'index']);
