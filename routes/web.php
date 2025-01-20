<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NewsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});




Route::get('admin/dashboard',[DashboardController::class,'dashboardPage'])->name('dashboard');
Route::get('admin/create/News',[NewsController::class,'index'])->name('createNews');






