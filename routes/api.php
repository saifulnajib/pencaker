<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RuteController;
use App\Http\Controllers\Api\SampahController;
use App\Http\Controllers\Api\SurveyController;
use App\Http\Controllers\Api\ProklimController;
use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\Api\KendaraanController;
use App\Http\Controllers\Api\BankSampahController;
use App\Http\Controllers\Api\PengawasanController;
use App\Http\Controllers\Api\JenisSampahController;
use App\Http\Controllers\Api\PemetaanTPSController;
use App\Http\Controllers\Api\PemetaanTSLController;
use App\Http\Controllers\Api\KegiatanUsahaController;
use App\Http\Controllers\Api\UsulanProklimController;
use App\Http\Controllers\Api\JenisKendaraanController;
use App\Http\Controllers\Api\QuestionOptionController;
use App\Http\Controllers\Api\SuratRetribusiController;
use App\Http\Controllers\Api\KategoriProklimController;
use App\Http\Controllers\Api\PemilahanSampahController;
use App\Http\Controllers\Api\PenyedotanTinjaController;
use App\Http\Controllers\Api\PengolahanKomposController;
use App\Http\Controllers\Api\KategoriPenyedotanController;
use App\Http\Controllers\Api\SektorKegiatanUsahaController;
use App\Http\Controllers\Api\QuisionerController;
use App\Http\Controllers\Api\LokasiPemantauanController;
use App\Http\Controllers\Api\ZonasiController;
use App\Http\Controllers\Api\PenjaringanIsuController;
use App\Http\Controllers\Api\DimensiIsuController;
use App\Http\Controllers\Api\IsuController;
use App\Http\Controllers\Api\JawabanIsuController;
use App\Http\Controllers\Api\DetilJawabanIsuController;
use App\Http\Controllers\Api\PengaduanController;
use App\Http\Controllers\Api\SuratKeringananController;
use App\Http\Controllers\Api\SanksiController;
use App\Http\Controllers\Api\PengelolaanLimbahController;
use App\Http\Controllers\Api\PegawaiController;
use App\Http\Controllers\Api\RiwayatKgbController;
use App\Http\Controllers\Api\RiwayatCutiController;
use App\Http\Controllers\Api\GroupController;
use App\Http\Controllers\Api\ModuleController;

use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\PerusahaanController;
use App\Http\Controllers\Api\LokerController;
use App\Http\Controllers\Api\AgamaController;
use App\Http\Controllers\Api\TingkatPendidikanController;
use App\Http\Controllers\Api\BahasaAsingController;
use App\Http\Controllers\Api\StatusPerkawinanController;
use App\Http\Controllers\Api\DisabilitasController;
use App\Http\Controllers\Api\SektorUsahaController;
use App\Http\Controllers\Api\KelompokJabatanController;
use App\Http\Controllers\Api\BesaranUpahController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('', function(){
    return response()->json(["status" => true, "message" => "Hello from Pencaker APIv1", 'date'    => date('d-F-Y'),'time'=>date('H:i:s')], 200);
});


Route::apiResource('loker', LokerController::class);
Route::apiResource('perusahaan', PerusahaanController::class);
Route::get('option/agama', [AgamaController::class, 'option']);
Route::get('option/tingkat-pendidikan', [TingkatPendidikanController::class, 'option']);
Route::get('option/bahasa-asing', [BahasaAsingController::class, 'option']);
Route::get('option/status-perkawinan', [StatusPerkawinanController::class, 'option']);
Route::get('option/disabilitas', [DisabilitasController::class, 'option']);
Route::get('option/sektor-usaha', [SektorUsahaController::class, 'option']);
Route::get('option/kelompok-jabatan', [KelompokJabatanController::class, 'option']);
Route::get('option/besaran-upah', [BesaranUpahController::class, 'option']);

Route::get('skm', [QuestionController::class, 'survey']);
Route::post('skm', [QuestionController::class, 'postAnswer']);
Route::get('questioner', [IsuController::class, 'questioner']);
Route::post('questioner', [IsuController::class, 'postAnswer']);
Route::post('form-skrd', [SuratRetribusiController::class, 'store']);
Route::post('form-bank-sampah', [BankSampahController::class, 'store']);
Route::post('form-proklim', [UsulanProklimController::class, 'store']);
Route::get('active-questioner', [PenjaringanIsuController::class, 'availableQuestioner']);
Route::post('form-pengaduan', [PengaduanController::class, 'store']);
Route::post('form-keringanan', [SuratKeringananController::class, 'store']);

