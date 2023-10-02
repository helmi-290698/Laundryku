<?php

use App\Http\Controllers\ConsumentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ItempaketController;
use App\Http\Controllers\LaundryController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TipelaundryController;
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
    return view('auth.login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/item_paket', [ItempaketController::class, 'index'])->middleware(['auth', 'verified'])->name('item_paket');
    Route::post('/item_paket', [ItempaketController::class, 'store'])->middleware(['auth', 'verified'])->name('create_item_paket');
    Route::post('/item_paket/edit', [ItempaketController::class, 'update'])->middleware(['auth', 'verified'])->name('update_item_paket');
    Route::get('/item_paket/find', [ItempaketController::class, 'edit'])->middleware(['auth', 'verified'])->name('edit_item_paket');
    Route::delete('/item_paket/delete/{id}', [ItempaketController::class, 'destroy'])->middleware(['auth', 'verified'])->name('delete_item_paket');
});

Route::middleware('auth')->group(function () {
    Route::get('/laundry', [LaundryController::class, 'index'])->name('laundry');
    Route::get('/laundry/find/{id}', [LaundryController::class, 'find'])->name('laundry_find');
    Route::get('/datalaundry', [LaundryController::class, 'datatablelaundry'])->name('data_laundry');
    Route::get('/laundry/findharga', [LaundryController::class, 'getharga'])->name('getharga_laundry');
    Route::post('/laundry/store', [LaundryController::class, 'store'])->name('store_laundry');
    Route::post('/laundry/edit', [LaundryController::class, 'edit'])->name('edit_laundry');
    Route::delete('/laundry/delete/{id}', [LaundryController::class, 'destroy'])->name('delete_laundry');
});
Route::middleware('auth')->group(function () {
    Route::get('/tipelaundry', [TipelaundryController::class, 'index'])->name('tipelaundry');
    Route::get('/tipelaundry/show', [TipelaundryController::class, 'show'])->name('show_tipelaundry');
    Route::get('/tipelaundry/find', [TipelaundryController::class, 'show'])->name('find_tipelaundry');
    Route::post('/tipelaundry/store', [TipelaundryController::class, 'store'])->name('store_tipelaundry');
    Route::delete('/tipelaundry/delete/{id}', [TipelaundryController::class, 'destroy'])->name('destroy_tipelaundry');
});

Route::middleware('auth')->group(function () {
    Route::get('/item_laundry', [ItemController::class, 'index'])->name('item_laundry');
    Route::get('/item_laundry/find', [ItemController::class, 'edit'])->name('item_laundry_find');
    Route::get('/item_laundry/findbyidtipe', [ItemController::class, 'getItemByIdtipe'])->name('item_laundry_findbyidtipe');
    Route::get('/item_laundry/show', [ItemController::class, 'show'])->name('item_laundry_show');
    Route::get('/item_laundry/show/nothavepaket', [ItemController::class, 'showNotHavePaket'])->name('item_laundry_showhavepaket');
    Route::post('/item_laundry/store', [ItemController::class, 'store'])->name('item_laundry_store');
    Route::post('/item_laundry/edit', [ItemController::class, 'update'])->name('item_laundry_edit');
    Route::delete('/item_laundry/delete/{id}', [ItemController::class, 'destroy'])->name('item_laundry_delete');
});
Route::middleware('auth')->group(function () {
    Route::get('/consument', [ConsumentController::class, 'index'])->name('consument');
    Route::get('/consument/find/{id}', [ConsumentController::class, 'show'])->name('consument_find');
    Route::get('/consument/show', [ConsumentController::class, 'showall'])->name('consument_show');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware('auth')->group(function () {
    Route::get('/setting', [SettingController::class, 'index'])->name('setting');
    Route::post('/setting/store', [SettingController::class, 'store'])->name('setting.store');
});
Route::middleware('auth')->group(function () {
    Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran');
    Route::get('/pembayaran/find/{id}', [PembayaranController::class, 'find'])->name('pembayaran_find');
    Route::post('/pembayaran/edit', [PembayaranController::class, 'edit'])->name('pembayaran_edit');
    Route::get('/pembayaran/invoice/{id}', [PembayaranController::class, 'invoice'])->name('pembayaran_invoice');
    Route::delete('/pembayaran/delete/{id}', [PembayaranController::class, 'destroy'])->name('delete_pembayaran');
});

require __DIR__ . '/auth.php';
