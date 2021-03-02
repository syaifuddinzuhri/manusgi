<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Backend\AlbumController;
use App\Http\Controllers\Backend\AplikasiController;
use App\Http\Controllers\Backend\BeritaController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\JurusanController;
use App\Http\Controllers\Backend\KategoriController;
use App\Http\Controllers\Backend\PendidikController;
use App\Http\Controllers\Backend\PengumumanController;
use App\Http\Controllers\Backend\PrestasiController;
use App\Http\Controllers\Backend\SarprasController;
use App\Http\Controllers\Backend\SejarahController;
use App\Http\Controllers\Backend\TagController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\VisiMisiController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProfilController;
use App\Http\Controllers\Frontend\PublikasiController;
use Illuminate\Support\Facades\Artisan;
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

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('frontend.home');
Route::get('/sejarah', [ProfilController::class, 'sejarah'])->name('frontend.sejarah');
Route::get('/visi-misi', [ProfilController::class, 'visiMisi'])->name('frontend.visimisi');
Route::get('/sarana-prasarana', [ProfilController::class, 'sarpras'])->name('frontend.sarpras');
Route::get('/tenaga-pendidik', [ProfilController::class, 'pendidik'])->name('frontend.pendidik');
Route::get('/galeri', [ProfilController::class, 'galeri'])->name('frontend.galeri');
Route::get('/jurusan', [ProfilController::class, 'jurusan'])->name('frontend.jurusan');
Route::get('/berita', [PublikasiController::class, 'berita'])->name('frontend.berita');
Route::get('/berita/search', [PublikasiController::class, 'cariBerita'])->name('frontend.cariberita');
Route::get('/berita/{slug}', [PublikasiController::class, 'detailBerita'])->name('frontend.detailberita');
Route::get('/prestasi', [PublikasiController::class, 'prestasi'])->name('frontend.prestasi');
Route::get('/prestasi/search', [PublikasiController::class, 'cariPrestasi'])->name('frontend.cariprestasi');
Route::get('/prestasi/{slug}', [PublikasiController::class, 'detailPrestasi'])->name('frontend.detailprestasi');
Route::get('/pengumuman', [PublikasiController::class, 'pengumuman'])->name('frontend.pengumuman');
Route::get('/pengumuman/search', [PublikasiController::class, 'cariPengumuman'])->name('frontend.caripengumuman');
Route::get('/pengumuman/download/{slug}', [PublikasiController::class, 'downloadFile'])->name('frontend.pengumuman_downloadfile');
Route::get('/ppdb-ma-nu-sunan-giri-2021', [PublikasiController::class, 'ppdb'])->name('frontend.ppdb');
// Route::get('/pengumuman/{slug}', [PublikasiController::class, 'detailPengumuman'])->name('frontend.detailpengumuman');


