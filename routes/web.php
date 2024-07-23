<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PaketMemberController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\PersonalTrainerController;
use App\Http\Controllers\Admin\invoiceController;
use App\Http\Controllers\Admin\barangController;
use App\Http\Controllers\Admin\DashboardController;

Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard-admin', [DashboardController::class, 'index'])->name('admin.dashboard');
    //
    Route::get('/paket', [PaketMemberController::class, 'index'])->name('admin.paket');
    Route::post('/paket/store', [PaketMemberController::class, 'store'])->name('paket.store');
    Route::get('/paket/data', [PaketMemberController::class, 'getData'])->name('paket.data');
    Route::get('/paket/edit', [PaketMemberController::class, 'edit'])->name('paket.edit');
    Route::put('/paket/update', [PaketMemberController::class, 'update'])->name('paket.update');
    Route::delete('/paket/delete/{id}', [PaketMemberController::class, 'destroy'])->name('paket.destroy');
    //  

    route::get('/member', [MemberController::class, 'index'])->name('admin.member');
    Route::post('/member/store', [MemberController::class, 'store'])->name('members.store');
    Route::get('data-members', [MemberController::class, 'getData'])->name('data.members');
    Route::post('/member/update-sesi', [MemberController::class, 'updateSesiMember'])->name('member.update-sesi');


    route::get('/personal-trainner', [PersonalTrainerController::class, 'index'])->name('admin.trainer');
    Route::post('/personal_trainers/store', [PersonalTrainerController::class, 'store'])->name('personal_trainers.store');


    route::get('/invoicee', [invoiceController::class, 'index'])->name('admin.invoice');
    Route::get('data-invoice', [invoiceController::class, 'getData'])->name('data-invoice');

    Route::get('/barang', [BarangController::class, 'index'])->name('admin.barang');

    Route::post('/barang/store', [BarangController::class, 'store'])->name('barang.store');
    Route::get('/barang/edit/{id}', [BarangController::class, 'edit'])->name('barang.edit');
    Route::put('/barang/update/{id}', [BarangController::class, 'update'])->name('barang.update');
    Route::delete('/barang/destroy/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');
});

require __DIR__ . '/auth.php';
