@extends('layouts.admin')

@section('content')
<div class="mt-4">
    <div class="card">
        <div class="card-header bg-primary bg-opacity-10 text-dark">
            <h4 class="mb-0">Daftar Perusahaan</h4>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <a href="{{ route('perusahaan.create') }}" class="btn-tambah" id="btnTambahPerusahaan">Tambah Data</a>
                <table id="perusahaanTable" class="table table-striped table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Email</th>
                            <th>Telepon</th>
                            <th>Logo</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($perusahaans as $p)
                        <tr>
                            <td>{{ $p->id }}</td>
                            <td>{{ $p->name }}</td>
                            <td>{{ $p->alamat }}</td>
                            <td>{{ $p->email }}</td>
                            <td>{{ $p->telp }}</td>
                            <td class="text-center">
                                @if($p->logo)
                                    <img src="{{ asset('storage/'.$p->logo) }}" alt="Logo" class="img-thumbnail" style="max-height: 50px;">
                                @else
                                    <span class="text-muted">Tidak Ada</span>
                                @endif
                            </td>
                            <td>
                                @if($p->is_active)
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-danger">Tidak Aktif</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('perusahaan.edit', $p->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('perusahaan.destroy', $p->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus perusahaan ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#perusahaanTable').DataTable({
            "responsive": true,
            "autoWidth": false,
            "language": {
                "search": "Cari:",
                "lengthMenu": "Tampilkan _MENU_ data per halaman",
                "zeroRecords": "Tidak ada data yang ditemukan",
                "info": "Menampilkan _PAGE_ dari _PAGES_ halaman",
                "infoEmpty": "Tidak ada data tersedia",
                "infoFiltered": "(disaring dari _MAX_ total data)"
            },
            "order": [[ 0, "desc" ]],
            "initComplete": function(settings, json) {
                // Pindahkan tombol Tambah ke sebelah kanan komponen pencarian
                $('#btnTambahPerusahaan').appendTo('.dataTables_filter');
            }
        });
    });
</script>
@endsection