// Backend Routes
Route::group(['prefix' => 'admin'], function () {
    Route::auth();
    Route::get('/', function () {
        return redirect()->route('backend.admin_dashboard');
    });
    Route::post('/logout', [LoginController::class, 'logout'])->name('backend.admin_logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('backend.admin_dashboard');

    // User Route
    Route::put('/user/update-data', [UserController::class, 'updateData'])->name('backend.user_updatedata');
    Route::put('/user/update-password', [UserController::class, 'updatePassword'])->name('backend.user_updatepassword');

    // Sejarah Route
    Route::get('/sejarah', [SejarahController::class, 'index'])->name('backend.sejarah_index');
    Route::post('/sejarah/upload-image', [SejarahController::class, 'uploadImage'])->name('backend.sejarah_uploadimage');
    Route::post('/sejarah/delete-image', [SejarahController::class, 'deleteImage'])->name('backend.sejarah_deleteimage');
    Route::post('/sejarah/update-thumbnail/{id}', [SejarahController::class, 'updateThumbnail']);
    Route::delete('/sejarah/delete-thumbnail/{id}', [SejarahController::class, 'deleteThumbnail'])->name('backend.sejarah_deletethumbnail');

    // Visi Misi Route
    Route::get('/visi-misi', [VisiMisiController::class, 'index'])->name('backend.visimisi_index');
    Route::post('/visi-misi', [VisiMisiController::class, 'store'])->name('backend.visimisi_store');
    Route::post('/visi-misi/update-thumbnail', [VisiMisiController::class, 'updateThumbnail'])->name('backend.visimisi_updatethumbnail');
    Route::put('/visi-misi/{id}', [VisiMisiController::class, 'update'])->name('backend.visimisi_update');
    Route::delete('/visi-misi/delete-thumbnail/{id}', [VisiMisiController::class, 'deleteThumbnail'])->name('backend.visimisi_deletethumbnail');

    // Berita Route
    Route::get('/berita/get-tags/{slug}', [BeritaController::class, 'getTags'])->name('backend.berita_gettags');
    Route::post('/berita/upload-image', [BeritaController::class, 'uploadImage'])->name('backend.berita_uploadimage');
    Route::post('/berita/delete-image', [BeritaController::class, 'deleteImage'])->name('backend.berita_deleteimage');
    Route::post('/berita/update-thumbnail/{id}', [BeritaController::class, 'updateThumbnail']);
    Route::put('/berita/update-tags/{id}', [BeritaController::class, 'updateTags']);

    // Pengumuman Route
    Route::post('/pengumuman/upload-image', [PengumumanController::class, 'uploadImage'])->name('backend.pengumuman_uploadimage');
    Route::post('/pengumuman/delete-image', [PengumumanController::class, 'deleteImage'])->name('backend.pengumuman_deleteimage');
    Route::post('/pengumuman/update-file/{id}', [PengumumanController::class, 'updateFile'])->name('backend.pengumuman_updatefile');
    Route::get('/pengumuman/download/{id}', [PengumumanController::class, 'downloadFile'])->name('backend.pengumuman_downloadfile');


    // Prestasi Route
    Route::post('/prestasi/upload-image', [PrestasiController::class, 'uploadImage'])->name('backend.prestasi_uploadimage');
    Route::post('/prestasi/delete-image', [PrestasiController::class, 'deleteImage'])->name('backend.prestasi_deleteimage');
    Route::post('/prestasi/update-thumbnail/{id}', [PrestasiController::class, 'updateThumbnail']);

    // Aplikasi Route
    Route::post('/aplikasi/update-logo/{id}', [AplikasiController::class, 'updateLogo']);
    Route::put('/aplikasi/update-sosmed/{id}', [AplikasiController::class, 'updateSosmed']);

    // Album Route
    Route::post('/album/uploadImage', [AlbumController::class, 'uploadImage'])->name('backend.upload_dropzone');
    Route::get('/album/show-galeri/{id}', [AlbumController::class, 'showGaleri']);
    Route::delete('/album/delete/{id}', [AlbumController::class, 'deleteGambar']);
    // Route::delete('/album/delete-gambar/{id}', [AlbumController::class, 'deleteGambar']);

    // Jurusan Route
    Route::post('/jurusan/update-thumbnail/{id}', [JurusanController::class, 'updateThumbnail']);

    // Sarpras Route
    Route::post('/sarpras/update-thumbnail/{id}', [SarprasController::class, 'updateThumbnail']);

    // Pendidik Route
    Route::post('/pendidik/update-foto/{id}', [PendidikController::class, 'updateFoto']);

    // Resource Route
    Route::resource('pendidik', PendidikController::class);

    Route::resource('jurusan', JurusanController::class, [
        'only' => ['index', 'store', 'show', 'update', 'destroy']
    ]);
    Route::resource('sarpras', SarprasController::class, [
        'only' => ['index', 'store', 'update', 'destroy']
    ]);
    Route::resource('album', AlbumController::class, [
        'only' => ['index', 'store', 'edit', 'update', 'destroy']
    ]);
    Route::resource('aplikasi', AplikasiController::class, [
        'only' => ['index', 'update']
    ]);
    Route::resource('prestasi', PrestasiController::class, [
        'only' => ['index', 'create', 'store', 'edit', 'update', 'destroy']
    ]);
    Route::resource('pengumuman', PengumumanController::class, [
        'only' => ['index', 'store', 'show', 'create', 'edit', 'update', 'destroy']
    ]);
    Route::resource('berita', BeritaController::class, [
        'only' => ['index', 'create', 'store', 'edit', 'update', 'destroy']
    ]);
    Route::resource('user', UserController::class, [
        'only' => ['index', 'store', 'show', 'edit', 'destroy']
    ]);
    Route::resource('sejarah', SejarahController::class, [
        'only' => ['index', 'update']
    ]);
    Route::resource('kategori', KategoriController::class, [
        'only' => ['index', 'store', 'update', 'destroy']
    ]);
    Route::resource('tag', TagController::class, [
        'only' => ['index', 'store', 'update', 'destroy']
    ]);
});