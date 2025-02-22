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
use App\Http\Controllers\Frontend\NewsletterController;
use App\Http\Middleware\ValidUser;
use Illuminate\Support\Facades\Route;

Route::get('/latestNews', function () {
    return view('frontend.lastestNews');
});


Route::get('/newsletter/email/send',[NewsletterController::class,'sendEmail']);


Route::post('/newsletter/email/post',[NewsletterController::class,'store'])->name('email.store');



// Frontend Route here 
Route::get('/',[HomeController::class,'homePage'])->name('home');
Route::get('/news/{cat}/category',[CategoryController::class,'categoryPage'])->name('news.category');
Route::get('/news/{id}/details',[DetailsController::class,'detailsPage'])->name('news.details');
Route::post('/news/details/{id}/comment/post',[CommentController::class,'store'])->name('news.comment');
// Login Route here 
Route::get('/login',[LoginController::class,'loginPage'])->name('login');
Route::post('/login/post',[LoginController::class,'loginPost'])->name('login.post');
Route::get('/logout',[LoginController::class,'logout'])->name('logout');
// Register Route here 
Route::get('/register',[UserController::class,'create'])->name('user.create');
Route::post('/register/post',[UserController::class,'store'])->name('user.store');

// Backend Route Here
Route::middleware(['auth',ValidUser::class.':admin'])->group(function () {

    Route::get('/newsletter/email/list',[NewsletterController::class,'index'])->name('email.list');
    Route::get('/newsletter/{id}/email',[NewsletterController::class,'edit'])->name('email.edit');
    // Route::get('newsletter/update/email',[NewsletterController::class,'update']);
    Route::put('student-update',[NewsletterController::class,'update']);





    // Dashboard Route here 
    Route::get('/manage/dashboard',[DashboardContoller::class,'index'])->name('dashboard');
    // Article Route Here
    Route::get('/manage/list/article',[ArticleController::class,'index'])->name('article.list');
    Route::get('/manage/create/article',[ArticleController::class,'create'])->name('article.create');
    Route::post('/manage/create/article/post', [ArticleController::class,'store'])->name('article.store');
    Route::get('/manage/edit/{id}/article',[ArticleController::class,'edit'])->name('article.edit');
    Route::put('/manage/edit/{id}/article/post',[ArticleController::class,'update'])->name('article.update');
    Route::get('/manage/view/{id}/article',[ArticleController::class,'show'])->name('article.show');
    Route::get('/manage/remove/{id}/article',[ArticleController::class,'destroy'])->name('article.remove');
    // Comments Route Here 
    Route::get('/manage/comments',[CommentController::class,'index'])->name('comment.list');
    Route::get('/manage/edit/{id}/comment',[CommentController::class,'edit'])->name('comment.edit');
    Route::put('/manage/edit/{id}/comments/post',[CommentController::class,'update'])->name('comment.update');
    // User Route here 
    Route::get('/manage/list/users',[UserController::class,'index'])->name('user.list');
    Route::get('/manage/edit/{id}/user',[UserController::class,'edit'])->name('user.edit');
    Route::put('/manage/edit/{id}/user/post',[UserController::class,'update'])->name('user.update');
    Route::get('/manage/profile/{id}/user',[UserController::class,'show'])->name('user.show');
});


Route::get('/manage/biponDa/download',[DownloadController::class,'downloadPage'])->name('download.page');
Route::get('/manage/biponDa/download/file',[DownloadController::class,'downloadFile'])->name('download.file');