<?php

use App\Http\Controllers\Admin\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('admin/register',[RegisterController::class,'registePage']);