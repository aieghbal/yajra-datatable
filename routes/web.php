<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\LoginMiddleware;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\UsersController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'create']);
Route::get('/user/edit/{id}', [RegisterController::class, 'edit'])->name('edit');
Route::post('/edit', [RegisterController::class, 'postEdit']);

Route::get('/login', [LoginController::class, 'index']);



Route::middleware(LoginMiddleware::class)->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/delete/{id}', [DashboardController::class, 'delete'])->name('delete');

    Route::post('/getArticleData', [DashboardController::class, 'getArticleData'])->name('getArticleData');
    Route::post('/updateArticleData', [DashboardController::class, 'updateArticleData'])->name('updateArticleData');

    Route::get('/dashboard/edit/{id}', [DashboardController::class, 'edit'])->name('edit');
    Route::post('/create', [DashboardController::class, 'create']);

    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/logout', [LoginController::class, 'logout']);
});


//Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/articles', [ArticlesController::class, 'index'])->name('article.index');
Route::post('/articles', [ArticlesController::class, 'store'])->name('article.store');
Route::get('/users', [RegisterController::class, 'index'])->name('users.index');



Route::prefix('article')->group(function () {
    /*Route::get('/Lists', function () {
        return view('app');
    });*/
    Route::get('/Lists', [ArticlesController::class, 'getList']);
    Route::get('/data', [ArticlesController::class, 'getArticle']);
    Route::get('/categories', [ArticlesController::class, 'getCategories']);
    Route::get('/tags', [ArticlesController::class, 'getTags']);
    Route::get('/delete/{id}', [ArticlesController::class, 'delete']);
    Route::post('/createArticle', [ArticlesController::class, 'create']);
    Route::post('/editArticle', [ArticlesController::class, 'update']);
});

