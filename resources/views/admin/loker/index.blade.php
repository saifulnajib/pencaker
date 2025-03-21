@extends('layouts.admin')

@section('title', 'Data Loker')

@section('content')
<div class="mt-4">
    <div class="card">
        <div class="card-header bg-primary bg-opacity-10 text-dark">
            <h4 class="mb-0">Daftar Loker</h4>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <a href="{{ route('loker.create') }}" class="btn-tambah" id="btnTambahLoker">Tambah Data</a>
                <table id="lokerTable" class="table table-striped table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Perusahaan</th>
                            <th>Posisi</th>
                            <th>Deskripsi</th>
                            <th>Kualifikasi</th>
                            <th>Lokasi</th>
                            <th>Gaji</th>
                            <th>Gambar</th>
                            <th>Expired</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lokers as $loker)
                        <tr>
                            <td>{{ $loker->id }}</td>
                            <td>{{ $loker->perusahaan->name ?? 'Perusahaan Tidak Ditemukan' }}</td>
                            <td>{{ $loker->posisi }}</td>
                            <td>{{ $loker->deskripsi }}</td>
                            <td>{{ $loker->kualifikasi }}</td>
                            <td>{{ $loker->lokasi }}</td>
                            <td>Rp. {{ number_format($loker->gaji, 0, ',', '.') }}</td>
                            <td>
                                @if($loker->gambar)
                                    <img src="{{ asset('storage/' . $loker->gambar) }}" 
                                         alt="Gambar Loker" width="50" 
                                         style="cursor: pointer;"
                                         data-bs-toggle="modal"
                                         data-bs-target="#imageModal"
                                         onclick="showImageModal('{{ asset('storage/' . $loker->gambar) }}')">
                                @else
                                    <span class="text-muted">Tidak ada gambar</span>
                                @endif
                            </td>
                            <td>{{ $loker->expired }}</td>
                            <td>
                                <a href="{{ route('loker.edit', $loker->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('loker.destroy', $loker->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
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

<!-- Modal Preview Gambar -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Preview Gambar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" class="img-fluid rounded" 
                     style="max-width: 90%; max-height: 80vh; object-fit: contain;" alt="Preview">
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#lokerTable').DataTable({
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
                $('#btnTambahLoker').appendTo('.dataTables_filter');
            }
        });
    });

    // Fungsi untuk menampilkan modal preview gambar
    function showImageModal(imageSrc) {
        document.getElementById('modalImage').src = imageSrc;
    }
</script>
@endsection