Route::get('skm/hitung', [QuestionController::class, 'hitung']);

Route::controller(AuthController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
    Route::get('user', 'userInfo');
    Route::get('logout', 'logout');
});

Route::get('print/sampah', [SampahController::class, 'print']);
Route::get('print/sampah', [SampahController::class, 'print']);
Route::get('print/penyedotan-tinja/{tahun}/{bulan}', [PenyedotanTinjaController::class, 'print']);
Route::get('print/pemilahan-sampah/{tahun}/{bulan}', [PemilahanSampahController::class, 'print']);
Route::get('print/pengolahan-kompos/{tahun}/{bulan}', [PengolahanKomposController::class, 'print']);

Route::get('export/sampah_daily', [SampahController::class, 'exportSampahHarian']);
Route::get('export/pemungutan_daily', [SampahController::class, 'exportPemungutanHarian']);
Route::get('export/kpi_daily', [KendaraanController::class, 'exportKpiHarian']);
Route::get('export/truk_daily', [KendaraanController::class, 'exportTrukSampahHarian']);
Route::get('export/truk_monthly', [KendaraanController::class, 'exportTrukSampahBulanan']);
Route::get('export/sedot_tinja_monthly', [PenyedotanTinjaController::class, 'exportSedotTinjaBulanan']);
Route::get('export/lokasi_pemantauan_monthly', [LokasiPemantauanController::class, 'exportLokasiPemantauanBulanan']);
Route::get('export/pelaksanaan_pengawasan', [PengawasanController::class, 'exportPelaksanaanPengawasan']);
Route::get('export/pelaksanaan_pengawasan_rinci', [PengawasanController::class, 'exportPelaksanaanPengawasanRinci']);
Route::get('export/pengolahan_kompos_monthly', [PengolahanKomposController::class, 'exportPengolahanKomposBulanan']);
Route::get('export/pemilahan_sampah_monthly', [PemilahanSampahController::class, 'exportPemilahanSampahBulanan']);
Route::get('export/zonasi_monthly', [ZonasiController::class, 'exportZonasiBulanan']);
Route::get('export/pertek', [KegiatanUsahaController::class, 'exportPertek']);
Route::get('export/proklim', [ProklimController::class, 'exportProklim']);
Route::get('export/sanksi', [SanksiController::class, 'exportSanksi']);
Route::get('export/pengelolaan_limbah', [PengelolaanLimbahController::class, 'exportPengelolaanLimbah']);
Route::get('export/pegawai_pns', [PegawaiController::class, 'exportPegawaiPns']);
Route::get('export/pegawai_honorer', [PegawaiController::class, 'exportPegawaiHonorer']);
Route::get('export/riwayat_kgb', [RiwayatKgbController::class, 'exportRiwayatKgb']);
Route::get('export/riwayat_cuti', [RiwayatCutiController::class, 'exportRiwayatCuti']);
Route::get('export/kendaraan', [KendaraanController::class, 'exportKendaraan']);
Route::get('export/kegiatan_usaha', [KegiatanUsahaController::class, 'exportKegiatanUsaha']);
Route::get('export/bank_sampah', [BankSampahController::class, 'exportBankSampah']);
Route::get('export/surat_keringanan', [SuratKeringananController::class, 'exportSuratKeringanan']);
Route::get('export/surat_retribusi', [SuratRetribusiController::class, 'exportSuratRetribusi']);
Route::get('export/pengaduan', [PengaduanController::class, 'exportPengaduan']);
Route::get('export/usulan_proklim', [UsulanProklimController::class, 'exportUsulanProklim']);
Route::get('export/isu', [IsuController::class, 'exportIsu']);

