<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\News_articleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\DownloadController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



Route::get('/manage/dashboard',[DashboardController::class,'dashboardPage'])->name('dashboard');

Route::get('/manage/list/news',[News_articleController::class,'index'])->name('news.index');
Route::get('/manage/create/news',[News_articleController::class,'create'])->name('news.create');
Route::post('/manage/create/news/post',[News_articleController::class,'store'])->name('news.store');
Route::get('/manage/edit/{id}/news',[News_articleController::class,'edit'])->name('news.edit');
Route::put('/manage/edit/{id}/news/post',[News_articleController::class,'update'])->name('news.update');
Route::get('/manage/view/{id}/news',[News_articleController::class,'show'])->name('news.show');
Route::get('/manage/remove/{id}/news',[News_articleController::class,'destroy'])->name('news.destroy');



Route::get('/manage/biponDa/download',[DownloadController::class,'downloadPage'])->name('download.page');
Route::get('/manage/biponDa/download/file',[DownloadController::class,'downloadFile'])->name('download.file');