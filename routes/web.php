<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/auth', [AuthController::class, 'index'])->name('login');
Route::post('/send-mail', [MailController::class, 'sendMail'])->name('sendMail');

Route::group(['prefix' => '/collections'], function () {
    Route::get('', [CollectionController::class, 'index'])->name('collections');
    Route::post('/create', [CollectionController::class, 'create'])->name('createCollection');
    Route::get('/{slug}', [CollectionController::class, 'info'])->name('getBooks');
    Route::post('/{slug}/add-books', [CollectionController::class, 'addBooks'])->name('addBook');
    Route::post('/{slug}/remove-books', [CollectionController::class, 'removeBooks'])->name('removeBook');
});

Route::group(['prefix' => '/book'], function () {
    Route::post('/create', [BookController::class, 'create'])->name('add');
    Route::post('/update', [BookController::class, 'update'])->name('update');
    Route::get('/{slug}/files', [BookController::class, 'filesControl'])->name('files');
    Route::post('/{slug}/files/edit', [BookController::class, 'editFiles'])->name('editFiles');
    Route::get('/redact/{slug?}', [BookController::class, 'redact'])->name('redact');
    Route::get('/{slug}', [BookController::class, 'index'])->name('book');
    Route::post('/{id}/delete', [BookController::class, 'delete'])->name('delete');
    Route::get('/{slug}/read/{page}/{type}/{fragment?}', [BookController::class, 'read'])->name('read');
});

Route::group(['prefix' => '/subscriptions'], function () {
    Route::get('', [SubscriptionController::class, 'index'])->name('subs');
    Route::get('/set-subscription', [SubscriptionController::class, 'setSubscription'])->name('setSub');
});

Route::group(['prefix' => '/admin'], function () {
    Route::get('/logs')->name('logs');
});

Route::get('/search/{find}', [IndexController::class, 'search'])->name('search');
