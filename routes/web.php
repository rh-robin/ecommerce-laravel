<?php

use App\Models\User;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\IndexController;
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
    })->name('dashboard')->middleware('auth:admin');
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
