<?php
use App\Http\Controllers\CustomerController;

Route::get('/customer', [CustomerController::class, 'index'])->name('customer.list');
Route::get('/customer/create', [CustomerController::class, 'create'])->name('customer.create');
Route::get('/customer/edit/{id}', [CustomerController::class, 'edit'])->name('customer.edit');
Route::get('/customer/delete/{id}', [CustomerController::class, 'destroy'])->name('customer.delete');
Route::get('/customer/datatable', [CustomerController::class, 'dataDable'])->name('customer.datatable');
Route::get('/customer/select2', [CustomerController::class, 'select2'])->name('customer.select2');
