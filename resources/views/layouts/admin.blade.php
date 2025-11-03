<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Toggle CSS -->
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap Toggle JS -->
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <!-- Tambahkan Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>

    @stack('styles')
<style>
    body {
        display: flex;
        font-family: 'Poppins', sans-serif; /* ✅ Semua teks pakai Poppins */
    }
    
    .sidebar {
        width: 250px;
        background-color:#F0F8FF;
        color: black;
        height: 100vh;
        padding: 20px;
        position: fixed;
    }
    
    .sidebar-title {
        text-align: center;
        display: block;
        font-weight: 500; /* ✅ Tebal sama dengan sidebar */
        font-size: 30px;
        padding: 10px 5px;
        font-weight: bold;
    }
    
    .sidebar a {
        font-size: 18px;
        font-weight: 600; /* ✅ Tebal sama */
        display: block;
        color: black;
        padding: 10px;
        text-decoration: none;
        border-radius: 5px;
        margin-bottom: 5px;
        transition: 0.3s;
    }
    
    .sidebar a:hover, .sidebar a.active {
        background-color: #17a2b8;
        color: white;
    }

    /* ✅ Font untuk tabel perusahaan */
    .table-container {
        margin-left: 250px;
        padding: 20px;
        width: 100%;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        font-family: 'Poppins', sans-serif; /* ✅ Font Poppins untuk tabel */
    }

    th, td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
        font-size: 14px; /* Ukuran font lebih kecil */
        font-weight: normal; /* Berat font normal */
    }

    th {
        background-color: #212529;
        color: white;
        font-weight: 600;
    }

    .submenu {
        font-family: 'Poppins', sans-serif; 
        display: none; /* ✅ Menyembunyikan submenu saat pertama kali dimuat */
        list-style: none;
        padding-left: 20px;
    }

    .submenu li a {
        font-size: 18px;
        font-weight: 600; /* ✅ Tebal sama */
        display: block;
        padding: 8px 10px;
        color: black;
        text-decoration: none;
        border-radius: 5px;
        transition: 0.3s;
    }

    .submenu li a:hover {
        background-color: #17a2b8;
        color: white;
    }

    .content {
        margin-left: 250px;
        width: 100%;
        padding: 20px;
    }

    .topbar {
        background-color: #000;
        color: white;
        padding: 10px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .card {
        border: none;
    }

    /* Styling untuk DataTable */
    .card-body {
        padding: 20px;
    }

    .card-header {
        text-align: left;
        padding: 15px 20px;
        background-color: #f8f9fa;
    }

    /* Container untuk tombol tambah - posisi disembunyikan */
    .card-body > a.btn-success {
        display: none;
    }

    /* Table-responsive wrapper */
    .table-responsive {
        margin-top: 20px;
        position: relative;
    }

    /* Tombol Tambah Data dipindahkan - sekarang menggunakan class btn-tambah */
    .btn-tambah {
        background-color: #1e7e34;
        color: white;
        border: none;
        padding: 6px 12px;
        border-radius: 4px;
        text-decoration: none;
        margin-left: 10px;
    }
    .btn-tambah:hover {
        background-color: #218838;
        color: white;
    }

    /* Menambahkan jarak antara elemen DataTable dengan tabel */
    div.dataTables_wrapper div.dataTables_length,
    div.dataTables_wrapper div.dataTables_filter {
        margin-bottom: 15px;
    }

    /* Styling khusus untuk dataTables_filter dan btn-tambah berdampingan */
    div.dataTables_wrapper div.dataTables_filter {
        display: flex;
        align-items: center;
        justify-content: flex-end;
    }

    /* Styling untuk tombol "Show entries" dan search */
    div.dataTables_wrapper div.dataTables_length select {
        padding: 5px 10px;
        border-radius: 4px;
        border: 1px solid #ced4da;
        margin: 0 5px;
    }

    div.dataTables_wrapper div.dataTables_filter input {
        padding: 5px 10px;
        border-radius: 4px;
        border: 1px solid #ced4da;
        margin-left: 5px;
        width: 200px;
    }

    /* DataTable header dan body */
    table.dataTable thead th,
    table.dataTable thead td {
        padding: 10px;
        border-bottom: 1px solid #ddd;
    }

    table.dataTable tbody th,
    table.dataTable tbody td {
        padding: 10px;
    }

    /* Tampilan zebra-striping pada tabel */
    table.dataTable.stripe tbody tr.odd,
    table.dataTable.display tbody tr.odd {
        background-color: #f2f2f2;
    }

    /* Styling untuk tombol Edit dan Hapus */
    .btn-warning {
        background-color: #ffc107;
        border-color: #ffc107;
        color: #212529;
    }

    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
        color: #fff;
    }

    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
        border-radius: 0.2rem;
    }

    /* Badge untuk status */
    .badge {
        padding: 5px 10px;
        border-radius: 4px;
        font-weight: normal;
    }

    /* Styling untuk tampilan search dan pagination */
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 5px 10px;
        margin-left: 2px;
        border: 1px solid #ddd;
        border-radius: 4px;
        background-color: #fff;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background-color: #17a2b8;
        color: white !important;
        border: 1px solid #17a2b8;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background-color: #e9ecef;
        color: #212529 !important;
    }

    /* Container header */
    .header-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    .header-container h4 {
        margin-bottom: 0;
    }

    /* Kotak tampilan seperti di gambar */
    .card-body {
        background-color: #fff;
        border-radius: 0 0 5px 5px;
    }

    .card-header {
        background-color: #f0f8ff;
        border-radius: 5px 5px 0 0;
        border-bottom: none;
    }

    /* Styling untuk DataTable - Light Mode */
    table.dataTable thead th,
    table.dataTable thead td {
        padding: 10px;
        border-bottom: 1px solid #eaeaea;
        border-top: 1px solid #eaeaea;
        background-color: #ffffff;
        color: #333333;
        font-weight: 600;
    }

    .table-light {
        background-color: #ffffff;
        color: #333333;
    }

    /* Zebra striping for light mode */
    table.dataTable.stripe tbody tr.odd,
    table.dataTable.display tbody tr.odd {
        background-color: #ffffff;
    }

    table.dataTable.stripe tbody tr.even,
    table.dataTable.display tbody tr.even {
        background-color: #fafafa;
    }

    /* Hover effect for rows */
    table.dataTable tbody tr:hover {
        background-color: #f5f5f5;
    }

    /* Pagination buttons for light mode */
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 5px 10px;
        margin-left: 2px;
        border: 1px solid #eaeaea;
        border-radius: 4px;
        background-color: #ffffff;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background-color: #f5f5f5;
        color: #333333 !important;
        border: 1px solid #eaeaea;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background-color: #f0f0f0;
        color: #333333 !important;
    }
