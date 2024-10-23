<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MinimarketController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('halaman');
});

Route::get('/minimarket', [MinimarketController::class, 'index'])->name('minimarket');
Route::get('/minimarket/add', [MinimarketController::class, 'create'])->name('minimarket.add');
Route::post('/minimarket/add/store', [MinimarketController::class, 'store'])->name('minimarket.add.store');
Route::get('/minimarket/edit/{id}', [MinimarketController::class, 'edit'])->name('minimarket.edit');
Route::patch('/minimarket/edit/{id}', [MinimarketController::class, 'update'])->name('minimarket.edit.update');
Route::delete('/minimarket/delete/{id}', [MinimarketController::class, 'destroy'])->name('minimarket.delete');

Route::get('/user', [UserController::class, 'index'])->name('user');
Route::get('/user/add', [UserController::class,'create'])->name('user.add');
Route::post('/user/add', [UserController::class, 'tambah'])->name('user.add.tambah');
Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
Route::patch('/user/edit/{id}', [UserController::class, 'update'])->name('user.edit.update');
Route::delete('/user/delete/{id}', [UserController::class, 'destroy'])->name('user.delete');