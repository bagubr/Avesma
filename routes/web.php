<?php

use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;
use Laravel\Octane\Facades\Octane;
use Symfony\Component\HttpFoundation\Response;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [IndexController::class, 'home'])->name('home');
Route::get('/pasar_virtual', [IndexController::class, 'pasar_virtual'])->name('pasar_virtual');
Route::get('/article', [IndexController::class, 'article'])->name('article');
Route::get('/article/{article}', [IndexController::class, 'article_show'])->name('article.show');
Route::get('/pasar_virtual/{pond_harvest}', [IndexController::class, 'detail_pasar_virtual'])->name('detail_pasar_virtual');
Route::post('/pasar_virtual/{pond_harvest}', [IndexController::class, 'form_pengajuan'])->name('form_pengajuan');
Route::get('/kontak', [IndexController::class, 'kontak'])->name('kontak');
Route::post('/kontak/store', [IndexController::class, 'contact_store'])->name('contact.store');