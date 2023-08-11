<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/book', [BookController::class, 'showBook']);

Route::middleware('guest')->group(function () {
    // отображение формы регистрации
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    // прием данных с формы регистрации
    Route::post('register', [RegisteredUserController::class, 'store']);

    // отображение формы логина
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    // прием данных с формы логина
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

// группа роутеров для тех пользователей, кто успешно вошел в свой аккаунт
Route::middleware('auth')->group(function () {
    // роутер для выхода из своего аккаунта
    Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});

Route::view('auth', 'auth');
Route::view('guest', 'auth')->middleware('guest'); // только для гостей

// роуты с примерами авторизации
Route::get('products', [ProductController::class, 'index']);
Route::get('products/{product}', [ProductController::class, 'show']);
Route::get('products/{product}/edit', [ProductController::class, 'edit']);

// создание политики:
// php artisan make:policy TestPolicy
// или сразу для модели
// php artisan make:policy ProductPolicy --model=Product

// роутер доступный только для тех у кого есть право "is-admin"
Route::get('secret', function () {
    echo 'secret';
})->can('is-admin');

// то же самое
Route::get('secret-middleware', function () {
    echo 'secret middleware';
})->middleware('can:is-admin');