<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
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
    return view('frontend.index');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

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
    })->name('dashboard')->middleware('auth:admin');
});
