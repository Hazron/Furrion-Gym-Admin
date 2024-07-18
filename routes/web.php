<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PaketMemberController;
use App\Http\Controllers\Admin\MemberController;

Route::get('/', function () {
    return view('admin.dashboard');
});

// Route::middleware([''])->group(function () {
//     Route::get('/paket', [PaketMemberController::class, 'index'])->name('paket');
// });

Route::get('/paket', [PaketMemberController::class, 'index'])->name('admin.paket');
route::get('/member', [MemberController::class, 'index'])->name('admin.member');
