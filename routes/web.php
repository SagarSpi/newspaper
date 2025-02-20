<?php

use App\Http\Controllers\Backend\ArticleController;
use App\Http\Controllers\Backend\DashboardContoller;
use App\Http\Controllers\Backend\LoginController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\CommentController;
use App\Http\Controllers\Frontend\DetailsController;
use App\Http\Controllers\Frontend\HomeController;
use Illuminate\Support\Facades\Route;



Route::get('/category', function () {
    return view('frontend.category');
});

Route::get('/latestNews', function () {
    return view('frontend.lastestNews');
});

// Frontend Route here 
Route::get('/',[HomeController::class,'homePage'])->name('home');
Route::get('/news/{cat}/category',[CategoryController::class,'categoryPage'])->name('news.category');
Route::get('/news/{id}/details',[DetailsController::class,'detailsPage'])->name('news.details');
Route::post('/news/comments/post',[CommentController::class,'store'])->name('news.comment');

// Backend Route Here

Route::middleware('auth')->group(function () {

    Route::get('/manage/dashboard',[DashboardContoller::class,'index'])->name('dashboard');
    
    // Article Backend Route Here
    Route::get('/manage/list/article',[ArticleController::class,'index'])->name('article.list');
    Route::get('/manage/create/article',[ArticleController::class,'create'])->name('article.create');
    Route::post('/manage/create/article/post', [ArticleController::class,'store'])->name('article.store');
    Route::get('/manage/edit/{id}/article',[ArticleController::class,'edit'])->name('article.edit');
    Route::put('/manage/edit/{id}/article/post',[ArticleController::class,'update'])->name('article.update');
    Route::get('/manage/view/{id}/article',[ArticleController::class,'show'])->name('article.show');
    Route::get('/manage/remove/{id}/article',[ArticleController::class,'destroy'])->name('article.remove');
});


Route::get('/login',[LoginController::class,'loginPage'])->name('login');
Route::post('/login/post',[LoginController::class,'loginPost'])->name('login.post');
Route::get('/logout',[LoginController::class,'logout'])->name('logout');


Route::get('/register',[UserController::class,'create'])->name('user.create');
Route::post('/register/post',[UserController::class,'store'])->name('user.store');

Route::get('/manage/list/users',[UserController::class,'index'])->name('user.list');
Route::get('/manage/edit/{id}/user',[UserController::class,'edit'])->name('user.edit');
Route::put('/manage/edit/{id}/user/post',[UserController::class,'update'])->name('user.update');

Route::get('/manage/profile/user',[UserController::class,'show'])->name('user.show');








Route::get('/manage/biponDa/download',[DownloadController::class,'downloadPage'])->name('download.page');
Route::get('/manage/biponDa/download/file',[DownloadController::class,'downloadFile'])->name('download.file');