<?php

use Illuminate\Support\Facades\Log;

// Route::get('/_visitor-test', function () {
//     return 'visitor test';
// });

// Route::get('/log-test', function () {
//     Log::info('LOG TEST BERHASIL');
//     return 'OK';
// });

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\AboutController;
use App\Http\Controllers\Front\PortfolioController;
use App\Http\Controllers\Front\FrontNewsController;
use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Front\ProfileCompanyController;
use App\Http\Controllers\Front\FrontServiceController;
use App\Http\Controllers\Front\FrontProjectStoryController;
use App\Http\Controllers\Front\ControllerTrustBooster;
use App\Http\Controllers\Front\FrontCalendarController;

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\TrustBoosterController;
use App\Http\Controllers\AdminRegisterController;
use App\Http\Controllers\Admin\CompanyProfileController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ProjectStoryController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\CertificationController;
use App\Http\Controllers\Admin\CalendarController;

use App\Http\Controllers\Pimpinan\MonitoringController;
use App\Http\Controllers\Pimpinan\AuthPimpinanController;


// FRONTEND
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index']);
Route::get('/portfolio', [PortfolioController::class, 'index']);
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/news', [FrontNewsController::class, 'index'])->name('news.front.index');
Route::get('/news/{id}', [FrontNewsController::class, 'show'])->name('news.front.show');
Route::get('/services', [FrontServiceController::class, 'index'])
    ->name('services.front.index');

Route::get('/company-profile', [ProfileCompanyController::class, 'show'])
    ->name('company-profile.show');

// Project Stories Frontend
Route::get('/proyek-stories', [FrontProjectStoryController::class, 'index'])->name('front.proyek.index');
Route::get('/proyek-stories/{id}', [FrontProjectStoryController::class, 'show'])->name('front.proyek.show');

Route::get('/trust-booster', [ControllerTrustBooster::class, 'show'])->name('front.trust-booster.show');
Route::get('/calendar', [FrontCalendarController::class, 'show'])->name('front.calendar.show');


// ADMIN AUTH
Route::prefix('admin')->group(function () {
    // LOGIN ADMIN
    Route::get('/loginUsersCompanyProfile', [AuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/loginUsersCompanyProfile', [AuthController::class, 'login'])->name('admin.login.post');

    // LOGOUT ADMIN
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');

    // REGISTER ADMIN (nanti kita ubah)
    Route::get('/UsersCompanyProfileRegistration', [AdminRegisterController::class, 'showForm'])->name('admin.register');
    Route::post('/UsersCompanyProfileRegistration', [AdminRegisterController::class, 'register'])->name('admin.register.post');
});

// ADMIN AREA
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('services', ServiceController::class);
    Route::resource('news', NewsController::class);
    Route::resource('trust-boosters', TrustBoosterController::class);
    Route::resource('company-profile', CompanyProfileController::class);
    Route::resource('projects', ProjectController::class);
    Route::resource('project-stories', ProjectStoryController::class);
    Route::resource('clients', ClientController::class);
    Route::resource('partners', PartnerController::class);
    Route::resource('certifications', CertificationController::class);
    Route::resource('calendar', CalendarController::class);

Route::get('/', [HomeController::class, 'index'])
    ->middleware('log.visitor')
    ->name('home');

});


/*
|--------------------------------------------------------------------------
| PIMPINAN AUTH
|--------------------------------------------------------------------------
*/
Route::prefix('pimpinan')->group(function () {
    Route::get('/login', [AuthPimpinanController::class, 'showLogin'])
        ->name('pimpinan.login');

    Route::post('/login', [AuthPimpinanController::class, 'login'])
        ->name('pimpinan.login.post');

    Route::post('/logout', [AuthPimpinanController::class, 'logout'])
        ->name('pimpinan.logout');
});

/*
|--------------------------------------------------------------------------
| PIMPINAN AREA
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:pimpinan'])
    ->prefix('pimpinan')
    ->group(function () {

        Route::get('/dashboard', [MonitoringController::class, 'index'])
            ->name('pimpinan.dashboard');
});

