<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use App\Models\Item;
use Illuminate\Support\Facades\Route;
use Yajra\DataTables\DataTables;


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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/datalaundry', function () {
    return view('admin.datalaundry');
})->middleware(['auth', 'verified'])->name('datalaundry');
Route::get('/item_paket', function () {
    return view('admin.item_paket');
})->middleware(['auth', 'verified'])->name('item_paket');
Route::get('/item_laundry', [ItemController::class, 'index'])->middleware(['auth', 'verified'])->name('item_laundry');
Route::get('/item_laundry/find', [ItemController::class, 'edit'])->middleware(['auth', 'verified'])->name('item_laundry_find');
Route::get('/item_laundry/show', [ItemController::class, 'show'])->middleware(['auth', 'verified'])->name('item_laundry_show');
Route::post('/item_laundry/store', [ItemController::class, 'store'])->middleware(['auth', 'verified'])->name('item_laundry_store');
Route::post('/item_laundry/edit', [ItemController::class, 'update'])->middleware(['auth', 'verified'])->name('item_laundry_edit');
Route::delete('/item_laundry/delete/{id}', [ItemController::class, 'destroy'])->middleware(['auth', 'verified'])->name('item_laundry_delete');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