</style>

</head>
<body>
    <div class="sidebar">
        <span class="sidebar-title">PENCAKER</span>
        <a href="{{ route('dashboard') }}" class="{{ request()->is('dashboard') ? 'active' : '' }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <!-- <a href="{{ route('master.index') }}" class="{{ request()->is('master*') ? 'active' : '' }}"><i class="fas fa-layer-group"></i>Master</a> -->
        <!-- Menu Master dengan Submenu -->
        <a href="{{ route('master.index') }}" class="menu-toggle">
            <i class="fas fa-layer-group"></i> Master <i class="fas fa-chevron-down float-end"></i>
        </a>
        <ul class="submenu">
            <li class="nav-item">
                <a href="{{ route('admin.agama.index') }}" class="{{ request()->is('admin/agama') ? 'active' : '' }}">
                    <i class="fa-solid fa-hands-praying"></i> Agama
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.pendidikan.index') }}" class="{{ request()->is('admin/pendidikan') ? 'active' : '' }}">
                    <i class="fas fa-graduation-cap"></i> Pendidikan
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.bahasa_asing.index') }}" class="{{ request()->is('admin/bahasa_asing') ? 'active' : '' }}">
                    <i class="fas fa-language"></i> Bahasa Asing
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.status_perkawinan.index') }}" class="{{ request()->is('admin/status_perkawinan') ? 'active' : '' }}">
                    <i class="fas fa-ring"></i> Status Perkawinan
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.kelurahan.index') }}" class="{{ request()->is('admin/kelurahan') ? 'active' : '' }}">
                    <i class="fas fa-map-marked-alt"></i> Kelurahan
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.disabilitas.index') }}" class="{{ request()->is('admin/disabilitas') ? 'active' : '' }}">
                    <i class="fas fa-wheelchair"></i> Disabilitas
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.sektor_usaha.index') }}" class="{{ request()->is('admin/sektor_usaha') ? 'active' : '' }}">
                    <i class="fas fa-industry"></i> Sektor Usaha
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.kelompok_jabatan.index') }}" class="{{ request()->is('admin/kelompok_jabatan') ? 'active' : '' }}">
                    <i class="fas fa-user-tie"></i> Kelompok Jabatan
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.besaran_upah.index') }}" class="{{ request()->is('admin/besaran_upah') ? 'active' : '' }}">
                    <i class="fas fa-money-bill"></i> Besaran Upah
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.kecamatan.index') }}" class="{{ request()->is('admin/kecamatan') ? 'active' : '' }}">
                    <i class="fas fa-city"></i> Kecamatan
                </a>
            </li>
        </ul>
        <a href="{{ route('perusahaan.index') }}" class="{{ request()->is('perusahaan*') ? 'active' : '' }}"><i class="fas fa-building"></i> Perusahaan</a>
        <a href="{{ route('loker.index') }}" class="{{ request()->is('loker*') ? 'active' : '' }}"><i class="fas fa-briefcase"></i> Loker</a>
        <a href="{{ route('admin.ak1.index') }}" class="{{ request()->is('admin/ak1*') ? 'active' : '' }}"><i class="fas fa-id-card"></i> AK1</a>
        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fa-solid fa-right-from-bracket"></i> Logout
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
        <!-- <a href="#"><i class="fa-solid fa-right-from-bracket"></i> Logout</a> -->
    </div>
    <div class="content">
        <div class="topbar">
            <span><i class="fas fa-user"></i> Welcome to Admin Page</span>
        </div>

        <!-- Tampilkan konten dari view yang di-extend -->
        @yield('content')
    </div>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Flash Message Pop-up -->
    @if(session('success'))
    <script>
        Swal.fire({
            title: 'Sukses!',
            text: "{{ session('success') }}",
            icon: 'success',
            confirmButtonText: 'OK'
        });
    </script>
    @endif

    <!-- Toggle Submenu -->
    <script>
        $(document).ready(function(){
            $(".menu-toggle").click(function(e){
                e.preventDefault();
                let submenu = $(this).next(".submenu");
                let arrow = $(this).find(".arrow");

                submenu.slideToggle();
                arrow.toggleClass("rotate");
            });
        });
    </script>

    <script>
    $(document).ready(function () {
        $(".nav-link").click(function (e) {
            e.preventDefault();
            var url = $(this).attr('href');
            
            $("#content-area").load(url + " #content-area > *");
        });

        $('.summernote').summernote({
             tabsize: 2,
        height: 200
        });
    });
    </script>

    @stack('scripts')
</body>
</html>
