<?php

use App\Http\Controllers\Dashboard\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Codedge\Fpdf\Fpdf\Fpdf;
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

Auth::routes([
  'register' => true,
  'reset' => false,
  'verify' => false,
]);
Route::get('/forgot-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'index'])->name('forgot-password');

//home
Route::get('/', [App\Http\Controllers\Frontpage\HomeController::class, 'home'])->name('home-depan');
Route::post('/signup', [App\Http\Controllers\Frontpage\SignupController::class, 'signup'])->name('signup');
//contact front-page
Route::get('/contact', [App\Http\Controllers\Frontpage\ContactController::class, 'index'])->name('contact');
Route::post('/email', [App\Http\Controllers\Frontpage\ContactController::class, 'email'])->name('email.send');
//campaign front-page
Route::get('/campaign', [App\Http\Controllers\Frontpage\CampaignController::class, 'index'])->name('campaign');
Route::get('campaign-show', [App\Http\Controllers\Frontpage\CampaignController::class, 'show'])->name('campaign-show');
//berita front-page
Route::get('/berita', [App\Http\Controllers\Frontpage\BeritaController::class, 'index'])->name('berita');
Route::get('/berita{slug}', [App\Http\Controllers\Frontpage\BeritaController::class, 'detail'])->name('berita-detail');
//materi front-page
Route::get('/materi', [App\Http\Controllers\Frontpage\MateriController::class, 'index'])->name('materi');
Route::get('/materi{id}', [App\Http\Controllers\Frontpage\MateriController::class, 'detail'])->name('materi-detail');
//dokumen front-page
Route::get('/dokumen', [App\Http\Controllers\Frontpage\DokumenController::class, 'index'])->name('dokumen');
//galeri front-page
Route::get('/galeri-foto', [App\Http\Controllers\Frontpage\FotoController::class, 'index'])->name('galeri-foto');
Route::get('/galeri-vidio', [App\Http\Controllers\Frontpage\VideoController::class, 'index'])->name('galeri-vidio');
//artikel front-page
Route::get('/artikel', [App\Http\Controllers\Frontpage\ArtikelController::class, 'index'])->name('artikel');
Route::get('/artikel{slug}', [App\Http\Controllers\Frontpage\ArtikelController::class, 'detail'])->name('artikel-detail');
//visi-misi front-page
Route::get('/visi-misi', [App\Http\Controllers\Frontpage\VisiMisiController::class, 'index'])->name('visi-misi');
//sejarah front-page
Route::get('/sejarah', [App\Http\Controllers\Frontpage\SejarahController::class, 'index'])->name('sejarah');
//presatsi front-page
Route::get('/prestasi', [App\Http\Controllers\Frontpage\PrestasiController::class, 'index'])->name('prestasi');
Route::get('/prestasi{id}', [App\Http\Controllers\Frontpage\PrestasiController::class, 'detail'])->name('prestasi-detail');
//kepengurusan front-page
Route::get('/kepengurusan', [App\Http\Controllers\Frontpage\KepengurusanController::class, 'index'])->name('kepengurusan');
//adaart front-page
Route::get('/ad-art', [App\Http\Controllers\Frontpage\AdArtController::class, 'index'])->name('ad-art');
//sambutan magis front-page
Route::get('/sambutan-magis', [App\Http\Controllers\Frontpage\SambutanController::class, 'index'])->name('sambutan-magis');
//program kerja front-page
Route::get('/program-kerja', [App\Http\Controllers\Frontpage\ProgramkerjaController::class, 'index'])->name('program-kerja');


//Admin Page
Route::prefix('dashboard')->middleware(['auth','admin'])->group(function () {
  Route::get('/home', [App\Http\Controllers\Dashboard\HomeController::class, 'index'])->name('dashboard.home');
  Route::resource('profile', ProfileController::class);
  route::post('update-photo-profile', [ProfileController::class, 'update_photo_profile'])->name('dashboard.update-photo-profile');
  route::get('ubah-password', [ProfileController::class, 'update_password'])->name('dashboard.ubah-password');
  route::post('update-profile', [ProfileController::class, 'store_new_password'])->name('dashboard.update-password');
  
  Route::prefix('donasi')->group(function () {
    Route::get('/', [App\Http\Controllers\Dashboard\DonasiController::class, 'index'])->name('donasi.get');
    Route::get('/get', [App\Http\Controllers\Dashboard\DonasiController::class, 'datatables'])->name('donasi.datatables');
    Route::get('/create', [App\Http\Controllers\Dashboard\DonasiController::class, 'create'])->name('donasi.create');
    Route::post('/create', [App\Http\Controllers\Dashboard\DonasiController::class, 'save'])->name('donasi.save');
    Route::get('/{id}', [App\Http\Controllers\Dashboard\DonasiController::class, 'edit'])->name('donasi.edit');
    Route::post('/{id}', [App\Http\Controllers\Dashboard\DonasiController::class, 'update'])->name('donasi.update');
    Route::delete('/{id}', [App\Http\Controllers\Dashboard\DonasiController::class, 'delete'])->name('donasi.delete');
  });
  Route::prefix('carousel_admin')->group(function () {
    Route::get('carousel_admin', [App\Http\Controllers\Dashboard\ProfileMenu\CarouselController::class, 'index'])->name('carousel_admin');
    Route::post('data-carousel_admin-register', [App\Http\Controllers\Dashboard\ProfileMenu\CarouselController::class, 'store'])->name('carousel.data-carousel-register');
    Route::get('data-carousel-delete/{id}', [App\Http\Controllers\Dashboard\ProfileMenu\CarouselController::class, 'destroy'])->name('carousel.data-carousel-delete');

  });
  //profile
  Route::prefix('sambutan_mabigus_admin')->group(function () {
    Route::get('mabigus_admin', [App\Http\Controllers\Dashboard\ProfileMenu\MabigusController::class, 'index'])->name('mabigus_admin');
    Route::post('data-mabigus-update', [App\Http\Controllers\Dashboard\ProfileMenu\MabigusController::class, 'update'])->name('mabigus.data-mabigus-update');
  });
  Route::prefix('sejarah_admin')->group(function () {
    Route::get('sejarah_admin', [App\Http\Controllers\Dashboard\ProfileMenu\SejarahController::class, 'index'])->name('sejarah_admin');
    Route::post('data-sejarah-update', [App\Http\Controllers\Dashboard\ProfileMenu\SejarahController::class, 'update'])->name('sejarah.data-sejarah-update');
  });
  Route::prefix('visimisi_admin')->group(function () {
    Route::get('visimisi_admin', [App\Http\Controllers\Dashboard\ProfileMenu\VisiMisiController::class, 'index'])->name('visimisi_admin');
    Route::post('data-visimisi-update', [App\Http\Controllers\Dashboard\ProfileMenu\VisiMisiController::class, 'update'])->name('visimisi.data-visimisi-update');
  });
  Route::prefix('ad-art_admin')->group(function () {
    Route::get('ad-art_admin', [App\Http\Controllers\Dashboard\ProfileMenu\AdArtController::class, 'index'])->name('ad-art_admin');
    Route::post('data-ad-art-update', [App\Http\Controllers\Dashboard\ProfileMenu\AdArtController::class, 'update'])->name('ad-art.data-ad-art-update');
  });
  Route::prefix('kepengurusan_admin')->group(function () {
    Route::get('kepengurusan_admin', [App\Http\Controllers\Dashboard\ProfileMenu\KepengurusanController::class, 'index'])->name('kepengurusan_admin');
    Route::post('data-kepengurusan-update', [App\Http\Controllers\Dashboard\ProfileMenu\KepengurusanController::class, 'update'])->name('kepengurusan.data-kepengurusan-update');
  });
  Route::prefix('proker_admin')->group(function () {
    Route::get('proker_admin', [App\Http\Controllers\Dashboard\ProfileMenu\ProkerController::class, 'index'])->name('proker_admin');
    Route::post('data-proker-update', [App\Http\Controllers\Dashboard\ProfileMenu\ProkerController::class, 'update'])->name('proker.data-proker-update');
  });
  Route::prefix('prestasi_admin')->group(function () {
    Route::get('prestasi_admin', [App\Http\Controllers\Dashboard\ProfileMenu\PrestasiController::class, 'index'])->name('prestasi_admin');
    Route::post('data-prestasi-register', [App\Http\Controllers\Dashboard\ProfileMenu\PrestasiController::class, 'store'])->name('prestasi.data-prestasi-register');
    Route::get('data-prestasi-delete/{id}', [App\Http\Controllers\Dashboard\ProfileMenu\PrestasiController::class, 'destroy'])->name('prestasi.data-prestasi-delete');
    Route::get('data-prestasi-edit/{id}', [App\Http\Controllers\Dashboard\ProfileMenu\PrestasiController::class, 'edit'])->name('prestasi.data-prestasi-edit');
    Route::post('data-prestasi-update', [App\Http\Controllers\Dashboard\ProfileMenu\PrestasiController::class, 'update'])->name('prestasi.data-prestasi-update');
    Route::get('data-prestasi-datatable', [App\Http\Controllers\Dashboard\ProfileMenu\PrestasiController::class, 'datatable'])->name('prestasi.data-prestasi-datatable');
  });
  Route::prefix('agenda_admin')->group(function () {
    Route::get('agenda_admin', [App\Http\Controllers\Dashboard\ProfileMenu\AgendaController::class, 'index'])->name('agenda_admin');
    Route::get('data-agenda-show', [App\Http\Controllers\Dashboard\ProfileMenu\AgendaController::class, 'show'])->name('agenda.data-agenda-show');
    Route::post('data-agenda-register', [App\Http\Controllers\Dashboard\ProfileMenu\AgendaController::class, 'store'])->name('agenda.data-agenda-register');
    Route::get('data-agenda-delete/{id}', [App\Http\Controllers\Dashboard\ProfileMenu\AgendaController::class, 'destroy'])->name('agenda.data-agenda-delete');
    Route::get('data-agenda-edit/{id}', [App\Http\Controllers\Dashboard\ProfileMenu\AgendaController::class, 'edit'])->name('agenda.data-agenda-edit');
    Route::post('data-agenda-update', [App\Http\Controllers\Dashboard\ProfileMenu\AgendaController::class, 'update'])->name('agenda.data-agenda-update');
    Route::get('data-agenda-datatable', [App\Http\Controllers\Dashboard\ProfileMenu\AgendaController::class, 'datatable'])->name('agenda.data-agenda-datatable');
  });
  Route::prefix('konten_admin')->group(function () {
    Route::get('konten_admin', [App\Http\Controllers\Dashboard\ProfileMenu\KontenController::class, 'index'])->name('konten_admin');
    Route::post('data-konten-register', [App\Http\Controllers\Dashboard\ProfileMenu\KontenController::class, 'store'])->name('konten.data-konten-register');
    Route::get('data-konten-delete/{id}', [App\Http\Controllers\Dashboard\ProfileMenu\KontenController::class, 'destroy'])->name('konten.data-konten-delete');
    Route::get('data-konten-edit/{id}', [App\Http\Controllers\Dashboard\ProfileMenu\KontenController::class, 'edit'])->name('konten.data-konten-edit');
    Route::post('data-konten-update', [App\Http\Controllers\Dashboard\ProfileMenu\KontenController::class, 'update'])->name('konten.data-konten-update');
    Route::get('data-konten-datatable', [App\Http\Controllers\Dashboard\ProfileMenu\KontenController::class, 'datatable'])->name('konten.data-konten-datatable');
  });
  Route::prefix('foto_admin')->group(function () {
    Route::get('foto_admin', [App\Http\Controllers\Dashboard\ProfileMenu\ImageController::class, 'index'])->name('foto_admin');
    Route::post('data-foto-register', [App\Http\Controllers\Dashboard\ProfileMenu\ImageController::class, 'store'])->name('foto.data-foto-register');
    Route::get('data-foto-delete/{id}', [App\Http\Controllers\Dashboard\ProfileMenu\ImageController::class, 'destroy'])->name('foto.data-foto-delete');
  });
  Route::prefix('video_admin')->group(function () {
    Route::get('video_admin', [App\Http\Controllers\Dashboard\ProfileMenu\VideoController::class, 'index'])->name('video_admin');
    Route::post('data-video-register', [App\Http\Controllers\Dashboard\ProfileMenu\VideoController::class, 'store'])->name('video.data-video-register');
    Route::get('data-video-delete/{id}', [App\Http\Controllers\Dashboard\ProfileMenu\VideoController::class, 'destroy'])->name('video.data-video-delete');
  });
  Route::prefix('kontak_admin')->group(function () {
    Route::get('kontak_admin', [App\Http\Controllers\Dashboard\ProfileMenu\KontakController::class, 'index'])->name('kontak_admin');
    Route::post('data-kontak-update', [App\Http\Controllers\Dashboard\ProfileMenu\KontakController::class, 'update'])->name('kontak.data-kontak-update');
  });
  Route::prefix('kategori_dokumen_admin')->group(function () {
    Route::get('kategori_dokumen_admin', [App\Http\Controllers\Dashboard\ProfileMenu\KategoriDokumenController::class, 'index'])->name('kategori_dokumen_admin');
    Route::post('data-kategori_dokumen-register', [App\Http\Controllers\Dashboard\ProfileMenu\KategoriDokumenController::class, 'store'])->name('kategori_dokumen.data-kategori_dokumen-register');
    Route::get('data-kategori_dokumen-delete/{id}', [App\Http\Controllers\Dashboard\ProfileMenu\KategoriDokumenController::class, 'destroy'])->name('kategori_dokumen.data-kategori_dokumen-delete');
    Route::get('data-kategori_dokumen-edit/{id}', [App\Http\Controllers\Dashboard\ProfileMenu\KategoriDokumenController::class, 'edit'])->name('kategori_dokumen.data-kategori_dokumen-edit');
    Route::post('data-kategori_dokumen-update', [App\Http\Controllers\Dashboard\ProfileMenu\KategoriDokumenController::class, 'update'])->name('kategori_dokumen.data-kategori_dokumen-update');
    Route::get('data-kategori_dokumen-datatable', [App\Http\Controllers\Dashboard\ProfileMenu\KategoriDokumenController::class, 'datatable'])->name('kategori_dokumen.data-kategori_dokumen-datatable');
  });
  Route::prefix('dokumen_admin')->group(function () {
    Route::get('dokumen_admin', [App\Http\Controllers\Dashboard\ProfileMenu\DokumenController::class, 'index'])->name('dokumen_admin');
    Route::post('data-dokumen_admin-register', [App\Http\Controllers\Dashboard\ProfileMenu\DokumenController::class, 'store'])->name('dokumen_admin.data-dokumen_admin-register');
    Route::get('data-dokumen_admin-delete/{id}', [App\Http\Controllers\Dashboard\ProfileMenu\DokumenController::class, 'destroy'])->name('dokumen_admin.data-dokumen_admin-delete');
    Route::get('data-dokumen_admin-edit/{id}', [App\Http\Controllers\Dashboard\ProfileMenu\DokumenController::class, 'edit'])->name('dokumen_admin.data-dokumen_admin-edit');
    Route::post('data-dokumen_admin-update', [App\Http\Controllers\Dashboard\ProfileMenu\DokumenController::class, 'update'])->name('dokumen_admin.data-dokumen_admin-update');
    Route::get('data-dokumen_admin-datatable', [App\Http\Controllers\Dashboard\ProfileMenu\DokumenController::class, 'datatable'])->name('dokumen_admin.data-dokumen_admin-datatable');
  });
  Route::prefix('pengajuan_admin')->group(function () {
    Route::get('pengajuan_admin', [App\Http\Controllers\Dashboard\ProfileMenu\PengajuanController::class, 'index'])->name('pengajuan_admin');
    Route::post('data-pengajuan_admin-register', [App\Http\Controllers\Dashboard\ProfileMenu\PengajuanController::class, 'store'])->name('pengajuan_admin.data-pengajuan_admin-register');
    Route::get('data-pengajuan_admin-delete/{id}', [App\Http\Controllers\Dashboard\ProfileMenu\PengajuanController::class, 'destroy'])->name('pengajuan_admin.data-pengajuan_admin-delete');
    Route::get('data-pengajuan_admin-edit/{id}', [App\Http\Controllers\Dashboard\ProfileMenu\PengajuanController::class, 'edit'])->name('pengajuan_admin.data-pengajuan_admin-edit');
    Route::post('data-pengajuan_admin-update', [App\Http\Controllers\Dashboard\ProfileMenu\PengajuanController::class, 'update'])->name('pengajuan_admin.data-pengajuan_admin-update');
    Route::get('data-pengajuan_admin-datatable', [App\Http\Controllers\Dashboard\ProfileMenu\PengajuanController::class, 'datatable'])->name('pengajuan_admin.data-pengajuan_admin-datatable');
  });
  Route::prefix('user_admin')->group(function () {
    Route::get('user_admin', [App\Http\Controllers\Dashboard\ProfileMenu\UserController::class, 'index'])->name('user_admin');
    Route::get('data-user-datatable', [App\Http\Controllers\Dashboard\ProfileMenu\UserController::class, 'datatable'])->name('user.data-user-datatable');
    Route::get('data-user-edit/{id}', [App\Http\Controllers\Dashboard\ProfileMenu\UserController::class, 'edit'])->name('user.data-user-edit');
    Route::post('data-user-promosi/{id}', [App\Http\Controllers\Dashboard\ProfileMenu\UserController::class, 'promosi'])->name('user.data-user-promosi');
    Route::post('data-user-down/{id}', [App\Http\Controllers\Dashboard\ProfileMenu\UserController::class, 'down'])->name('user.data-user-down');
    Route::get('data-user-delete/{id}', [App\Http\Controllers\Dashboard\ProfileMenu\UserController::class, 'destroy'])->name('user.data-user-delete');
    Route::post('data-user-update', [App\Http\Controllers\Dashboard\ProfileMenu\UserController::class, 'update'])->name('user.data-user-update');
  });
  Route::prefix('pengajuan_user_admin')->group(function () {
    Route::get('pengajuan_user_admin', [App\Http\Controllers\Dashboard\ProfileMenu\PengajuanRegister::class, 'index'])->name('pengajuan_user_admin');
    Route::get('data-pengajuan-user-datatable', [App\Http\Controllers\Dashboard\ProfileMenu\PengajuanRegister::class, 'datatable'])->name('pengajuan.data-pengajuan-user-datatable');
    Route::get('approve-pengajuan-user/{id}', [App\Http\Controllers\Dashboard\ProfileMenu\PengajuanRegister::class, 'approve'])->name('pengajuan.approve-pengajuan-user');
  });
  Route::prefix('sku_admin')->group(function () {
    Route::get('sku_admin', [App\Http\Controllers\Dashboard\ProfileMenu\SKUController::class, 'index'])->name('sku_admin');
    Route::post('data-sku-register', [App\Http\Controllers\Dashboard\ProfileMenu\SKUController::class, 'store'])->name('sku.data-sku-register');
    Route::get('data-sku-delete/{id}', [App\Http\Controllers\Dashboard\ProfileMenu\SKUController::class, 'destroy'])->name('sku.data-sku-delete');
    Route::get('data-sku-edit/{id}', [App\Http\Controllers\Dashboard\ProfileMenu\SKUController::class, 'edit'])->name('sku.data-sku-edit');
    Route::post('data-sku-update', [App\Http\Controllers\Dashboard\ProfileMenu\SKUController::class, 'update'])->name('sku.data-sku-update');
    Route::get('data-sku-datatable', [App\Http\Controllers\Dashboard\ProfileMenu\SKUController::class, 'datatable'])->name('sku.data-sku-datatable');
  });
  Route::prefix('skk_admin')->group(function () {
    Route::get('skk_admin', [App\Http\Controllers\Dashboard\ProfileMenu\SKKController::class, 'index'])->name('skk_admin');
    Route::post('data-skk-register', [App\Http\Controllers\Dashboard\ProfileMenu\SKKController::class, 'store'])->name('skk.data-skk-register');
    Route::get('data-skk-delete/{id}', [App\Http\Controllers\Dashboard\ProfileMenu\SKKController::class, 'destroy'])->name('skk.data-skk-delete');
    Route::get('data-skk-edit/{id}', [App\Http\Controllers\Dashboard\ProfileMenu\SKKController::class, 'edit'])->name('skk.data-skk-edit');
    Route::post('data-skk-update', [App\Http\Controllers\Dashboard\ProfileMenu\SKKController::class, 'update'])->name('skk.data-skk-update');
    Route::get('data-skk-datatable', [App\Http\Controllers\Dashboard\ProfileMenu\SKKController::class, 'datatable'])->name('skk.data-skk-datatable');
  });
  Route::prefix('kategori_skk_admin')->group(function () {
    Route::get('kategori_skk_admin', [App\Http\Controllers\Dashboard\ProfileMenu\KategoriSKKController::class, 'index'])->name('kategori_skk_admin');
    Route::post('data-kategori_skk-register', [App\Http\Controllers\Dashboard\ProfileMenu\KategoriSKKController::class, 'store'])->name('kategori_skk.data-kategori_skk-register');
    Route::get('data-kategori_skk-delete/{id}', [App\Http\Controllers\Dashboard\ProfileMenu\KategoriSKKController::class, 'destroy'])->name('kategori_skk.data-kategori_skk-delete');
    Route::get('data-kategori_skk-edit/{id}', [App\Http\Controllers\Dashboard\ProfileMenu\KategoriSKKController::class, 'edit'])->name('kategori_skk.data-kategori_skk-edit');
    Route::post('data-kategori_skk-update', [App\Http\Controllers\Dashboard\ProfileMenu\KategoriSKKController::class, 'update'])->name('kategori_skk.data-kategori_skk-update');
    Route::get('data-kategori_skk-datatable', [App\Http\Controllers\Dashboard\ProfileMenu\KategoriSKKController::class, 'datatable'])->name('kategori_skk.data-kategori_skk-datatable');
  });
  Route::prefix('barang_admin')->group(function () {
    Route::get('barang_admin', [App\Http\Controllers\Dashboard\ProfileMenu\BarangController::class, 'index'])->name('barang_admin');
    Route::post('data-barang-register', [App\Http\Controllers\Dashboard\ProfileMenu\BarangController::class, 'store'])->name('barang.data-barang-register');
    Route::get('data-barang-delete/{id}', [App\Http\Controllers\Dashboard\ProfileMenu\BarangController::class, 'destroy'])->name('barang.data-barang-delete');
    Route::get('data-barang-edit/{id}', [App\Http\Controllers\Dashboard\ProfileMenu\BarangController::class, 'edit'])->name('barang.data-barang-edit');
    Route::post('data-barang-update', [App\Http\Controllers\Dashboard\ProfileMenu\BarangController::class, 'update'])->name('barang.data-barang-update');
    Route::get('data-barang-datatable', [App\Http\Controllers\Dashboard\ProfileMenu\BarangController::class, 'datatable'])->name('barang.data-barang-datatable');
  });
  Route::prefix('faq_admin')->group(function () {
    Route::get('faq_admin', [App\Http\Controllers\Dashboard\ProfileMenu\FAQController::class, 'index'])->name('faq_admin');
    Route::post('data-faq-register', [App\Http\Controllers\Dashboard\ProfileMenu\FAQController::class, 'store'])->name('faq.data-faq-register');
    Route::get('data-faq-delete/{id}', [App\Http\Controllers\Dashboard\ProfileMenu\FAQController::class, 'destroy'])->name('faq.data-faq-delete');
    Route::get('data-faq-edit/{id}', [App\Http\Controllers\Dashboard\ProfileMenu\FAQController::class, 'edit'])->name('faq.data-faq-edit');
    Route::post('data-faq-update', [App\Http\Controllers\Dashboard\ProfileMenu\FAQController::class, 'update'])->name('faq.data-faq-update');
    Route::get('data-faq-datatable', [App\Http\Controllers\Dashboard\ProfileMenu\FAQController::class, 'datatable'])->name('faq.data-faq-datatable');
  });
  Route::prefix('profile_admin')->group(function () {
    Route::get('profile_admin', [App\Http\Controllers\Dashboard\ProfileMenu\ProfileController::class, 'index'])->name('profile_admin');
    Route::post('data-profile-update', [App\Http\Controllers\Dashboard\ProfileMenu\ProfileController::class, 'update'])->name('profile.data-profile-update');
  });
});

//user
Route::prefix('user')->middleware(['auth','user'])->group(function () {
  Route::get('/home', [App\Http\Controllers\DashboardUser\HomeController::class, 'index'])->name('user.dashboard');
  Route::prefix('pengajuan-user')->group(function () {
    Route::get('pengajuan-user', [App\Http\Controllers\DashboardUser\SKUController::class, 'index'])->name('pengajuan-user');
    Route::post('data-pengajuan_user-register', [App\Http\Controllers\DashboardUser\SKUController::class, 'store'])->name('pengajuan_user.data-pengajuan_user-register');
    Route::post('pengajuan-user-update', [App\Http\Controllers\DashboardUser\SKUController::class, 'update'])->name('pengajuan.pengajuan-user-update');
    Route::get('pengajuan-user-datatable', [App\Http\Controllers\DashboardUser\SKUController::class, 'datatable'])->name('pengajuan.pengajuan-user-datatable');
  });
  Route::prefix('daftar-pengajuan-user')->group(function () {
    Route::get('daftar-pengajuan-user', [App\Http\Controllers\DashboardUser\DaftarSKUController::class, 'index'])->name('daftar-pengajuan-user');
    Route::post('daftar-pengajuan-user-update', [App\Http\Controllers\DashboardUser\DaftarSKUController::class, 'update'])->name('pengajuan.daftar-pengajuan-user-update');
    Route::get('daftar-pengajuan-user-edit/{id}', [App\Http\Controllers\DashboardUser\DaftarSKUController::class, 'edit'])->name('pengajuan.daftar-pengajuan-user-edit');
    Route::get('daftar-pengajuan-user-datatable', [App\Http\Controllers\DashboardUser\DaftarSKUController::class, 'datatable'])->name('pengajuan.daftar-pengajuan-user-datatable');
  });
  Route::prefix('soal-sku-user')->group(function () {
    Route::get('soal-sku-user/{id}', [App\Http\Controllers\DashboardUser\SoalSKUController::class, 'index'])->name('soal-sku-user');
    Route::post('soal-sku-user-jawaban', [App\Http\Controllers\DashboardUser\SoalSKUController::class, 'jawaban'])->name('pengajuan.soal-sku-user-jawaban');
    Route::post('soal-sku-user-update', [App\Http\Controllers\DashboardUser\SoalSKUController::class, 'update'])->name('pengajuan.soal-sku-user-update');
  });
  Route::prefix('skk-user')->group(function () {
    Route::get('skk-user', [App\Http\Controllers\DashboardUser\SKKController::class, 'index'])->name('skk-user');
    Route::post('data-skk_user-register', [App\Http\Controllers\DashboardUser\SKKController::class, 'store'])->name('skk_user.data-skk_user-register');
    Route::post('skk-user-update', [App\Http\Controllers\DashboardUser\SKKController::class, 'update'])->name('skk.skk-user-update');
    Route::get('skk-user-datatable', [App\Http\Controllers\DashboardUser\SKKController::class, 'datatable'])->name('skk.skk-user-datatable');
    Route::get('kirim-kategori-skk/{kategori}', [App\Http\Controllers\DashboardUser\SKKController::class, 'tingkat'])->name('skk.kirim-kategori-skk');
  });
  Route::prefix('daftar-skk-user')->group(function () {
    Route::get('daftar-skk-user', [App\Http\Controllers\DashboardUser\DaftarSKKController::class, 'index'])->name('daftar-skk-user');
    Route::post('daftar-skk-user-update', [App\Http\Controllers\DashboardUser\DaftarSKKController::class, 'update'])->name('skk.daftar-skk-user-update');
    Route::get('daftar-skk-user-edit/{id}', [App\Http\Controllers\DashboardUser\DaftarSKKController::class, 'edit'])->name('skk.daftar-skk-user-edit');
    Route::get('daftar-skk-user-datatable', [App\Http\Controllers\DashboardUser\DaftarSKKController::class, 'datatable'])->name('skk.daftar-skk-user-datatable');
  });
  Route::prefix('soal-skk-user')->group(function () {
    Route::get('soal-skk-user/{id}', [App\Http\Controllers\DashboardUser\SoalSKKController::class, 'index'])->name('soal-skk-user');
    Route::post('soal-skk-user-jawaban', [App\Http\Controllers\DashboardUser\SoalSKKController::class, 'jawaban'])->name('skk.soal-skk-user-jawaban');
    Route::post('soal-skk-user-update', [App\Http\Controllers\DashboardUser\SoalSKKController::class, 'update'])->name('skk.soal-skk-user-update');
  });
  Route::prefix('fpdf')->group(function () {
    Route::post('generate-sertifikat-user', [App\Http\Controllers\DashboardUser\SertifikatSKUController::class, 'fpdf'])->name('generate-sertifikat-user');
    Route::post('view-pdf', [App\Http\Controllers\DashboardUser\SertifikatSKUController::class, 'viewpdf'])->name('view-pdf');
  });
  Route::prefix('fpdf')->group(function () {
    Route::post('generate-sertifikat-skk', [App\Http\Controllers\DashboardUser\SertifikatSKKController::class, 'fpdf'])->name('generate-sertifikat-skk');
    Route::post('view-pdf-skk', [App\Http\Controllers\DashboardUser\SertifikatSKKController::class, 'viewpdf'])->name('view-pdf-skk');
  });
  Route::prefix('detail-user')->group(function () {
    Route::get('detail-user-edit/{id}', [App\Http\Controllers\DashboardUser\SKUController::class, 'detail'])->name('detail-user-edit');
  });
  Route::prefix('detail-user-skk')->group(function () {
    Route::get('detail-user-edit-skk/{id}', [App\Http\Controllers\DashboardUser\SKKController::class, 'detail'])->name('detail-user-edit-skk');
  });
  route::get('profile_admin_user', [App\Http\Controllers\DashboardUser\ProfileController::class, 'index'])->name('dashboard.profile_admin_user');
  route::post('update-photo-profile-user', [App\Http\Controllers\DashboardUser\ProfileController::class, 'update_photo_profile'])->name('dashboard.update-photo-profile-user');
  route::get('ubah-password-user', [App\Http\Controllers\DashboardUser\ProfileController::class, 'update_password'])->name('dashboard.ubah-password-user');
  route::post('update-profile-user', [App\Http\Controllers\DashboardUser\ProfileController::class, 'store_new_password'])->name('dashboard.update-password-user');
  route::post('update-user-user', [App\Http\Controllers\DashboardUser\ProfileController::class, 'update'])->name('dashboard.update-user-user');

});

Route::prefix('admin-angkatan')->middleware(['auth','admin_angkatan'])->group(function () {
  Route::get('/home', [App\Http\Controllers\AdminAngkatan\HomeController::class, 'index'])->name('admin-angkatan.dashboard');

  Route::prefix('pengajuan-admin-angkatan')->group(function () {
    Route::get('pengajuan-admin-angkatan', [App\Http\Controllers\AdminAngkatan\SKUController::class, 'index'])->name('pengajuan-admin-angkatan');
    Route::post('pengajuan-admin-angkatan-update', [App\Http\Controllers\AdminAngkatan\SKUController::class, 'update'])->name('pengajuan.pengajuan-admin-angkatan-update');
    Route::get('pengajuan-admin-angkatan-edit/{id}', [App\Http\Controllers\AdminAngkatan\SKUController::class, 'edit'])->name('pengajuan.pengajuan-admin-angkatan-edit');
    Route::get('pengajuan-admin-angkatan-datatable', [App\Http\Controllers\AdminAngkatan\SKUController::class, 'datatable'])->name('pengajuan.pengajuan-admin-angkatan-datatable');
  });
  Route::prefix('skk-admin-angkatan')->group(function () {
    Route::get('skk-admin-angkatan', [App\Http\Controllers\AdminAngkatan\SKKController::class, 'index'])->name('skk-admin-angkatan');
    Route::post('skk-admin-angkatan-update', [App\Http\Controllers\AdminAngkatan\SKKController::class, 'update'])->name('skk.skk-admin-angkatan-update');
    Route::get('skk-admin-angkatan-edit/{id}', [App\Http\Controllers\AdminAngkatan\SKKController::class, 'edit'])->name('skk.skk-admin-angkatan-edit');
    Route::get('skk-admin-angkatan-datatable', [App\Http\Controllers\AdminAngkatan\SKKController::class, 'datatable'])->name('skk.skk-admin-angkatan-datatable');
  });
  Route::prefix('user_admin_angkatan')->group(function () {
    Route::get('user_admin_angkatan', [App\Http\Controllers\AdminAngkatan\UserController::class, 'index'])->name('user_admin_angkatan');
    Route::get('data-user-angkatan-datatable', [App\Http\Controllers\AdminAngkatan\UserController::class, 'datatable'])->name('user.data-user-angkatan-datatable');
    Route::get('data-user-angkatan-edit/{id}', [App\Http\Controllers\AdminAngkatan\UserController::class, 'edit'])->name('user.data-user-angkatan-edit');
    Route::post('data-user-angkatan-promosi/{id}', [App\Http\Controllers\AdminAngkatan\UserController::class, 'promosi'])->name('user.data-user-angkatan-promosi');
    Route::post('data-user-angkatan-down/{id}', [App\Http\Controllers\AdminAngkatan\UserController::class, 'down'])->name('user.data-user-angkatan-down');
    Route::get('data-user-angkatan-delete/{id}', [App\Http\Controllers\AdminAngkatan\UserController::class, 'destroy'])->name('user.data-user-angkatan-delete');
    Route::post('data-user-angkatan-update', [App\Http\Controllers\AdminAngkatan\UserController::class, 'update'])->name('user.data-user-update');
  });
  Route::prefix('pengajuan_user_admin_angkatan')->group(function () {
    Route::get('pengajuan_user_admin_angkatan', [App\Http\Controllers\AdminAngkatan\PengajuanRegisterController::class, 'index'])->name('pengajuan_user_admin_angkatan');
    Route::get('data-pengajuan-user-angkatan-datatable', [App\Http\Controllers\AdminAngkatan\PengajuanRegisterController::class, 'datatable'])->name('pengajuan.data-pengajuan-user-angkatan-datatable');
    Route::get('approve-pengajuan-user-angkatan/{id}', [App\Http\Controllers\AdminAngkatan\PengajuanRegisterController::class, 'approve'])->name('pengajuan.approve-pengajuan-user-angkatan');
  });
  route::get('profile_admin_angkatan', [App\Http\Controllers\AdminAngkatan\ProfileController::class, 'index'])->name('dashboard.profile_admin_angkatan');
  route::post('update-photo-profile-angkatan', [App\Http\Controllers\AdminAngkatan\ProfileController::class, 'update_photo_profile'])->name('dashboard.update-photo-profile-angkatan');
  route::get('ubah-password-angkatan', [App\Http\Controllers\AdminAngkatan\ProfileController::class, 'update_password'])->name('dashboard.ubah-password-angkatan');
  route::post('update-profile-angkatan', [App\Http\Controllers\AdminAngkatan\ProfileController::class, 'store_new_password'])->name('dashboard.update-password-angkatan');
  route::post('update-user-angkatan', [App\Http\Controllers\AdminAngkatan\ProfileController::class, 'update'])->name('dashboard.update-user-angkatan');
  
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
