<?php

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


Route::get('/phpinfo', function() {
    return phpinfo();
});

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localize', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']],
    function() {
        // Routes that do not require login
        Route::get('/', [App\Http\Controllers\HomeController::class, 'root'])->name('root');

        // Routes that requires account login
        Route::group(['middleware' => ['auth']], function() {
            // Dashboard
            Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

            // Change layout
            Route::get('/layout', [App\Http\Controllers\DashboardController::class, 'changeLayout'])->name('layout');

            // Management
            Route::resource('management/roles', 'App\Http\Controllers\Management\RoleController', ['names' => 'management.roles']);
			Route::resource('management/users', 'App\Http\Controllers\Management\UserController', ['names' => 'management.users']);
            Route::patch('management/user/{id}/suspend', [App\Http\Controllers\Management\UserController::class, 'suspendUser'])->name('management.suspend_user');
        });
    }
);

// Give 404 error if path not exists
Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index']);
//Language Translation

// Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);

// Route::post('/formsubmit', [App\Http\Controllers\HomeController::class, 'FormSubmit'])->name('FormSubmit');
