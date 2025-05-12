@extends('layouts.admin')

@section('content')
<div class="mt-4">
    <div class="card">
        <div class="card-header bg-primary bg-opacity-10 text-dark d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Detail Permohonan AK1</h4>
            <div>
                <!-- @if($ak1->is_active)
                    <span class="badge bg-success">Aktif</span>
                @else
                    <span class="badge bg-danger">Tidak Aktif</span>
                @endif -->
                
                @if($ak1->is_verified)
                    <span class="badge bg-success ms-2">Terverifikasi</span>
                @else
                    <span class="badge bg-warning ms-2">Belum Diverifikasi</span>
                @endif
            </div>
        </div>
        
        <style>
            .pdf-preview {
                border: 1px solid #dee2e6;
                border-radius: 6px;
                overflow: hidden;
                box-shadow: 0 0 10px rgba(0,0,0,0.1);
                height: 400px;
                width: 100%;
                position: relative;
            }
            
            .pdf-preview iframe {
                width: 100%;
                height: 100%;
                border: none;
            }
            
            .pdf-actions {
                display: flex;
                gap: 8px;
                margin-top: 10px;
                justify-content: center;
            }
            
            .card-body .btn-sm {
                padding: 0.25rem 0.5rem;
                font-size: 0.875rem;
            }
            
            .gap-2 {
                gap: 0.5rem !important;
            }
            
            .d-flex {
                display: flex !important;
            }
            
            .image-preview {
                position: relative;
                overflow: hidden;
                transition: all 0.3s ease;
            }
            
            .image-preview img {
                transition: transform 0.3s ease;
                box-shadow: 0 0 10px rgba(0,0,0,0.1);
            }
            
            .image-preview:hover img {
                transform: scale(1.03);
            }
            
            .img-thumbnail {
                padding: 0.25rem;
                background-color: #fff;
                border: 1px solid #dee2e6;
                border-radius: 0.375rem;
                max-width: 100%;
                height: auto;
            }
            
            .justify-content-center {
                justify-content: center !important;
            }
            
            /* Tambahan untuk tab content agar lebih menarik */
            .tab-pane {
                padding: 15px 0;
            }
            
            .table-striped > tbody > tr:nth-of-type(odd) > * {
                background-color: rgba(0, 0, 0, 0.02);
            }
            
            .card-header {
                font-weight: bold;
            }
            
            /* Loading indicator */
            .pdf-loading {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                font-size: 14px;
                color: #6c757d;
            }
            
            .pdf-loading i {
                margin-right: 5px;
                animation: spin 1s linear infinite;
            }
            
            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }
        </style>
        
        <div class="card-body">
            <!-- Tab Navigation -->
            <ul class="nav nav-tabs mb-4" id="detailTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="data-pribadi-tab" data-bs-toggle="tab" data-bs-target="#data-pribadi" type="button" role="tab" aria-controls="data-pribadi" aria-selected="true">Data Pribadi</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pendidikan-tab" data-bs-toggle="tab" data-bs-target="#pendidikan" type="button" role="tab" aria-controls="pendidikan" aria-selected="false">Pendidikan</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="minat-tab" data-bs-toggle="tab" data-bs-target="#minat" type="button" role="tab" aria-controls="minat" aria-selected="false">Minat Kerja</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="dokumen-tab" data-bs-toggle="tab" data-bs-target="#dokumen" type="button" role="tab" aria-controls="dokumen" aria-selected="false">Dokumen</button>
                </li>
            </ul>
            
            <!-- Tab Content -->
            <div class="tab-content" id="detailTabContent">
                <!-- Data Pribadi -->
                <div class="tab-pane fade show active" id="data-pribadi" role="tabpanel" aria-labelledby="data-pribadi-tab">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-striped">
                                <tr>
                                    <th width="30%">Nama</th>
                                    <td>{{ $ak1->nama }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $ak1->email }}</td>
                                </tr>
                                <tr>
                                    <th>NIK</th>
                                    <td>{{ $ak1->nik }}</td>
                                </tr>
                                <tr>
                                    <th>No HP</th>
                                    <td>{{ $ak1->no_hp }}</td>
                                </tr>
                                <tr>
                                    <th>Tempat, Tanggal Lahir</th>
                                    <td>{{ $ak1->tempat_lahir }}, {{ \Carbon\Carbon::parse($ak1->tanggal_lahir)->format('d-m-Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Jenis Kelamin</th>
                                    <td>{{ $ak1->gender }}</td>
                                </tr>
                                <tr>
                                    <th>Agama</th>
                                    <td>{{ $ak1->agama->name ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Status Perkawinan</th>
                                    <td>{{ $ak1->statusPerkawinan->name ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-striped">
                                <tr>
                                    <th width="30%">Tinggi Badan</th>
                                    <td>{{ $ak1->tinggi_badan }} cm</td>
                                </tr>
                                <tr>
                                    <th>Berat Badan</th>
                                    <td>{{ $ak1->berat_badan }} kg</td>
                                </tr>
                                <tr>
                                    <th>Jumlah Anak</th>
                                    <td>{{ $ak1->jumlah_anak ?? '0' }}</td>
                                </tr>
                                <tr>
                                    <th>Disabilitas</th>
                                    <td>{{ $ak1->disabilitas->name ?? 'Tidak Ada' }}</td>
                                </tr>
                                <tr>
                                    <th>Kendaraan</th>
                                    <td>{{ $ak1->kendaraan ?? 'Tidak Ada' }}</td>
                                </tr>
                                <tr>
                                    <th>Kelurahan</th>
                                    <td>{{ $ak1->kelurahan->name ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Tempat Tinggal</th>
                                    <td>{{ $ak1->tempat_tinggal }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <h5>Alamat Lengkap</h5>
                            <p>{{ $ak1->alamat }}</p>
                            <p>RT {{ $ak1->rt }} / RW {{ $ak1->rw }}, {{ $ak1->kelurahan->name ?? '' }}, Kode Pos: {{ $ak1->kode_pos }}</p>
                        </div>
                    </div>
                </div>

                <!-- Pendidikan -->
                <div class="tab-pane fade" id="pendidikan" role="tabpanel" aria-labelledby="pendidikan-tab">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-striped">
                                <tr>
                                    <th width="30%">Tingkat Pendidikan</th>
                                    <td>{{ $ak1->tingkatPendidikan->name ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Institusi Pendidikan</th>
                                    <td>{{ $ak1->institusi_pendidikan }}</td>
                                </tr>
                                <tr>
                                    <th>Jurusan</th>
                                    <td>{{ $ak1->jurusan ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Tahun Lulus</th>
                                    <td>{{ $ak1->tahun_lulus }}</td>
                                </tr>
                                <tr>
                                    <th>Nilai (IPK/Rata-rata)</th>
                                    <td>{{ $ak1->nilai ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Minat Kerja -->
                <div class="tab-pane fade" id="minat" role="tabpanel" aria-labelledby="minat-tab">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-striped">
                                <tr>
                                    <th width="30%">Kelompok Jabatan</th>
                                    <td>{{ $ak1->kelompokJabatan->name ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Sektor Usaha</th>
                                    <td>{{ $ak1->sektorUsaha->name ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Jabatan yang Diminati</th>
                                    <td>{{ $ak1->jabatan_minat }}</td>
                                </tr>
                                <tr>
                                    <th>Lokasi Kerja</th>
                                    <td>{{ $ak1->lokasi_kerja }}</td>
                                </tr>
                                <tr>
                                    <th>Kota/Negara Minat</th>
                                    <td>{{ $ak1->kota_negara_minat }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-striped">
                                <tr>
                                    <th width="30%">Besaran Upah</th>
                                    <td>
                                        @if($ak1->besaranUpah)
                                            Rp {{ number_format($ak1->besaranUpah->min, 0, ',', '.') }} - 
                                            Rp {{ number_format($ak1->besaranUpah->max, 0, ',', '.') }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Pernah Bekerja</th>
                                    <td>{{ $ak1->is_pernah_bekerja ? 'Ya' : 'Tidak' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <h5>Keterangan Singkat Pengalaman</h5>
                            <p>{{ $ak1->keterangan_singkat_pengalaman ?? 'Tidak ada keterangan' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Dokumen -->
                <div class="tab-pane fade" id="dokumen" role="tabpanel" aria-labelledby="dokumen-tab">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-header">Foto</div>
                                <div class="card-body">
                                    @if($ak1->file_foto)
                                        <div class="image-preview mb-3 text-center">
                                            <a href="{{ asset('storage/'.$ak1->file_foto) }}" target="_blank" class="img-link">
                                                <img src="{{ asset('storage/'.$ak1->file_foto) }}" alt="Foto {{ $ak1->nama }}" class="img-thumbnail" style="max-height: 250px;">
                                            </a>
                                        </div>
                                        <div class="d-flex gap-2 justify-content-center">
                                            <a href="{{ asset('storage/'.$ak1->file_foto) }}" target="_blank" class="btn btn-sm btn-primary">
                                                <i class="fas fa-search-plus me-1"></i> Lihat Ukuran Penuh
                                            </a>
                                            <a href="{{ asset('storage/'.$ak1->file_foto) }}" download class="btn btn-sm btn-success">
                                                <i class="fas fa-download me-1"></i> Unduh
                                            </a>
                                        </div>
                                    @else
                                        <p class="text-muted">Tidak ada file</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-header">Scan KTP</div>
                                <div class="card-body">
                                    @if($ak1->file_ktp)
                                        @php
                                            $file_extension = pathinfo(asset('storage/'.$ak1->file_ktp), PATHINFO_EXTENSION);
                                            $is_image = in_array(strtolower($file_extension), ['jpg', 'jpeg', 'png', 'gif']);
                                        @endphp
                                        
                                        @if($is_image)
                                            <div class="image-preview mb-3 text-center">
                                                <a href="{{ asset('storage/'.$ak1->file_ktp) }}" target="_blank" class="img-link">
                                                    <img src="{{ asset('storage/'.$ak1->file_ktp) }}" alt="KTP {{ $ak1->nama }}" class="img-thumbnail" style="max-height: 250px;">
                                                </a>
                                            </div>
                                            <div class="d-flex gap-2 justify-content-center">
                                                <a href="{{ asset('storage/'.$ak1->file_ktp) }}" target="_blank" class="btn btn-sm btn-primary">
                                                    <i class="fas fa-search-plus me-1"></i> Lihat Ukuran Penuh
                                                </a>
                                                <a href="{{ asset('storage/'.$ak1->file_ktp) }}" download class="btn btn-sm btn-success">
                                                    <i class="fas fa-download me-1"></i> Unduh
                                                </a>
                                            </div>
                                        @else
                                            <div class="pdf-preview mb-3" id="ktp-preview">
                                                <div class="pdf-loading">
                                                    <i class="fas fa-spinner"></i> Memuat PDF...
                                                </div>
                                            </div>
                                            <div class="pdf-actions">
                                                <a href="{{ asset('storage/'.$ak1->file_ktp) }}" target="_blank" class="btn btn-sm btn-primary">
                                                    <i class="fas fa-eye me-1"></i> Buka di Tab Baru
                                                </a>
                                                <a href="{{ asset('storage/'.$ak1->file_ktp) }}" download class="btn btn-sm btn-success">
                                                    <i class="fas fa-download me-1"></i> Unduh
                                                </a>
                                            </div>
                                        @endif
                                    @else
                                        <p class="text-muted">Tidak ada file</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card mb-3">
                                <div class="card-header">Scan Ijazah</div>
                                <div class="card-body">
                                    @if($ak1->file_ijazah)
                                        <div class="pdf-preview mb-3" id="ijazah-preview">
                                            <div class="pdf-loading">
                                                <i class="fas fa-spinner"></i> Memuat PDF...
                                            </div>
                                        </div>
                                        <div class="pdf-actions">
                                            <a href="{{ asset('storage/'.$ak1->file_ijazah) }}" target="_blank" class="btn btn-sm btn-primary">
                                                <i class="fas fa-eye me-1"></i> Buka di Tab Baru
                                            </a>
                                            <a href="{{ asset('storage/'.$ak1->file_ijazah) }}" download class="btn btn-sm btn-success">
                                                <i class="fas fa-download me-1"></i> Unduh
                                            </a>
                                        </div>
                                    @else
                                        <p class="text-muted">Tidak ada file</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mb-3">
                                <div class="card-header">Scan Transkrip Nilai</div>
                                <div class="card-body">
                                    @if($ak1->file_transkrip)
                                        <div class="pdf-preview mb-3" id="transkrip-preview">
                                            <div class="pdf-loading">
                                                <i class="fas fa-spinner"></i> Memuat PDF...
                                            </div>
                                        </div>
                                        <div class="pdf-actions">
                                            <a href="{{ asset('storage/'.$ak1->file_transkrip) }}" target="_blank" class="btn btn-sm btn-primary">
                                                <i class="fas fa-eye me-1"></i> Buka di Tab Baru
                                            </a>
                                            <a href="{{ asset('storage/'.$ak1->file_transkrip) }}" download class="btn btn-sm btn-success">
                                                <i class="fas fa-download me-1"></i> Unduh
                                            </a>
                                        </div>
                                    @else
                                        <p class="text-muted">Tidak ada file</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mb-3">
                                <div class="card-header">Scan Kartu AK1</div>
                                <div class="card-body">
                                    @if($ak1->file_ak1)
                                        <div class="pdf-preview mb-3" id="ak1-preview">
                                            <div class="pdf-loading">
                                                <i class="fas fa-spinner"></i> Memuat PDF...
                                            </div>
                                        </div>
                                        <div class="pdf-actions">
                                            <a href="{{ asset('storage/'.$ak1->file_ak1) }}" target="_blank" class="btn btn-sm btn-primary">
                                                <i class="fas fa-eye me-1"></i> Buka di Tab Baru
                                            </a>
                                            <a href="{{ asset('storage/'.$ak1->file_ak1) }}" download class="btn btn-sm btn-success">
                                                <i class="fas fa-download me-1"></i> Unduh
                                            </a>
                                        </div>
                                    @else
                                        <p class="text-muted">Tidak ada file</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('ak1.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
                <div>
                    <a href="{{ route('ak1.edit', $ak1->id) }}" class="btn btn-warning">
                        <i class="fas fa-edit me-1"></i> Edit
                    </a>
                    <form action="{{ route('ak1.destroy', $ak1->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash me-1"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- PDF.js Library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.min.js"></script>
<script>
    // Inisialisasi worker PDF.js
    pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.worker.min.js';
    
    $(document).ready(function() {
        // Memastikan tab navigation berfungsi dengan benar
        $('#detailTab button[data-bs-toggle="tab"]').on('click', function (e) {
            e.preventDefault();
            $(this).tab('show');
        });
        
        // Fungsi untuk menampilkan PDF menggunakan PDF.js
        function renderPDF(pdfUrl, containerId) {
            const container = document.getElementById(containerId);
            if (!container) return;
            
            // Tampilkan indikator loading
            container.innerHTML = '<div class="pdf-loading"><i class="fas fa-spinner"></i> Memuat PDF...</div>';
            
            // Coba render dengan PDF.js langsung (tanpa Google Docs Viewer)
            pdfjsLib.getDocument(pdfUrl).promise
                .then(function(pdf) {
                    // Hapus loading indicator
                    container.innerHTML = '';
                    
                    // Render halaman pertama
                    return pdf.getPage(1).then(function(page) {
                        const canvas = document.createElement('canvas');
                        const context = canvas.getContext('2d');
                        
                        // Sesuaikan scale agar sesuai dengan container
                        const containerWidth = container.clientWidth;
                        const viewport = page.getViewport({ scale: 1.0 });
                        const scale = containerWidth / viewport.width;
                        const scaledViewport = page.getViewport({ scale: scale });
                        
                        canvas.height = scaledViewport.height;
                        canvas.width = scaledViewport.width;
                        
                        container.appendChild(canvas);
                        
                        // Render halaman PDF ke canvas
                        return page.render({
                            canvasContext: context,
                            viewport: scaledViewport
                        }).promise;
                    });
                })
                .catch(function(error) {
                    console.error('Error rendering PDF:', error);
                    
                    // Jika PDF.js gagal, tampilkan tombol untuk melihat dan unduh file
                    container.innerHTML = `
                        <div class="text-center py-4">
                            <p class="text-danger mb-3">Tidak dapat menampilkan pratinjau PDF.</p>
                            <p class="mb-3">Dokumen tersedia, tapi browser tidak dapat menampilkan pratinjau.</p>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="${pdfUrl}" target="_blank" class="btn btn-primary">
                                    <i class="fas fa-eye me-1"></i> Buka di Tab Baru
                                </a>
                                <a href="${pdfUrl}" download class="btn btn-success">
                                    <i class="fas fa-download me-1"></i> Unduh
                                </a>
                            </div>
                        </div>
                    `;
                });
        }
        
        // Render PDF saat tab dokumen aktif
        $('#dokumen-tab').on('shown.bs.tab', function() {
            @if($ak1->file_ijazah)
                renderPDF('{{ asset('storage/'.$ak1->file_ijazah) }}', 'ijazah-preview');
            @endif
            
            @if($ak1->file_transkrip)
                renderPDF('{{ asset('storage/'.$ak1->file_transkrip) }}', 'transkrip-preview');
            @endif
            
            @if($ak1->file_ak1)
                renderPDF('{{ asset('storage/'.$ak1->file_ak1) }}', 'ak1-preview');
            @endif
            
            @if($ak1->file_ktp && !in_array(pathinfo(asset('storage/'.$ak1->file_ktp), PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                renderPDF('{{ asset('storage/'.$ak1->file_ktp) }}', 'ktp-preview');
            @endif
        });
        
        // Efek zoom untuk gambar jika diklik
        $('.img-link').on('click', function(e) {
            // Pada perangkat mobile, kita biarkan link bekerja seperti biasa
            if (window.innerWidth > 768) {
                e.preventDefault();
                
                // Ambil URL gambar
                var imageUrl = $(this).attr('href');
                
                // Buat overlay untuk menampilkan gambar
                var overlay = $('<div class="image-overlay"></div>');
                var imageContainer = $('<div class="image-container"></div>');
                var image = $('<img src="' + imageUrl + '" class="zoomed-image">');
                var closeBtn = $('<button class="close-btn">&times;</button>');
                
                // Tambahkan ke body
                imageContainer.append(image);
                overlay.append(imageContainer);
                overlay.append(closeBtn);
                $('body').append(overlay);
                
                // Tambahkan style
                overlay.css({
                    'position': 'fixed',
                    'top': 0,
                    'left': 0,
                    'width': '100%',
                    'height': '100%',
                    'background-color': 'rgba(0,0,0,0.9)',
                    'z-index': 9999,
                    'display': 'flex',
                    'justify-content': 'center',
                    'align-items': 'center'
                });
                
                imageContainer.css({
                    'max-width': '90%',
                    'max-height': '90%',
                    'overflow': 'auto'
                });
                
                image.css({
                    'max-width': '100%',
                    'max-height': '90vh',
                    'display': 'block',
                    'margin': '0 auto'
                });
                
                closeBtn.css({
                    'position': 'absolute',
                    'top': '20px',
                    'right': '20px',
                    'background': 'none',
                    'border': 'none',
                    'color': 'white',
                    'font-size': '30px',
                    'cursor': 'pointer'
                });
                
                // Tutup overlay jika tombol close atau area di luar gambar diklik
                closeBtn.on('click', function() {
                    overlay.remove();
                });
                
                overlay.on('click', function(e) {
                    if (e.target === this) {
                        overlay.remove();
                    }
                });
            }
        });
    });
</script>
@endpush
