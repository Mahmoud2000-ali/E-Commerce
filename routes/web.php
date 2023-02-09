<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified','role:user'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::controller(DashboardController::class)->group(function(){
        Route::get('/Admin/dashboard', 'index')->name('admin.dashboard');
    });

    Route::controller(CategoryController::class)->group(function(){
        Route::get('/Admin/all-category', 'index')->name('admin.allCategory');
        Route::get('/Admin/add-category', 'AddCategory')->name('admin.addCategory');
        Route::post('/Admin/store-category', 'StoreCategory')->name('StoreCategory');
        Route::get('/Admin/edit-category/{id}', 'editCategory')->name('admin.editCategory');
        Route::post('/Admin/update-category', 'UpdateCategory')->name('UpdateCategory');
        Route::get('/Admin/delete-category/{id}', 'DeleteCategory')->name('DeleteCategory');
    });

    Route::controller(SubCategoryController::class)->group(function(){
        Route::get('/Admin/all-subcategory', 'index')->name('admin.allSubcategory');
        Route::get('/Admin/add-subcategory', 'AddSubCategory')->name('admin.addSubcategory');
        Route::post('/Admin/store-subcategory', 'StoreSubCategory')->name('StoreSubCategory');
        Route::get('/Admin/edit-Subcategory/{id}', 'editSubCategory')->name('admin.editSubCategory');
        Route::post('/Admin/update-Subcategory', 'UpdateSubCategory')->name('UpdateSubCategory');
        Route::get('/Admin/delete-Subcategory/{id}', 'DeleteSubCategory')->name('DeleteSubCategory');
    });

    Route::controller(ProductController::class)->group(function(){
        Route::get('/Admin/all-product', 'index')->name('admin.allProduct');
        Route::get('/Admin/add-product', 'AddProduct')->name('admin.addProduct');
        Route::post('/Admin/store-product', 'StoreProduct')->name('admin.product.store');
        Route::get('/Admin/edit-productImage/{id}', 'editProductImage')->name('admin.editProductImage');
        Route::post('/Admin/update-productImage', 'UpdateProductImage')->name('admin.product.UpdateImage');
        Route::get('/Admin/edit-product/{id}', 'editProduct')->name('admin.editProduct');
        Route::post('/Admin/update-product', 'UpdateProduct')->name('admin.product.Update');
        Route::get('/Admin/delete-product/{id}', 'deleteProduct')->name('admin.deleteProduct');
    });

    Route::controller(OrderController::class)->group(function(){
        Route::get('/Admin/pending-order', 'index')->name('admin.PendingOrder');
    });
});



require __DIR__.'/auth.php';
