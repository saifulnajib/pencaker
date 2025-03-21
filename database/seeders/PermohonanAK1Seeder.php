<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;
use App\Models\Agama;
use App\Models\Kelurahan;
use App\Models\BesaranUpah;
use App\Models\Disabilitas;
use App\Models\KelompokJabatan;
use App\Models\SektorUsaha;
use App\Models\StatusPerkawinan;
use App\Models\TingkatPendidikan;
use Illuminate\Support\Facades\File;

class PermohonanAK1Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        
        // Ambil ID dari tabel relasi
        $agamaIds = Agama::pluck('id')->toArray();
        $kelurahanIds = Kelurahan::pluck('id')->toArray();
        $besaranUpahIds = BesaranUpah::pluck('id')->toArray();
        $disabilitasIds = Disabilitas::pluck('id')->toArray();
        $kelompokJabatanIds = KelompokJabatan::pluck('id')->toArray();
        $sektorUsahaIds = SektorUsaha::pluck('id')->toArray();
        $statusPerkawinanIds = StatusPerkawinan::pluck('id')->toArray();
        $tingkatPendidikanIds = TingkatPendidikan::pluck('id')->toArray();
        
        // Tambahkan ID null untuk disabilitas (karena nullable)
        $disabilitasIdsWithNull = array_merge($disabilitasIds, [null]);
        
        // Nama-nama universitas populer di Indonesia
        $universitasIndonesia = [
            'Universitas Indonesia',
            'Institut Teknologi Bandung',
            'Universitas Gadjah Mada',
            'Universitas Airlangga',
            'Universitas Diponegoro',
            'Universitas Brawijaya',
            'Institut Teknologi Sepuluh Nopember',
            'Universitas Padjadjaran',
            'Universitas Negeri Jakarta',
            'Universitas Pendidikan Indonesia',
            'Universitas Sebelas Maret',
            'Universitas Sumatera Utara',
            'Universitas Hasanuddin',
            'Universitas Islam Indonesia',
            'Universitas Bina Nusantara',
            'Politeknik Negeri Jakarta',
            'Politeknik Negeri Bandung',
            'Universitas Gunadarma',
            'Universitas Muhammadiyah Jakarta',
            'Universitas Islam Negeri Syarif Hidayatullah'
        ];
        
        // Jurusan populer di Indonesia
        $jurusanPopuler = [
            'Teknik Informatika',
            'Manajemen',
            'Akuntansi',
            'Kedokteran',
            'Ilmu Hukum',
            'Ekonomi',
            'Teknik Sipil',
            'Teknik Elektro',
            'Psikologi',
            'Ilmu Komunikasi',
            'Farmasi',
            'Sistem Informasi',
            'Sastra Inggris',
            'Pendidikan Dokter',
            'Teknik Industri',
            'Administrasi Bisnis',
            'Pendidikan Bahasa Inggris',
            'Ilmu Keperawatan',
            'Arsitektur',
            'Agribisnis'
        ];
        
        // Jabatan yang diminati
        $jabatanDiminati = [
            'Staff Administrasi',
            'Marketing',
            'Customer Service',
            'Programmer',
            'Web Developer',
            'Mobile Developer',
            'Guru',
            'Akuntan',
            'Digital Marketing',
            'Graphic Designer',
            'UI/UX Designer',
            'Data Analyst',
            'Project Manager',
            'Product Manager',
            'Human Resources',
            'Content Creator',
            'Sales',
            'Business Development',
            'Teknisi',
            'Admin Media Sosial'
        ];
        
        // Kota di Indonesia
        $kotaIndonesia = [
            'Jakarta', 'Surabaya', 'Bandung', 'Medan', 'Semarang', 
            'Makassar', 'Palembang', 'Tangerang', 'Depok', 'Bekasi',
            'Yogyakarta', 'Malang', 'Bogor', 'Batam', 'Denpasar',
            'Samarinda', 'Padang', 'Bandar Lampung', 'Pekanbaru', 'Banjarmasin'
        ];
        
        // Negara populer untuk bekerja
        $negaraPopuler = [
            'Malaysia', 'Singapura', 'Jepang', 'Korea Selatan', 'Taiwan',
            'Hong Kong', 'Australia', 'Amerika Serikat', 'Uni Emirat Arab', 'Qatar'
        ];

        // Buat 50 data dummy
        for ($i = 0; $i < 50; $i++) {
            // Data pribadi
            $gender = $faker->randomElement(['Laki-laki', 'Perempuan']);
            $firstName = $gender == 'Laki-laki' ? $faker->firstNameMale : $faker->firstNameFemale;
            $lastName = $faker->lastName;
            $fullName = $firstName . ' ' . $lastName;
            
            // Tanggal lahir (17-45 tahun yang lalu)
            $tanggalLahir = $faker->dateTimeBetween('-45 years', '-17 years')->format('Y-m-d');
            
            // Nomor telepon dengan awalan 08 dan 12 digit
            $noHP = '08' . $faker->numerify('##########');
            
            // Status perkawinan dan jumlah anak
            $statusPerkawinanId = $faker->randomElement($statusPerkawinanIds);
            $jumlahAnak = 0;
            
            // Tentukan jumlah anak berdasarkan status perkawinan
            // Dalam kasus nyata, kita perlu mengecek apakah status ini 'Menikah'
            // Untuk sederhananya, kita gunakan probabilitas
            if ($statusPerkawinanId == 2) { // Asumsikan ID 2 adalah menikah
                $jumlahAnak = $faker->numberBetween(0, 4);
            }
            
            // Pendidikan
            $tingkatPendidikanId = $faker->randomElement($tingkatPendidikanIds);
            $institusiPendidikan = $faker->randomElement($universitasIndonesia);
            $jurusan = $faker->randomElement($jurusanPopuler);
            
            // Minat Kerja
            $jabatanMinat = $faker->randomElement($jabatanDiminati);
            $lokasiKerja = $faker->randomElement(['Dalam Negeri', 'Luar Negeri']);
            $kotaNegaraMinat = $lokasiKerja == 'Dalam Negeri' 
                ? $faker->randomElement($kotaIndonesia)
                : $faker->randomElement($negaraPopuler);
            
            // Pernah bekerja atau tidak
            $pernahBekerja = $faker->boolean(70); // 70% kemungkinan pernah bekerja
            $keteranganPengalaman = $pernahBekerja 
                ? $faker->paragraph(2) 
                : null;
            
            DB::table('permohonan_ak1')->insert([
                'id_agama' => $faker->randomElement($agamaIds),
                'id_kelurahan' => $faker->randomElement($kelurahanIds),
                'id_besaran_upah' => $faker->randomElement($besaranUpahIds),
                'id_disabilitas' => $faker->randomElement($disabilitasIdsWithNull),
                'id_kelompok_jabatan' => $faker->randomElement($kelompokJabatanIds),
                'id_sektor_usaha' => $faker->randomElement($sektorUsahaIds),
                'id_status_perkawinan' => $statusPerkawinanId,
                'id_tingkat_pendidikan' => $tingkatPendidikanId,
                
                // Data Pribadi
                'nama' => $fullName,
                'email' => strtolower(str_replace(' ', '.', $fullName)) . '@' . $faker->freeEmailDomain,
                'nik' => $faker->numerify('################'), // 16 digit NIK
                'tempat_lahir' => $faker->city,
                'tanggal_lahir' => $tanggalLahir,
                'tinggi_badan' => $faker->numberBetween(150, 190),
                'berat_badan' => $faker->numberBetween(45, 90),
                'jumlah_anak' => $jumlahAnak,
                'kendaraan' => $faker->randomElement(['Tidak Punya', 'Roda 2', 'Roda 4']),
                'gender' => $gender,
                'tempat_tinggal' => $faker->randomElement(['Sewa', 'Milik Sendiri', 'Menumpang Dengan Keluarga']),
                'alamat' => $faker->streetAddress,
                'rt' => $faker->numerify('##'),
                'rw' => $faker->numerify('##'),
                'kode_pos' => $faker->postcode,
                'no_hp' => $noHP,
                
                // Pendidikan
                'institusi_pendidikan' => $institusiPendidikan,
                'jurusan' => $jurusan,
                'tahun_lulus' => $faker->numberBetween(Carbon::parse($tanggalLahir)->addYears(17)->year, Carbon::now()->year),
                'nilai' => $faker->randomFloat(2, 2.5, 4.0),
                
                // Minat Kerja
                'jabatan_minat' => $jabatanMinat,
                'lokasi_kerja' => $lokasiKerja,
                'kota_negara_minat' => $kotaNegaraMinat,
                'keterangan_singkat_pengalaman' => $keteranganPengalaman,
                'is_pernah_bekerja' => $pernahBekerja,
                
                // Status & Timestamps
                'file_foto' => 'uploads/ak1/tipe_file_foto_dummy.png',
                'file_ktp' => 'uploads/ak1/tipe_file_ktp_dummy.png',
                'file_ijazah' => 'uploads/ak1/tipe_file_ijazah_dummy.pdf',
                'file_transkrip' => 'uploads/ak1/tipe_file_transkrip_dummy.pdf',
                'file_ak1' => 'uploads/ak1/tipe_file_ak1_dummy.pdf',
                'is_active' => $faker->boolean(80), // 80% kemungkinan aktif
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => now(),
            ]);
        }

        // delete semua file di folder storage/app/public/uploads/ak1
        $files = File::allFiles(storage_path('app/public/uploads/ak1'));
        foreach ($files as $file) {
            File::delete($file);
        }

        // copy file dummy dari folder public ke folder storage
        $sourcePath = public_path('images/dummy.png');
        $destinationPath = storage_path('app/public/uploads/ak1/tipe_file_foto_dummy.png');
        File::copy($sourcePath, $destinationPath);

        $sourcePath = public_path('images/dummy.png');
        $destinationPath = storage_path('app/public/uploads/ak1/tipe_file_ktp_dummy.png');
        File::copy($sourcePath, $destinationPath);

        $sourcePath = public_path('documents/dummy.pdf');
        $destinationPath = storage_path('app/public/uploads/ak1/tipe_file_ijazah_dummy.pdf');
        File::copy($sourcePath, $destinationPath);

        $sourcePath = public_path('documents/dummy.pdf');
        $destinationPath = storage_path('app/public/uploads/ak1/tipe_file_transkrip_dummy.pdf');
        File::copy($sourcePath, $destinationPath);

        $sourcePath = public_path('documents/dummy.pdf');
        $destinationPath = storage_path('app/public/uploads/ak1/tipe_file_ak1_dummy.pdf');
        File::copy($sourcePath, $destinationPath);
    }
}