Route::middleware('auth.jwt')->group( function () {
    Route::apiResource('jenis-kendaraan', JenisKendaraanController::class);
    Route::get('option/jenis-kendaraan', [JenisKendaraanController::class, 'option']);
    Route::apiResource('kategori-penyedotan', KategoriPenyedotanController::class);
    Route::get('option/kategori-penyedotan', [KategoriPenyedotanController::class, 'option']);
    Route::apiResource('rute', RuteController::class);
    Route::get('option/rute', [RuteController::class, 'option']);
    Route::apiResource('kendaraan', KendaraanController::class);
    Route::get('option/kendaraan', [KendaraanController::class, 'option']);
    Route::get('kpi', [KendaraanController::class, 'kpi']);
    Route::apiResource('jenis-sampah', JenisSampahController::class);
    Route::get('option/jenis-sampah', [JenisSampahController::class, 'option']);
    Route::apiResource('sampah', SampahController::class);
    Route::apiResource('surat-retribusi', SuratRetribusiController::class);
    Route::apiResource('penyedotan-tinja', PenyedotanTinjaController::class);
    Route::apiResource('pemilahan-sampah', PemilahanSampahController::class);
    Route::apiResource('pengolahan-kompos', PengolahanKomposController::class);
    Route::apiResource('survey', SurveyController::class);
    Route::apiResource('question', QuestionController::class);
    Route::apiResource('question-option', QuestionOptionController::class);

    Route::apiResource('quisioner', QuisionerController::class);

    Route::apiResource('bank-sampah', BankSampahController::class);
    Route::get('peta-bank-sampah', [BankSampahController::class, 'pemetaan']);

    Route::apiResource('kategori-proklim', KategoriProklimController::class);
    Route::get('option/kategori-proklim', [KategoriProklimController::class, 'option']);
    Route::apiResource('usulan-proklim', UsulanProklimController::class);

    Route::apiResource('proklim', ProklimController::class);
    Route::get('peta-proklim', [ProklimController::class, 'pemetaan']);

    Route::apiResource('sektor-kegiatan', SektorKegiatanUsahaController::class);
    Route::get('option/sektor-kegiatan', [SektorKegiatanUsahaController::class, 'option']);
    Route::apiResource('kegiatan-usaha', KegiatanUsahaController::class);
    Route::get('option/kegiatan-usaha', [KegiatanUsahaController::class, 'option']);
    Route::apiResource('pengawasan', PengawasanController::class);
    Route::get('riwayat-pengawasan/{id}', [PengawasanController::class, 'history']);

    Route::apiResource('pemetaan/tps', PemetaanTPSController::class);
    Route::get('peta-tps', [PemetaanTPSController::class, 'pemetaan']);

    Route::apiResource('pemetaan/sampah-liar', PemetaanTSLController::class);
    Route::get('peta-sampah-liar', [PemetaanTSLController::class, 'pemetaan']);

    Route::apiResource('pemantauan/lokasi', LokasiPemantauanController::class);
    Route::get('pemantauan/hasil', [LokasiPemantauanController::class, 'hasil']);

    Route::apiResource('zonasi', ZonasiController::class);
    Route::apiResource('penjaringan-isu', PenjaringanIsuController::class);
    Route::apiResource('dimensi-isu', DimensiIsuController::class);
    Route::get('option/dimensi-isu', [DimensiIsuController::class, 'option']);
    Route::apiResource('isu', IsuController::class);
    Route::apiResource('jawaban-isu', JawabanIsuController::class);
    Route::apiResource('detil-jawaban-isu', DetilJawabanIsuController::class);

    Route::get('dashboard', [DashboardController::class, 'index']);
    Route::get('logs', [DashboardController::class, 'logs']);

    Route::apiResource('pengaduan', PengaduanController::class);
    Route::apiResource('surat-keringanan', SuratKeringananController::class);
    Route::apiResource('sanksi', SanksiController::class);
    Route::apiResource('pengelolaan-limbah', PengelolaanLimbahController::class);
    Route::apiResource('pegawai', PegawaiController::class);
    Route::get('option/pegawai', [PegawaiController::class, 'option']);
    Route::apiResource('riwayat-kgb', RiwayatKgbController::class);
    Route::apiResource('riwayat-cuti', RiwayatCutiController::class);
    Route::apiResource('group', GroupController::class);
    Route::get('option/group', [GroupController::class, 'option']);
    Route::apiResource('module', ModuleController::class);
    Route::get('option/module', [ModuleController::class, 'option']);



});
