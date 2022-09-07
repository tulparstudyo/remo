<?php
use \App\Http\Controllers\EstateController;

Route::get('/estate', [EstateController::class, 'index'])->name('estate.list');
Route::get('/estate/create', [EstateController::class, 'create'])->name('estate.create');
Route::get('/estate/edit/{id}', [EstateController::class, 'edit'])->name('estate.edit');
Route::get('/estate/delete/{id}', [EstateController::class, 'destroy'])->name('estate.delete');
Route::get('/estate/datatable', [EstateController::class, 'dataDable'])->name('estate.datatable');
Route::get('/estate/select2', [EstateController::class, 'select2'])->name('estate.select2');
