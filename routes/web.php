<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\News_articleController;
use Illuminate\Support\Facades\Route;

use function Pest\Laravel\get;

Route::get('/', function () {
    return view('welcome');
});




Route::get('admin/dashboard',[DashboardController::class,'dashboardPage'])->name('dashboard');
Route::get('admin/list/news',[News_articleController::class,'index'])->name('news.index');
Route::get('admin/create/news',[News_articleController::class,'create'])->name('news.create');
Route::get('admin/edit/{id}/news',[News_articleController::class,'edit'])->name('news.edit');
Route::get('admin/view/{id}/news',[News_articleController::class,'show'])->name('news.show');




