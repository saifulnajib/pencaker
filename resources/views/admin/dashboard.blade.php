@extends('layouts.admin')

@section('content')
<style>
    .dashboard-card {
        color: white;
        margin-bottom: 1rem;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        text-align: center;
        padding: 25px;
        border-radius: 8px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 120px; /* Ukuran yang sama untuk semua kartu */
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.2);
    }

    .bg-blue { background: #3F51B5 !important; }
    .bg-yellow { background: #FFB300 !important; }
    .bg-cyan { background: #00ACC1 !important; }
    .bg-red { background:rgb(46, 238, 97) !important; }
    .bg-pink { background: #D32F2F !important; } /* Warna untuk AK1 Belum Terverifikasi */

    .row {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
    }

    .col-md-2 {
        flex: 1;
        min-width: 200px;
        max-width: 250px;
        margin: 10px;
    }
</style>

<div class="container text-center mt-4">
    <h2 class="fw-bold mb-3" style="font-family: 'Lora', serif;">
        Selamat Datang di Sistem Informasi Disnaker Kota Tanjungpinang
    </h2>

    <div class="row">
        <div class="col-md-6">
            <div class="dashboard-card bg-blue text-center p-4">
                <i class="">
                <lord-icon
                    src="https://cdn.lordicon.com/hyvuvsxh.json"
                    trigger="loop"
                    delay="2000"
                    style="width:55px;height:55px;  margin-bottom:0px;">
                </lord-icon>
</i>
                <h3 class="fw-bold mb-0 mt-0">{{ $jumlah_perusahaan ?? 0 }}</h3>
                <p class="mb-0 mt-0">Perusahaan</p>
            </div>
        </div>

        <div class="col-md-6">
            <div class="dashboard-card bg-yellow text-center p-4">
                <i class="">
                <lord-icon
                    src="https://cdn.lordicon.com/obyhgzls.json"
                    trigger="loop"
                    delay="2000"
                    style="width:55px; height:55px; margin-bottom:0px;">
                </lord-icon>
</i>
                <h3 class="fw-bold mb-0 mt-0">{{ $jumlah_loker ?? 0 }}</h3>
                <p class="mb-0 mt-0">Loker</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="dashboard-card bg-cyan text-center p-4">
                <i class="">
                    <lord-icon
                    src="https://cdn.lordicon.com/tbabdzcy.json"
                    trigger="loop"
                    delay="2000"
                    colors="primary:#121331,secondary:#d59f80"
                    style="width:55px;height:55px">
                </lord-icon>
                </i>
                <h3 class="fw-bold mb-0 mt-0">{{ $jumlah_permohonan_ak1 ?? 0 }}</h3>
                <p class="mb-0 mt-0">Permohonan AK1</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="dashboard-card bg-red text-center p-4">
                 <i class="">
                    <lord-icon
                    src="https://cdn.lordicon.com/rnbuzxxk.json"
                    trigger="hover"
                    colors="primary:#000000,secondary:#b4b4b4"
                    style="width:55px;height:55px">
                </lord-icon>
</i>
                <h3 class="fw-bold mb-0 mt-0">{{ $jumlah_ak1_terverifikasi ?? 0 }}</h3>
                <p class="mb-0 mt-0">AK1 Terverifikasi</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="dashboard-card bg-pink text-center p-4">
                 <i class="">
                    <lord-icon
                    src="https://cdn.lordicon.com/pilfbsjh.json"
                    trigger="hover"
                    colors="primary:#000000,secondary:#c67d53,tertiary:#ffffff"
                    style="width:55px;height:55px">
                </lord-icon>
                 </i>
                <h3 class="fw-bold mb-0 mt-0">{{ $jumlah_ak1_belum_terverifikasi ?? 0 }}</h3>
                <p class="mb-0 mt-0">AK1 Belum Terverifikasi</p>
            </div>
        </div>
    </div>
</div>

                <script src="https://cdn.lordicon.com/lordicon.js"></script>
@endsection
