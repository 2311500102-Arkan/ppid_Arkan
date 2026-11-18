<?php

use Illuminate\Support\Facades\Route;

// Public Controllers
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\InformationRequestController;
use App\Http\Controllers\ObjectionController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SearchController;

// Admin Controllers
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\DocumentController as AdminDocumentController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\BannerController as AdminBannerController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\InformationRequestController as AdminInformationRequestController;
use App\Http\Controllers\Admin\ObjectionController as AdminObjectionController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;

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

// Public Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');

// Pages (Direct prefix & canonical /page/ route)
Route::get('/page/{slug}', [PageController::class, 'show'])->name('page.show');
Route::get('/profil/{slug}', [PageController::class, 'show'])->name('profil.show');
Route::get('/layanan/{slug}', [PageController::class, 'show'])->name('layanan.show');
Route::get('/laporan/{slug}', [PageController::class, 'show'])->name('laporan.show');

// Posts/Berita
Route::get('/berita', [PostController::class, 'index'])->name('posts.index');
Route::get('/berita/{slug}', [PostController::class, 'show'])->name('posts.show');

// Gallery
Route::get('/galeri', [GalleryController::class, 'index'])->name('gallery.index');

// Documents
Route::get('/dokumen', [DocumentController::class, 'index'])->name('documents.index');
Route::get('/dokumen/{id}/download', [DocumentController::class, 'download'])->name('documents.download');

// Information Request
Route::get('/permohonan-informasi', [InformationRequestController::class, 'create'])->name('information-request.create');
Route::post('/permohonan-informasi', [InformationRequestController::class, 'store'])->name('information-request.store');
Route::get('/cek-status', [InformationRequestController::class, 'status'])->name('information-request.status');

// Objection
Route::get('/pengajuan-keberatan', [ObjectionController::class, 'create'])->name('objection.create');
Route::post('/pengajuan-keberatan', [ObjectionController::class, 'store'])->name('objection.store');

// Contact
Route::get('/kontak', [ContactController::class, 'index'])->name('contact.index');
Route::post('/kontak', [ContactController::class, 'store'])->name('contact.store');

// Search
Route::get('/cari', [SearchController::class, 'index'])->name('search');


// Admin Authentication & Redirection Routes
Route::redirect('/admin', '/admin/dashboard');
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

// Admin Panel Protected Routes
Route::middleware(['auth'])->prefix('admin')->as('admin.')->group(function () {
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Resource routes
    Route::resource('posts', AdminPostController::class);
    Route::resource('documents', AdminDocumentController::class);
    Route::resource('pages', AdminPageController::class);
    Route::resource('banners', AdminBannerController::class);
    Route::resource('galleries', AdminGalleryController::class);

    // Information Requests
    Route::get('/information-requests', [AdminInformationRequestController::class, 'index'])->name('information-requests.index');
    Route::get('/information-requests/{id}', [AdminInformationRequestController::class, 'show'])->name('information-requests.show');
    Route::put('/information-requests/{id}/status', [AdminInformationRequestController::class, 'updateStatus'])->name('information-requests.status');
    Route::delete('/information-requests/{id}', [AdminInformationRequestController::class, 'destroy'])->name('information-requests.destroy');

    // Objections
    Route::get('/objections', [AdminObjectionController::class, 'index'])->name('objections.index');
    Route::get('/objections/{id}', [AdminObjectionController::class, 'show'])->name('objections.show');
    Route::put('/objections/{id}/status', [AdminObjectionController::class, 'updateStatus'])->name('objections.status');
    Route::delete('/objections/{id}', [AdminObjectionController::class, 'destroy'])->name('objections.destroy');

    // Contacts
    Route::get('/contacts', [AdminContactController::class, 'index'])->name('contacts.index');
    Route::get('/contacts/{id}', [AdminContactController::class, 'show'])->name('contacts.show');
    Route::delete('/contacts/{id}', [AdminContactController::class, 'destroy'])->name('contacts.destroy');

    // Settings
    Route::get('/settings', [AdminSettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [AdminSettingController::class, 'update'])->name('settings.update');

    // Profile
    Route::get('/profile', [AdminProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [AdminProfileController::class, 'update'])->name('profile.update');
});
