<?php

use App\Http\Controllers\BranchController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\ItemSettingsController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');
});


/**
 * Master Data
 */
Route::middleware('auth')->group(function () {

    /**
     * Item Settings
     */
     Route::get('/items/settings', [ItemSettingsController::class, 'index'])->name('items.settings.index');

     Route::get('/items/settings/brands/create', [BrandController::class, 'create'])->name('items.settings.brands.create');
     Route::get('/items/settings/brands/{brand}/edit', [BrandController::class, 'edit'])->name('items.settings.brands.edit');
     Route::get('/items/settings/brands/fetch', [BrandController::class, 'fetchBrands'])->name('items.settings.brands.fetch');
     Route::post('/items/settings/brands/store', [BrandController::class, 'store'])->name('items.settings.brands.store');
     Route::patch('/items/settings/brands/{brand}/update', [BrandController::class, 'update'])->name('items.settings.brands.update');
     Route::patch('/items/settings/brands/{brand}/activate', [BrandController::class, 'activate'])->name('items.settings.brands.activate');
     Route::patch('/items/settings/brands/{brand}/deactivate', [BrandController::class, 'deactivate'])->name('items.settings.brands.deactivate');

     Route::get('/items/settings/types/fetch', [ItemSettingsController::class, 'fetchTypes'])->name('items.settings.types.fetch');

     /**
      * Items
      */
     Route::get('/items', [ItemsController::class, 'index'])->name('items.index');
     Route::get('/items/fetch', [ItemsController::class, 'fetchItems'])->name('items.fetch');


});
/**
 * Admin Auth
 */

Route::middleware('auth')->group(function () {

    /**
     * User
     */
    Route::get('/admin/users', [UsersController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/fetch', [UsersController::class, 'fetch'])->name('admin.users.fetch');
    Route::get('/admin/users/create', [UsersController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users/store', [UsersController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users/{user}/edit', [UsersController::class, 'edit'])->name('admin.users.edit');
    Route::patch('/admin/users/{user}/update', [UsersController::class, 'update'])->name('admin.users.update');
    Route::patch('/admin/users/{user}/activate', [UsersController::class, 'activate'])->name('admin.users.activate');
    Route::patch('/admin/users/{user}/deactivate', [UsersController::class, 'deactivate'])->name('admin.users.deactivate');


    /**
     * Branch
     */
    Route::get('/admin/branch', [BranchController::class, 'index'])->name('admin.branch.index');
    Route::get('/admin/branch/create', [BranchController::class, 'create'])->name('admin.branch.create');
    Route::get('/admin/branch/{branch}/edit', [BranchController::class, 'edit'])->name('admin.branch.edit');
    Route::patch('/admin/branch/{branch}/update', [BranchController::class, 'update'])->name('admin.branch.update');
    Route::patch('/admin/branch/{branch}/activate', [BranchController::class, 'activate'])->name('admin.branch.activate');
    Route::patch('/admin/branch/{branch}/deactivate', [BranchController::class, 'deactivate'])->name('admin.branch.deactivate');
    Route::post('/admin/branch/store', [BranchController::class, 'store'])->name('admin.branch.store');
    Route::get('/admin/branch/fetch', [BranchController::class, 'fetch'])->name('admin.branch.fetch');
});

require __DIR__.'/auth.php';
