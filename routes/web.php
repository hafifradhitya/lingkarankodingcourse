<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontController::class, 'index'])->name('front.index');
Route::get('/pricing', [FrontController::class, 'pricing'])->name('front.pricing');
Route::get('/features', [FrontController::class, 'features'])->name('front.features');

Route::match(['get', 'post'], '/booking/payment/midtrans/notification',
[FrontController::class, 'paymentMidtransNotification'])
    ->name('front.payment_midtrans_notification');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('role:student')->group(function () {
        Route::get('/dashboard/subscriptions/', [DashboardController::class, 'subscriptions'])->name('dashboard.subscriptions');
        Route::get('/dashboard/subscription/{transaction}', [DashboardController::class, 'subscription_details'])->name('dashboard.subscription.details');

        Route::get('/dashboard/courses/', [CourseController::class, 'index'])
        ->name('dashboard');

        // Pindahkan rute portfolio ke atas rute dengan parameter untuk menghindari konflik
        Route::get('/dashboard/course/portfolio', [CourseController::class, 'portfolio'])
        ->name('dashboard.course.portfolio');

        // slug web-design
        Route::get('/dashboard/course/{course:slug}', [CourseController::class, 'details'])
        ->name('dashboard.course.details');

        Route::get('/dashboard/search/courses', [CourseController::class, 'search_courses'])
        ->name('dashboard.search.courses');

        Route::middleware(['course.access'])->group(function () {
            Route::get('/dashboard/join/{course:slug}', [CourseController::class, 'join'])
            ->name('dashboard.course.join');

            // web-design-hack/1/12
            Route::get('/dashboard/learning/{course:slug}/{courseSection}/{sectionContent}', [CourseController::class, 'learning'])
            ->name('dashboard.course.learning');

            Route::get('/dashboard/learning/{course:slug}/finished', [CourseController::class, 'learning_finished'])
        ->name('dashboard.course.learning.finished');

        Route::get('/dashboard/course/{course:slug}/certificate', [CourseController::class, 'showCertificate'])
        ->name('dashboard.course.certificate');

        Route::get('/dashboard/course/{course:slug}/certificate/download', [CourseController::class, 'downloadCertificate'])
        ->name('dashboard.course.certificate.download');

        Route::get('/dashboard/certificates', [CourseController::class, 'certificates'])
        ->name('dashboard.certificates');
        });

        Route::get('/checkout/failed', [FrontController::class, 'checkout_failed'])
        ->name('front.checkout.failed');

        Route::get('/checkout/success', [FrontController::class, 'checkout_success'])
        ->name('front.checkout.success');

        Route::get('/checkout/{pricing}', [FrontController::class, 'checkout'])
        ->name('front.checkout');

        Route::post('/booking/payment/midtrans', [FrontController::class, 'paymentStoreMidtrans'])
        ->name('front.payment_store_midtrans');

        Route::middleware(['check.subscription'])->group(function () {
            Route::post('/dashboard/course/{course:slug}/testimonial', [CourseController::class, 'storeTestimonial'])
            ->name('dashboard.course.testimonial.store');
        });

        // User Settings Routes
        Route::get('/dashboard/settings', [FrontController::class, 'settings'])
        ->name('dashboard.settings');
        Route::post('/dashboard/settings/update-profile', [FrontController::class, 'updateProfile'])
        ->name('dashboard.settings.update-profile');
        Route::post('/dashboard/settings/update-password', [FrontController::class, 'updatePassword'])
        ->name('dashboard.settings.update-password');
        Route::post('/dashboard/settings/reset-password', [FrontController::class, 'resetPassword'])
        ->name('dashboard.settings.reset-password');
    });
});

require __DIR__.'/auth.php';
