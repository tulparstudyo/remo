<?php

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
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () { return view('dashboard'); })->name('dashboard');
    include_once('verde/customer.routes.php');
    include_once('verde/estate.routes.php');
    include_once('verde/meeting.routes.php');
    include_once('verde/user.routes.php');
    Blade::component('jetstream::components.textarea', 'jet-textarea');
    Blade::component('jetstream::components.select2', 'jet-select2');
    Blade::component('jetstream::components.datepicker', 'jet-datepicker');
});
