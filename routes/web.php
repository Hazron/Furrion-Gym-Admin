<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PaketMemberController;

Route::get('/', function () {
    return view('admin.dashboard');
});

// Route::middleware([''])->group(function () {
//     Route::get('/paket', [PaketMemberController::class, 'index'])->name('paket');
// });

Route::get('/paket', [PaketMemberController::class, 'index'])->name('paket');
