<?php

use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TestimonialController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('services', ServiceController::class)->except('show');
    Route::resource('doctors', DoctorController::class)->except('show');
    Route::resource('posts', PostController::class)->except('show');
    Route::post('posts-upload-attachment', [PostController::class, 'uploadAttachment'])->name('posts.upload-attachment');
    Route::resource('announcements', AnnouncementController::class)->except('show');
    Route::resource('testimonials', TestimonialController::class)->except('show');
    Route::resource('pages', PageController::class)->except('show');
    Route::resource('media', MediaController::class)->only(['index', 'store', 'destroy']);

    Route::resource('contact-messages', ContactMessageController::class)->only(['index', 'show', 'destroy']);

    Route::get('sections/{key}/edit', [SectionController::class, 'edit'])->name('sections.edit');
    Route::put('sections/{key}', [SectionController::class, 'update'])->name('sections.update');

    Route::get('settings', [SettingController::class, 'edit'])->name('settings.edit');
    Route::put('settings', [SettingController::class, 'update'])->name('settings.update');
});
