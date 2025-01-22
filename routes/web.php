<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NewsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});




Route::get('admin/dashboard',[DashboardController::class,'dashboardPage'])->name('dashboard');
Route::get('admin/create/news',[NewsController::class,'create'])->name('news.create');
Route::get('admin/update/news',[NewsController::class,'edit'])->name('news.edit');





