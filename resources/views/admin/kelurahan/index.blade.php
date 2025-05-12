@extends('layouts.admin')

@section('content')
<div class="mt-4">
    <div class="card">
        <div class="card-header bg-primary bg-opacity-10 text-dark">
            <h4 class="mb-0">Daftar Kelurahan</h4>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <a href="{{ route('admin.kelurahan.create') }}" class="btn-tambah" id="btnTambahKelurahan">Tambah Kelurahan</a>
                <table id="kelurahanTable" class="table table-striped table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Kecamatan</th>
                            <th>Nama Kelurahan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kelurahans as $kelurahan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $kelurahan->kecamatan->name ?? '-' }}</td>
                            <td>{{ $kelurahan->name }}</td>
                            <td>
                                @if($kelurahan->is_active)
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-danger">Tidak Aktif</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.kelurahan.edit', $kelurahan->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('admin.kelurahan.destroy', $kelurahan->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $kelurahans->links() }}
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#kelurahanTable').DataTable({
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
            "paging": false, // Menonaktifkan paginasi DataTable karena sudah menggunakan Laravel pagination
            "initComplete": function(settings, json) {
                // Pindahkan tombol Tambah ke sebelah kanan komponen pencarian
                $('#btnTambahKelurahan').appendTo('.dataTables_filter');
            }
        });
    });
</script>
@endsection
