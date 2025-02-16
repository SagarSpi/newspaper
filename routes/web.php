<?php

use App\Http\Controllers\Backend\ArticleController;
use App\Http\Controllers\Backend\DashboardContoller;
use App\Http\Controllers\DownloadController;
use Illuminate\Support\Facades\Route;


Route::get('/home', function () {
    return view('frontend.home');
});

Route::get('/manage/dashboard',[DashboardContoller::class,'index'])->name('dashboard');

// Article Backend Route Here
Route::get('/manage/list/article',[ArticleController::class,'index'])->name('article.list');
Route::get('/manage/create/article',[ArticleController::class,'create'])->name('article.create');
Route::post('/manage/create/article/post', [ArticleController::class,'store'])->name('article.store');
Route::get('/manage/edit/{id}/article',[ArticleController::class,'edit'])->name('article.edit');
Route::put('/manage/edit/{id}/article/post',[ArticleController::class,'update'])->name('article.update');
Route::get('/manage/view/{id}/article',[ArticleController::class,'show'])->name('article.show');
Route::get('/manage/remove/{id}/article',[ArticleController::class,'destroy'])->name('article.remove');


Route::get('/manage/biponDa/download',[DownloadController::class,'downloadPage'])->name('download.page');
Route::get('/manage/biponDa/download/file',[DownloadController::class,'downloadFile'])->name('download.file');