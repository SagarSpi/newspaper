<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\News_articleController;
use Cloudinary\Transformation\Rotate;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});




Route::get('admin/dashboard',[DashboardController::class,'dashboardPage'])->name('dashboard');


Route::get('admin/list/news',[News_articleController::class,'index'])->name('news.index');
Route::get('admin/create/news',[News_articleController::class,'create'])->name('news.create');
Route::post('admin/create/news/post',[News_articleController::class,'store'])->name('news.store');
Route::get('admin/edit/{id}/news',[News_articleController::class,'edit'])->name('news.edit');
Route::put('admin/edit/{id}/news/post',[News_articleController::class,'update'])->name('news.update');
Route::get('admin/view/{id}/news',[News_articleController::class,'show'])->name('news.show');
Route::get('admin/remove/{id}/news',[News_articleController::class,'destroy'])->name('news.destroy');



