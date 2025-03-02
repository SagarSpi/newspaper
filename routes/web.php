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
use App\Http\Controllers\Frontend\LatestArticleController;
use App\Http\Controllers\Frontend\NewsletterController;
use App\Http\Controllers\Frontend\SearchController;
use App\Http\Middleware\UserActivity;
use Illuminate\Support\Facades\Route;


Route::get('/v', function () {
    return view('login.otpVerification');
});


Route::get('/newsletter/email/send',[NewsletterController::class,'sendEmail']);
Route::post('/newsletter/email/post',[NewsletterController::class,'store'])->name('email.store');


// Frontend Route here 
Route::get('/',[HomeController::class,'homePage'])->name('home');
Route::get('/news/{cat}/category',[CategoryController::class,'categoryPage'])->name('news.category');
Route::get('/news/{id}/details',[DetailsController::class,'detailsPage'])->name('news.details');
Route::post('/news/details/{id}/comment/post',[CommentController::class,'store'])->name('news.comment');
Route::get('/news/latest',[LatestArticleController::class,'latestArticles'])->name('news.latest');
Route::get('/news/search',[SearchController::class,'searchNews'])->name('news.search');

// Login Route here 
Route::get('/login',[LoginController::class,'loginPage'])->name('login');
Route::post('/login/post',[LoginController::class,'loginPost'])->name('login.post');
Route::get('/logout',[LoginController::class,'logout'])->name('logout');
// Login with Social account 
Route::get('/auth/redirection/{provider}',[LoginController::class,'authProviderRedirect'])->name('auth.redirection');
Route::get('/auth/{provider}/callback',[LoginController::class,'socialAuthentication'])->name('auth.callback');



// Register Route here 
Route::get('/register',[UserController::class,'create'])->name('user.create');
Route::post('/register/post',[UserController::class,'store'])->name('user.store');
Route::get('/register/user/otp-verification',[UserController::class,'otpVerification'])->name('user.verification');

Route::get('/send-otp',[UserController::class,'sendOtp'])->name('send-otp');




// Backend Route Here
Route::middleware(['auth',UserActivity::class])->group(function () {

    Route::get('/newsletter/email/list',[NewsletterController::class,'index'])->name('email.list');
    Route::get('/newsletter/{id}/email',[NewsletterController::class,'edit']);
    Route::put('newsletter/update/email',[NewsletterController::class,'update']);

    // Dashboard Route here 
    Route::get('/manage/dashboard',[DashboardContoller::class,'index'])->name('dashboard');

    // Article Route Here
    Route::get('/manage/list/article',[ArticleController::class,'index'])->name('article.list');
    Route::get('/manage/article/search',[ArticleController::class,'searchData'])->name('article.search');
    Route::get('/manage/create/article',[ArticleController::class,'create'])->name('article.create');
    Route::post('/manage/create/article/post', [ArticleController::class,'store'])->name('article.store');
    Route::get('/manage/request/article',[ArticleController::class,'articleRequest'])->name('article.request');
    Route::get('/manage/{id}/approved/article',[ArticleController::class,'articleReqApproved'])->name('article.approved');
    Route::post('/manage/approved/article/all',[ArticleController::class,'approvedAll'])->name('article.approvedAll');
    Route::get('/manage/edit/{id}/article',[ArticleController::class,'edit'])->name('article.edit');
    Route::put('/manage/edit/{id}/article/post',[ArticleController::class,'update'])->name('article.update');
    Route::get('/manage/view/{id}/article',[ArticleController::class,'show'])->name('article.show');
    Route::delete('/manage/remove/{id}/article',[ArticleController::class,'destroy'])->name('article.delete');
    Route::delete('/manage/article/delete',[ArticleController::class,'destroyAll'])->name('article.deleteAll');

    // Comments Route Here
    Route::get('/manage/comments',[CommentController::class,'index'])->name('comment.list');
    Route::get('/manage/comments/search',[CommentController::class,'searchData'])->name('comment.search');
    Route::get('/manage/edit/{id}/comment',[CommentController::class,'edit'])->name('comment.edit');
    Route::put('/manage/edit/{id}/comments/post',[CommentController::class,'update'])->name('comment.update');
    Route::delete('/manage/delete/comments',[CommentController::class,'destroyAll'])->name('comment.deleteAll');

    // User Route here
    Route::get('/manage/list/users',[UserController::class,'index'])->name('user.list');
    Route::get('/manage/users/search',[UserController::class,'searchData'])->name('user.search');
    Route::get('/manage/edit/{id}/user',[UserController::class,'edit'])->name('user.edit');
    Route::put('/manage/edit/{id}/user/post',[UserController::class,'update'])->name('user.update');
    Route::get('/manage/profile/{id}/user',[UserController::class,'show'])->name('user.show');
});


Route::get('/manage/biponDa/download',[DownloadController::class,'downloadPage'])->name('download.page');
Route::get('/manage/biponDa/download/file',[DownloadController::class,'downloadFile'])->name('download.file');