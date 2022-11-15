<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginSecurityController;
use App\Http\Controllers\Management;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\Organizator;
use App\Http\Controllers\Pilots;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Utils;
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

Route::get('/phpinfo', function () {
    return phpinfo();
});

Route::get('old', function () {
    return view('frontend-old.welcome');
});
Route::get('old/contact', function () {
    return view('frontend-old.contact');
});
Route::get('old/events', function () {
    return view('frontend-old.events');
});

// Normal application routes
Route::prefix(LaravelLocalization::setLocale())->middleware('localize', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath')->group(function () {
    // Include Fortify routes for localization
    require base_path('vendor/laravel/fortify/routes/routes.php');

    // Routes that do not require login
    Route::get('/', [HomeController::class, 'root'])->name('root')->middleware('guest');
    Route::get('events', [EventController::class, 'index'])->name('events');
    Route::get('contact', [ContactController::class, 'index'])->name('contact');

    // Routes that requires account login
    Route::middleware('auth', '2fa', 'verified')->group(function () {
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
        Route::get('markAsRead', function () {
            auth()->user()->unreadNotifications->markAsRead();

            return redirect()->back();
        })->name('markRead');

        // Mark specific notification as read
        Route::prefix('notifications')->as('notify.')
            ->controller(NotificationsController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('show/{id}', 'show')->name('show');
                Route::delete('remove/{id}', 'remove')->name('remove');
                Route::get('remove/all', 'removeAll')->name('removeAll');
                Route::get('read/{id}', 'read')->name('read');
                Route::get('read/all', 'readAll')->name('readAll');
            });

        /**
         * Management
         */
        Route::prefix('management')->as('management.')->middleware(['role:supervisor|manager'])
            ->group(function () {
                Route::resource('roles', Management\RoleController::class)->names('roles');
                Route::resource('users', Management\UserController::class)->names('users');
                Route::patch('user/{user}/suspend', [Management\UserController::class, 'suspendUser'])->name('suspend_user');
                Route::resource('events', Management\EventController::class)->names('events');
                Route::resource('organizations', Management\OrganizationController::class)->names('organizations');
                Route::resource('locations', Management\LocationController::class)->names('locations');
                Route::resource('raceteams', Management\RaceTeamController::class)->names('race_teams');
            });

        /**
         * Organizator
         */
        Route::prefix('organizator')->middleware(['role:organizator|supervisor|manager'])
            ->group(function () {
                // Events
                Route::resource('events', Organizator\EventController::class, ['names' => 'organizator.events']);

                // Waivers
                Route::resource('waivers', Organizator\WaiverController::class, ['names' => 'organizator.waivers']);
                Route::get('event/{waiver}/export', [Organizator\WaiverController::class, 'exportPDF'])->name('organizator.waiver.export');

                // Registrations
                Route::get('event/{event}/registrations', [Organizator\RegistrationController::class, 'eventRegistrations'])->name('organizator.event.registrations');
                Route::get('event/{event}/registrations/export', [Organizator\RegistrationController::class, 'exportPDF'])->name('organizator.event.export');
                Route::patch('event/{registration}/update', [Organizator\RegistrationController::class, 'updateRegistration'])->name('event.registration.update');
                Route::patch('event/registrations/change-all', [Organizator\RegistrationController::class, 'changeMultipleRegistration'])->name('event.registrations.update-all');
                Route::post('event/{registration}/destroy', [Organizator\RegistrationController::class, 'destroyRegistration'])->name('organizator.registration.destroy');
            });
        // Check-in
        Route::get('event/scan', [Organizator\RegistrationController::class, 'scan'])->name('event.scan');
        Route::get('event/check-in/{registration}', [Organizator\RegistrationController::class, 'checkin'])->name('event.check-in');
        Route::patch('event/check-in/{registration}/update', [Organizator\RegistrationController::class, 'updateCheckin'])->name('event.check-in.update');

        /**
         * Pilots
         */
        Route::get('registrations', [Pilots\RegistrationController::class, 'myRegistrationsIndex'])->name('registrations.index');
        Route::post('events/{event}/register', [Pilots\RegistrationController::class, 'store'])->name('registration.event.store');

        /**
         * Profile
         */
        Route::prefix('profile')->as('profile.')
            ->controller(ProfileController::class)
            ->group(function () {
                Route::get('/', 'show')->name('show');
                Route::put('/', 'updateProfile')->name('update');
                Route::put('password', 'updatePassword')->name('password.update');
                Route::post('avatar', 'storeAvatar')->name('avatar');
                Route::delete('{user}/destroy', 'destroyUser')->name('destroy');
            });
    });
}
);

Route::get('/register-retry', function () {
    // Chrome F12 Headers - my_first_application_session=eyJpdiI6ImNnRH...
    Cookie::queue(Cookie::forget(strtolower(str_replace(' ', '_', config('app.name'))).'_session'));

    return redirect('/');
});

// Get images from storage
Route::get('/images/{type}/{file}', [function ($type, $file) {
    $path = storage_path('app/public/images/'.$type.'/'.$file);
    if (file_exists($path)) {
        return response()->file($path, ['Content-Type' => 'image/png']);
    }
    abort(404);
}]);

/**
 * 2FA Security
 */
Route::prefix('2fa')->middleware('auth')->group(function () {
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
