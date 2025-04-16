<?php

use App\Http\Controllers\AngkatanController;
use App\Http\Controllers\BerandaAdminController;
use App\Http\Controllers\JenisPembayaranController;
use App\Http\Controllers\PosTagihanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\SantriController;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\TagihanController;
use Illuminate\Support\Facades\Route;

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




//Route khusus admin 
Route::prefix('admin')->middleware(['auth', 'akses:admin'])->group( function() {
    Route::get('beranda', [BerandaAdminController::class, 'index'])->name('admin.beranda');
    Route::resource('program', ProgramController::class);
    Route::resource('sekolahformal', SekolahController::class);
    Route::resource('angkatan', AngkatanController::class);
    Route::post('/angkatan/{id}/set-aktif', [AngkatanController::class, 'setAktif'])->name('angkatan.setAktif');
    Route::resource('postagihan', PosTagihanController::class );
    Route::resource('jenis-pembayaran', JenisPembayaranController::class);


    Route::resource('datasantri', SantriController::class);
});

require __DIR__.'/auth.php';
