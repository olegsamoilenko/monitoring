<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\DailySummaryController;
use App\Http\Controllers\DailySummaryCarController;
use App\Http\Controllers\ChevronController;
use App\Http\Controllers\ChevronOrderController;

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

Route::group(['middleware' => 'auth'], function () {
  Route::get('/', [MainController::class, 'index'])->name('main-page');
  Route::get('/select-post', [MainController::class, 'selectPost'])->name('select-post');

  Route::get('/operational-situation/edit', [DailySummaryController::class, 'edit'])->middleware('counter.intelligence');
  Route::put('/operational-situation/update', [DailySummaryController::class, 'update'])->middleware('counter.intelligence');
  Route::post('/add-car-to-daily-summary', [DailySummaryCarController::class, 'store'])->middleware('counter.intelligence');
  Route::delete('/destroy-car-from-daily-summary/{dailySummaryCar}', [DailySummaryCarController::class, 'destroy'])->middleware('counter.intelligence');

  Route::get('/add-car', [CarController::class, 'create'])->name('add-car');
  Route::post('/add-car', [CarController::class, 'store']);

  Route::get('/monitoring', [MonitoringController::class, 'index'])->name('monitoring');
  Route::get('/monitoring/search', [MonitoringController::class, 'monitoring']);
  Route::get('/monitoring/search/p', [MonitoringController::class, 'paginationMonitoring']);

  Route::get('/admin/get-posts', [PostController::class, 'getPosts']);
});


Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'admin'], function () {
  Route::get('/', function () {
//    return view('admin.index');
    return redirect()->route('admin.posts');
  });

  Route::get('/posts', [PostController::class, 'index'])->name('admin.posts');

  Route::get('/posts/create', [PostController::class, 'create']);
  Route::post('/posts/store', [PostController::class, 'store']);
  Route::get('/posts/{post:id}/edit', [PostController::class, 'edit']);
  Route::put('/posts/{post}', [PostController::class, 'update']);
  Route::delete('/posts/{post}', [PostController::class, 'destroy']);
  Route::get('/posts/p', [PostController::class, 'paginationPosts']);

  Route::get('/users', [UserController::class, 'index']);
  Route::get('/users/p', [UserController::class, 'paginationUsers']);
  Route::get('/users/{user:id}/edit', [UserController::class, 'edit']);
  Route::put('/users/{user}', [UserController::class, 'update']);
  Route::delete('/users/{user}', [UserController::class, 'destroy']);

  Route::get('/get-roles', [RoleController::class, 'getRoles']);

});

Route::get('/chevrons', [ChevronController::class, 'index'])->name('chevrons');
Route::get('/get-sorted-chevrons-by-amount', [ChevronController::class, 'getSortedChevronsByAmount']);
Route::get('/get-sorted-chevrons-by-surname', [ChevronController::class, 'getSortedChevronsBySurname']);
Route::get('/chevrons/orders', [ChevronOrderController::class, 'index'])->name('chevrons.orders');
Route::post('/add-chevron', [ChevronOrderController::class, 'store']);

require __DIR__ . '/auth.php';
