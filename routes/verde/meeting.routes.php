<?php
use \App\Http\Controllers\MeetingController;

Route::get('/meeting', [MeetingController::class, 'index'])->name('meeting.list');
Route::get('/meeting/create', [MeetingController::class, 'create'])->name('meeting.create');
Route::get('/meeting/edit/{id}', [MeetingController::class, 'edit'])->name('meeting.edit');
Route::get('/meeting/delete/{id}', [MeetingController::class, 'destroy'])->name('meeting.delete');
Route::get('/meeting/datatable', [MeetingController::class, 'dataDable'])->name('meeting.datatable');
Route::get('/meeting/select2', [MeetingController::class, 'select2'])->name('meeting.select2');
Route::get('/meeting/test', [MeetingController::class, 'test'])->name('meeting.test');
