<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\HomeController;


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

Route::get('/', [HomeController::class, 'index']);

Route::prefix('painel')->group(function(){
    Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin');
    Route::get('login', [App\Http\Controllers\Admin\Auth\LoginController::class, 'index'])->name('login');
    Route::post('login', [App\Http\Controllers\Admin\Auth\LoginController::class, 'authenticate']);

    Route::get('register', [App\Http\Controllers\Admin\Auth\RegisterController::class, 'index'])->name('register');
    Route::post('register', [App\Http\Controllers\Admin\Auth\RegisterController::class, 'register']);

    Route::post('logout', [App\Http\Controllers\Admin\Auth\LoginController::class, 'logout'])->name('logout');

    Route::get('users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');

    Route::get('users/{user}/edit', [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('user.edit');
    Route::get('users/{user}/destroy', [App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('user.destroy');
    Route::get('users/create', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('user.create');
    Route::post('users/store', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('user.store');
    Route::put('users/update/{user}', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('users.update');
    Route::delete('users/{user}/destroy', [App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('user.destroy');
    Route::get('user/{user}/admin', [App\Http\Controllers\Admin\UserController::class, 'admin'])->name('user.define.admin');
    Route::get('user/{user}/remove', [App\Http\Controllers\Admin\UserController::class, 'remove_admin'])->name('user.remove.admin');

    Route::get('profile', [App\Http\Controllers\Admin\ProfileController::class, 'index'])->name('user.profile');
    Route::put('profilesave', [App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('profile.update');

    Route::get('settings', [App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings');
    Route::put('settingssave', [App\Http\Controllers\Admin\SettingController::class, 'save'])->name('settings.save');

    Route::get('pages', [App\Http\Controllers\Admin\PageController::class, 'index'])->name('pages');
    Route::get('pages/create', [App\Http\Controllers\Admin\PageController::class, 'create'])->name('page.create');
    Route::post('pages/store', [App\Http\Controllers\Admin\PageController::class, 'store'])->name('page.store');
    Route::get('pages/{page}/edit', [App\Http\Controllers\Admin\PageController::class, 'edit'])->name('page.edit');
    Route::delete('pages/destroy/{page}', [App\Http\Controllers\Admin\PageController::class, 'destroy'])->name('page.destroy');
    Route::put('pages/update/{page}', [App\Http\Controllers\Admin\PageController::class, 'update'])->name('page.update');

});
//id17042845_laravelcms
//id17042845_jao
//87315044Jv@@

Route::fallback([App\Http\Controllers\Site\PageController::class, 'index']);