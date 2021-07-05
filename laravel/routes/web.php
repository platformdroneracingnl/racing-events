<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\ProfileController;

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
        Route::group(['middleware' => ['auth', '2fa']], function() {
            // Dashboard
            Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

            // Change layout
            Route::get('/layout', [App\Http\Controllers\DashboardController::class, 'changeLayout'])->name('layout');

            // Mark notifications as read
            Route::get('markAsRead', function() {
                auth()->user()->unreadNotifications->markAsRead();
                return redirect()->back();
            })->name('markRead');

            // Mark specific notification as read
            Route::get('notifications', [NotificationsController::class, 'index'])->name('notify.index');
            Route::get('notifications/remove', [NotificationsController::class, 'removeAll'])->name('notify.removeAll');
            Route::get('notifications/readall', [NotificationsController::class, 'readAll'])->name('notify.readAll');
            Route::delete('notification/remove/{id}', [NotificationsController::class, 'remove'])->name('notify.remove');
            Route::get('notification/show/{id}', [NotificationsController::class, 'show'])->name('notify.show');
            Route::get('notification/read/{id}', [NotificationsController::class, 'read'])->name('notify.read');

            // Management
            Route::resource('management/roles', 'App\Http\Controllers\Management\RoleController', ['names' => 'management.roles']);
			Route::resource('management/users', 'App\Http\Controllers\Management\UserController', ['names' => 'management.users']);
            Route::patch('management/user/{id}/suspend', [App\Http\Controllers\Management\UserController::class, 'suspendUser'])->name('management.suspend_user');

            // Profile
			Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
			Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
			Route::put('profile/password', [ProfileController::class, 'password'])->name('profile.password');
			Route::delete('profile/{userID}/destroy', [ProfileController::class, 'destroyUser'])->name('profile.destroy');
        });
    }
);

// 2FA Security
Route::group(['prefix' => '2fa', 'middleware' => 'auth'], function() {
	// Route::get('/','LoginSecurityController@show2faForm');
    Route::post('/generateSecret', [LoginSecurityController::class, 'generate2faSecret'])->name('generate2faSecret');
    Route::post('/enable2fa', [LoginSecurityController::class, 'enable2fa'])->name('enable2fa');
	Route::post('/disable2fa', [LoginSecurityController::class, 'disable2fa'])->name('disable2fa');
	
	// 2fa middleware
    Route::post('/verify', function () {
        return redirect(URL()->previous());
    })->name('2faVerify')->middleware('2fa');
});

// Give 404 error if path not exists
Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index']);
//Language Translation

// Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);

// Route::post('/formsubmit', [App\Http\Controllers\HomeController::class, 'FormSubmit'])->name('FormSubmit');
