<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\EditorController;

Route::middleware('guest')->group(function () {

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');

    Route::get('editor', [EditorController::class, 'index'])->name('editor');
    Route::get('editor/{id}/submissions', [FormController::class, 'submissions'])->name('editor.submissions');


    Route::get('register', [EditorController::class, 'create'])
        ->name('register');

    Route::post('register', [EditorController::class, 'store'])->name('editor.store');


    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    //custom middleware


    Route::get('form/show/{form}', [FormController::class, 'show'])->name('form.show');
    Route::delete('form/show/{form}', [FormController::class, 'destroy'])->name('form.destroy');
    Route::get('form/edit/{form}', [FormController::class, 'edit'])->name('form.edit');
    Route::put('form/edit/{form}', [FormController::class, 'update'])->name('form.update');


    Route::get('/dashboard', [FormController::class, 'index'])->name('dashboard');
    Route::post('/form/print', [FormController::class, 'printSelected'])->name('form.printSelected');


    Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
    Route::get('/services/edit/{service}', [ServiceController::class, 'edit'])->name('services.edit');
    Route::put('/services/edit/{service}', [ServiceController::class, 'update'])->name('services.update');
    Route::delete('/services/delete/{id}', [ServiceController::class, 'destroy'])->name('services.destroy');


    Route::get('/services/create', [ServiceController::class, 'create'])->name('services.create');
    Route::post('/services/create', [ServiceController::class, 'store'])->name('services.store');

    Route::get('/profile/signature', [ProfileController::class, 'signatureUpdateForm'])->name('profile.signatureUpdateForm');
    Route::put('/profile/signature', [ProfileController::class, 'signatureUpdate'])->name('profile.signatureUpdate');
});
Route::get('/', [FormController::class, 'create'])->name('form.create');
Route::post('/form/store', [FormController::class, 'store'])->name('form.store');
route::get('api/submissions', [FormController::class, 'list'])->name('form.list');
