<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Route::get('login', LoginController::class)->name('login');

Route::group([], function() {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::get('/contacts', [\App\Http\Controllers\ContactsController::class, 'create'])->name('contacts.create');

    Route::get('/messages/create', [\App\Http\Controllers\MessagesController::class, 'create'])->name('messages.create');
});
