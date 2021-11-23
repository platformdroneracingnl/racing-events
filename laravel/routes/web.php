<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Management;
use App\Http\Controllers\Organizator;
use App\Http\Controllers\Pilots;
use App\Http\Controllers\Utils;

use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\LoginSecurityController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\HomeController;


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
        // Include Fortify routes for localization
        require(base_path('vendor/laravel/fortify/routes/routes.php'));

        // Routes that do not require login
        Route::get('/', [HomeController::class, 'root'])->name('root')->middleware('guest');
        Route::get('events', [EventController::class, 'index'])->name('events');
        Route::get('contact', [ContactController::class, 'index'])->name('contact');

        // Routes that requires account login
        Route::group(['middleware' => ['auth', '2fa', 'verified']], function() {
            // Dashboard
            Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
            Route::get('news', [NewsController::class, 'index'])->name('news');

            /**
             * Events
             */
            Route::get('events/{event}', [EventController::class, 'show'])->name('events.show');

            // Change layout
            Route::get('layout', [DashboardController::class, 'changeLayout'])->name('layout');

            /**
             * Notifications
             */
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

            /**
             * Management
             */
            Route::resource('management/roles', Management\RoleController::class, ['names' => 'management.roles']);
			Route::resource('management/users', Management\UserController::class, ['names' => 'management.users']);
            Route::patch('management/user/{user}/suspend', [Management\UserController::class, 'suspendUser'])->name('management.suspend_user');
            Route::resource('management/events', Management\EventController::class, ['names' => 'management.events']);
            Route::resource('management/organizations', Management\OrganizationController::class, ['names' => 'management.organizations']);
			Route::resource('management/locations', Management\LocationController::class, ['names' => 'management.locations']);
			Route::resource('management/raceteams', Management\RaceTeamController::class, ['names' => 'management.race_teams']);

            /**
             * Organizator
             */
            // Events
            Route::resource('organizator/events', Organizator\EventController::class, ['names' => 'organizator.events']);
            // Waivers
			Route::resource('organizator/waivers', Organizator\WaiverController::class, ['names' => 'organizator.waivers']);
            Route::get('organizator/event/{waiver}/export', [Organizator\WaiverController::class, 'exportPDF'])->name('organizator.waiver.export');
            // Registrations
            Route::get('organizator/event/{event}/registrations', [Organizator\RegistrationController::class, 'eventRegistrations'])->name('organizator.event.registrations');
            Route::get('organizator/event/{event}/registrations/export', [Organizator\RegistrationController::class, 'exportPDF'])->name('organizator.event.export');
            Route::patch('organizator/event/{registration}/update', [Organizator\RegistrationController::class, 'updateRegistration'])->name('event.registration.update');
            Route::patch('organizator/event/registrations/change-all', [Organizator\RegistrationController::class, 'changeMultipleRegistration'])->name('event.registrations.update-all');
            Route::post('organizator/event/{registration}/destroy', [Organizator\RegistrationController::class, 'destroyRegistration'])->name('organizator.registration.destroy');
            // Check-in
            Route::get('organizator/event/scan', [Organizator\RegistrationController::class, 'scan'])->name('event.scan');
            Route::get('organizator/event/check-in/{registration}', [Organizator\RegistrationController::class, 'checkin'])->name('event.check-in');
            Route::patch('organizator/event/check-in/{registration}/update', [Organizator\RegistrationController::class, 'updateCheckin'])->name('event.check-in.update');

            /**
             * Pilots
             */
            Route::get('registrations', [Pilots\RegistrationController::class, 'myRegistrationsIndex'])->name('registrations.index');
            Route::post('events/{event}/register', [Pilots\RegistrationController::class, 'store'])->name('registration.event.store');

            /**
             * Profile
             */
			Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
			Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
			Route::put('profile/password', [ProfileController::class, 'password'])->name('profile.password');
            Route::post('profile/avatar', [ProfileController::class, 'storeAvatar'])->name('profile.avatar');
			Route::delete('profile/{user}/destroy', [ProfileController::class, 'destroyUser'])->name('profile.destroy');
        });
    }
);

Route::get('/register-retry', function(){
    // Chrome F12 Headers - my_first_application_session=eyJpdiI6ImNnRH...
    Cookie::queue(Cookie::forget(strtolower(str_replace(' ', '_', config('app.name'))) . '_session'));
    return redirect('/');
});

/**
 * 2FA Security
 */
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

/**
 * Mollie
 */
Route::get('/mollie-payment', [Utils\MollieController::class, 'preparePayment'])->name('mollie.payment');
Route::get('/payment/{regID}', [Utils\MollieController::class, 'paymentHandler'])->name('payment.handle');
Route::get('/payment/event/{paymentID}', [Utils\MollieController::class, 'checkPaymentStatus'])->name('payment.event');
Route::post('webhooks/mollie', [Utils\MollieController::class, 'mollieHandle'])->name('webhooks.mollie');

// Give 404 error if path not exists
Route::get('{any}', [HomeController::class, 'index']);
