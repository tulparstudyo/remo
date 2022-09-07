<?php
use \App\Http\Controllers\UserController;

Route::get('/user/select2', [UserController::class, 'select2'])->name('user.select2');
Route::get('/user/list', [UserController::class, 'index'])->name('user.list');
Route::get('/available_times', [UserController::class, 'available_times'])->name('available_times');
