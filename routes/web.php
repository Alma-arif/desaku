<?php

use App\Http\Controllers\Dashboard\BeritaDashboard;
use App\Http\Controllers\Dashboard\BeritaKategoriDashboard;
use App\Http\Controllers\Dashboard\DokumenController;
use App\Http\Controllers\Dashboard\UserDashboard;
use App\Http\Controllers\Dashboard\JabatanDashboard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
        Route::prefix('/dashboard')->group(function () {

            Route::prefix('/user')->group(function () {
                Route::get('/', [UserDashboard::class, 'index' ] )->name('UserDashboard');
                Route::post('/', [UserDashboard::class, 'store' ] )->name('UserDashboard.post');
                Route::put('/{id}', [UserDashboard::class, 'update' ] )->name('UserDashboard.update');
                Route::delete('/{id}', [UserDashboard::class, 'destroy' ] )->name('UserDashboard.delete');
            });

            Route::prefix('/jabatan')->group(function () {
                Route::get('/', [JabatanDashboard::class, 'index' ] )->name('JabatanDashboard');
                Route::post('/', [JabatanDashboard::class, 'store' ] )->name('JabatanDashboard.post');
                Route::put('/{id}', [JabatanDashboard::class, 'update' ] )->name('JabatanDashboard.update');
                Route::delete('/{id}', [JabatanDashboard::class, 'destroy' ] )->name('JabatanDashboard.delete');
            });

            Route::prefix('/berita')->group(function () {
                Route::get('/', [BeritaDashboard::class, 'index' ] )->name('BeritaDashboard');
                Route::post('/', [BeritaDashboard::class, 'store' ] )->name('BeritaDashboard.post');
                Route::put('/{id}', [BeritaDashboard::class, 'update' ] )->name('BeritaDashboard.update');
                Route::delete('/{id}', [BeritaDashboard::class, 'destroy' ] )->name('BeritaDashboard.delete');

                Route::prefix('/kategori')->group(function () {
                    Route::get('/', [BeritaKategoriDashboard::class, 'index' ] )->name('BeritaKategoriDashboard');
                    Route::post('/', [BeritaKategoriDashboard::class, 'store' ] )->name('BeritaKategoriDashboard.post');
                    Route::put('/{id}', [BeritaKategoriDashboard::class, 'update' ] )->name('BeritaKategoriDashboard.update');
                    Route::delete('/{id}', [BeritaKategoriDashboard::class, 'destroy' ] )->name('BeritaKategoriDashboard.delete');
                });
            });

            Route::prefix('/dokumen')->group(function () {
                Route::get('/', [DokumenController::class, 'index' ] )->name('DokumenDashboard');
                Route::post('/', [DokumenController::class, 'store' ] )->name('DokumenDashboard.post');
                Route::put('/{id}', [DokumenController::class, 'update' ] )->name('DokumenDashboard.update');
                Route::delete('/{id}', [DokumenController::class, 'destroy' ] )->name('DokumenDashboard.delete');
                Route::get('/archive/{id}', [DokumenController::class, 'archive' ] )->name('DokumenDashboard.archive');
            });



        });
});
