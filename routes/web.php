<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;

// DB::listen(function ($event) {
//     dump($event->sql);
// });



Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth']], function () {

    Route::get('/events', [EventController::class,'index'])->name('events.index')->middleware(['permission:Approve Borang Bilik Mesyuarat Teratai|Approve Borang Bilik Mesyuarat Lili']);
    Route::get('/event/create', [EventController::class,'create'])->name('events.create')->middleware(['role_or_permission:Pengurus Fasiliti|Approve Borang Bilik Mesyuarat Teratai|Approve Borang Bilik Mesyuarat Lili']);

    Route::post('/events/ajaxLoadEventsTbl', [EventController::class,'ajaxLoadEventsTbl'])->name('events.ajaxLoadEventsTbl');
    Route::get('/event/{event}', [EventController::class,'show'])->name('events.show');
    Route::get('/event/{event}/edit', [EventController::class,'edit'])->name('events.edit');
    Route::post('/event', [EventController::class,'store'])->name('events.store');
    Route::put('/event/{event}', [EventController::class,'update'])->name('events.update');
    Route::delete('/event/{event}', [EventController::class,'destroy'])->name('events.destroy');

    Route::get('/user',[UserController::class,'index'])->name('users.index')->middleware(['role_or_permission:Urus Pengguna']);
    Route::post('/user/assignRole',[UserController::class,'assignRole'])->name('users.assignRole')->middleware(['role_or_permission:Assign Role Pengguna']);
    Route::post('/user/removePermission',[UserController::class,'removePermission'])->name('roles.removePermission')->middleware(['role_or_permission:Assign Role Pengguna']);
    Route::post('/user/assignPermission',[UserController::class,'assignPermission'])->name('roles.assignPermission')->middleware(['role_or_permission:Assign Role Pengguna']);
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
