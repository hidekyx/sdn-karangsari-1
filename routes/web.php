<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SarprasController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'home']);
Route::get('/profil/identitas-sekolah', [HomeController::class, 'profil_identitas']);
Route::get('/profil/profil-sekolah', [HomeController::class, 'profil_profil']);
Route::get('/profil/sarana-dan-prasarana', [HomeController::class, 'profil_sarana']);
Route::get('/profil/guru-dan-karyawan', [HomeController::class, 'guru_list']);
Route::get('/profil/get-guru-data/{id_guru}', [HomeController::class, 'guru_detail']);
Route::get('/profil/siswa', [HomeController::class, 'siswa']);
Route::get('/profil/get-siswa-data/{id_siswa}', [HomeController::class, 'siswa_detail']);

Route::get('/login', [AuthController::class, 'login']);
Route::post('/login_action', [AuthController::class, 'login_action']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/dashboard', [DashboardController::class, 'home']);

Route::get('/dashboard/siswa', [SiswaController::class, 'list']);
Route::get('/dashboard/siswa/tambah', [SiswaController::class, 'create']);
Route::get('/dashboard/siswa/edit/{id_siswa}', [SiswaController::class, 'edit']);
Route::post('/dashboard/siswa/store', [SiswaController::class, 'store']);
Route::post('/dashboard/siswa/update/{id_siswa}', [SiswaController::class, 'update']);
Route::post('/dashboard/siswa/delete/{id_siswa}', [SiswaController::class, 'delete']);

Route::get('/dashboard/guru', [GuruController::class, 'list']);
Route::get('/dashboard/guru/tambah', [GuruController::class, 'create']);
Route::get('/dashboard/guru/edit/{id_guru}', [GuruController::class, 'edit']);
Route::post('/dashboard/guru/store', [GuruController::class, 'store']);
Route::post('/dashboard/guru/update/{id_guru}', [GuruController::class, 'update']);
Route::post('/dashboard/guru/delete/{id_guru}', [GuruController::class, 'delete']);

Route::get('/dashboard/guru/jadwal/list/{id_guru}', [JadwalController::class, 'list']);
Route::get('/dashboard/guru/jadwal/tambah/{id_guru}', [JadwalController::class, 'create']);
Route::post('/dashboard/guru/jadwal/store/{id_guru}', [JadwalController::class, 'store']);
Route::get('/dashboard/guru/jadwal/edit/{id_guru}/{id_jadwal}', [JadwalController::class, 'edit']);
Route::post('/dashboard/guru/jadwal/update/{id_guru}/{id_jadwal}', [JadwalController::class, 'update']);
Route::post('/dashboard/guru/jadwal/delete/{id_guru}/{id_jadwal}', [JadwalController::class, 'delete']);

Route::get('/dashboard/kelas', [KelasController::class, 'list']);

Route::get('/dashboard/sarpras', [SarprasController::class, 'list']);
Route::get('/dashboard/sarpras/tambah', [SarprasController::class, 'create']);
Route::get('/dashboard/sarpras/edit/{id_sarpras}', [SarprasController::class, 'edit']);
Route::post('/dashboard/sarpras/store', [SarprasController::class, 'store']);
Route::post('/dashboard/sarpras/update/{id_sarpras}', [SarprasController::class, 'update']);
Route::post('/dashboard/sarpras/delete/{id_sarpras}', [SarprasController::class, 'delete']);

Route::get('/dashboard/absensi/list/', [AbsensiController::class, 'list']);
Route::get('/dashboard/absensi/detail/{id_absensi}', [AbsensiController::class, 'detail']);
Route::get('/dashboard/absensi/create/{id_jadwal}', [AbsensiController::class, 'create']);
Route::get('/dashboard/absensi/edit/{id_jadwal}/{id_absensi}', [AbsensiController::class, 'edit']);
Route::post('/dashboard/absensi/store/{id_jadwal}', [AbsensiController::class, 'store']);
Route::post('/dashboard/absensi/update/{id_absensi}', [AbsensiController::class, 'update']);

Route::get('/dashboard/kegiatan', [KegiatanController::class, 'list']);
Route::get('/dashboard/kegiatan/tambah', [KegiatanController::class, 'create']);
Route::get('/dashboard/kegiatan/edit/{id_kegiatan}', [KegiatanController::class, 'edit']);
Route::post('/dashboard/kegiatan/store', [KegiatanController::class, 'store']);
Route::post('/dashboard/kegiatan/update/{id_kegiatan}', [KegiatanController::class, 'update']);
Route::post('/dashboard/kegiatan/delete/{id_kegiatan}', [KegiatanController::class, 'delete']);