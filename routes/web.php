<?php

use App\Http\Controllers\AdminController;

use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\SubSubCategoryController;


// frontend controllers
use App\Http\Controllers\IndexController;


use App\Models\User;

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





/* route for admin */
Route::middleware('admin:admin')->group(function () {
    Route::get('admin/login',[AdminController::class,'loginForm'])->name('admin.logiin');
    Route::post('admin/login',[AdminController::class,'store'])->name('admin.login');
    
});
Route::get('admin/logout',[AdminController::class,'destroy'])->name('admin.logout');
Route::get('admin/profile',[AdminProfileController::class,'adminProfile'])->name('admin.profile');
Route::get('admin/profile/edit',[AdminProfileController::class,'adminProfileEdit'])->name('admin.profile.edit');
Route::post('admin/profile/update',[AdminProfileController::class,'adminProfileUpdate'])->name('admin.profile.update');
Route::get('admin/profile/change_password',[AdminProfileController::class,'adminProfileChangePass'])->name('admin.profile.change_password');
Route::post('admin/profile/update_password',[AdminProfileController::class,'adminProfileUpdatePass'])->name('admin.profile.update_password');

Route::middleware([
    'auth:sanctum,admin', config('jetstream.auth_session'),'verified',
    ])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.index');
    })->name('admin.dashboard')->middleware('auth:admin');
});

/* all routes for user */

Route::get('/',[IndexController::class,'index']);
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('dashboard', compact('user'));
    })->name('dashboard');
});
Route::get('/user/logout',[IndexController::class,'userLogout'])->name('user.logout');
Route::get('/user/profile',[IndexController::class,'userProfile'])->name('user.profile');
Route::post('/user/profile/store',[IndexController::class,'userProfileStore'])->name('user.profile.store');
Route::get('/user/change-password',[IndexController::class,'userChangePassword'])->name('user.changePassword');
Route::post('/user/update-password',[IndexController::class,'userUpdatePassword'])->name('user.updatePassword');


/* admin brand routes */
Route::prefix('brand')->group(function () {
    Route::get('/view',[BrandController::class,'view'])->name('brand.view');
    Route::post('/store',[BrandController::class,'store'])->name('brand.store');
    Route::get('/edit/{id}',[BrandController::class,'edit'])->name('brand.edit');
    Route::post('/update',[BrandController::class,'update'])->name('brand.update');
    Route::get('/delete/{id}',[BrandController::class,'delete'])->name('brand.delete');
});


/* admin category routes */
Route::prefix('category')->group(function () {
    /*  parent category  */
    Route::get('/view',[CategoryController::class,'view'])->name('category.view');
    Route::post('/store',[CategoryController::class,'store'])->name('category.store');
    Route::get('/edit/{id}',[CategoryController::class,'edit'])->name('category.edit');
    Route::post('/update',[CategoryController::class,'update'])->name('category.update');
    Route::get('/delete/{id}',[CategoryController::class,'delete'])->name('category.delete');

    /*  sub category  */
    Route::get('/sub/view',[SubCategoryController::class,'view'])->name('subcategory.view');
    Route::post('/sub/store',[SubCategoryController::class,'store'])->name('subcategory.store');
    Route::get('/sub/edit/{id}',[SubCategoryController::class,'edit'])->name('subcategory.edit');
    Route::post('/sub/update',[SubCategoryController::class,'update'])->name('subcategory.update');
    Route::get('/sub/delete/{id}',[SubCategoryController::class,'delete'])->name('subcategory.delete');

    /*  sub sub-category  */
    Route::get('/sub/sub/view',[SubSubCategoryController::class,'view'])->name('subsubcategory.view');
    Route::get('/subcategory/ajax/{category_id}',[SubSubCategoryController::class,'getSubCategory']);  /* get category wise sub category */
    Route::post('/sub/sub/store',[SubSubCategoryController::class,'store'])->name('subsubcategory.store');
    Route::get('/sub/sub/edit/{id}',[SubSubCategoryController::class,'edit'])->name('subsubcategory.edit');
    Route::post('/sub/sub/update',[SubSubCategoryController::class,'update'])->name('subsubcategory.update');
    Route::get('/sub/sub/delete/{id}',[SubSubCategoryController::class,'delete'])->name('subsubcategory.delete');
});



