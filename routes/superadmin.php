<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperAdmin\SuperAdminDashboardController;
use App\Http\Controllers\SuperAdmin\SuperAdminLoginController;
use App\Http\Controllers\SuperAdmin\SuperAdminPostController;



Route::get('/login', [SuperAdminLoginController::class, 'login'])->name('superadmin.login');
Route::post('/login', [SuperAdminLoginController::class, 'postLogin'])->name('superadmin.postLogin');


Route::group(['middleware' => ['superadminAuth'], 'as' => 'superadmin.'], function () {

    Route::get('/dashboard', [SuperAdminDashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/logout', [SuperAdminLoginController::class, 'logout'])->name('logout');

    Route::group(['prefix' => 'post', 'as' => 'post.'], function () {
        Route::get('/', [SuperAdminPostController::class, 'index'])->name('index');
        Route::get('/create', [SuperAdminPostController::class, 'create'])->name('create');
        Route::post('/create', [SuperAdminPostController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [SuperAdminPostController::class, 'edit'])->name('edit');
        Route::put('/edit/{id}', [SuperAdminPostController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [SuperAdminPostController::class, 'delete'])->name('delete');
        Route::get('filter', [SuperAdminPostController::class, 'filter'])->name('filter');
       Route::post('/toggle-status', [SuperAdminPostController::class, 'toggleStatus'])->name('toggleStatus');




    });

});

