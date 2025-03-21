@extends('layouts.admin')

@section('content')
<div class="mt-4">
    <div class="card">
        <div class="card-header bg-primary bg-opacity-10 text-dark">
            <h4 class="mb-0">Tambah Permohonan AK1</h4>
        </div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.ak1.store') }}" method="POST" enctype="multipart/form-data" id="formPermohonanAK1" novalidate>
                @csrf

                <!-- Tab Navigation -->
                <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active position-relative" id="data-pribadi-tab" data-bs-toggle="tab" data-bs-target="#data-pribadi" type="button" role="tab" aria-controls="data-pribadi" aria-selected="true">
                            Data Pribadi
                            <span class="error-counter position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger d-none">0</span>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link position-relative" id="pendidikan-tab" data-bs-toggle="tab" data-bs-target="#pendidikan" type="button" role="tab" aria-controls="pendidikan" aria-selected="false">
                            Pendidikan
                            <span class="error-counter position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger d-none">0</span>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link position-relative disabled" id="minat-tab" data-bs-toggle="tab" data-bs-target="#minat" type="button" role="tab" aria-controls="minat" aria-selected="false">
                            Minat Kerja
                            <span class="error-counter position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger d-none">0</span>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link position-relative disabled" id="dokumen-tab" data-bs-toggle="tab" data-bs-target="#dokumen" type="button" role="tab" aria-controls="dokumen" aria-selected="false">
                            Dokumen
                            <span class="error-counter position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger d-none">0</span>
                        </button>
                    </li>
                </ul>
                
                <!-- Tab Content -->
                <div class="tab-content" id="myTabContent">
                    <!-- Data Pribadi -->
                    <div class="tab-pane fade show active" id="data-pribadi" role="tabpanel" aria-labelledby="data-pribadi-tab">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}" required autofocus>
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="invalid-feedback">Nama harus diisi</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="invalid-feedback">Email harus diisi dengan format yang benar</div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nik" class="form-label">NIK</label>
                                    <input type="text" class="form-control @error('nik') is-invalid @enderror" id="nik" name="nik" value="{{ old('nik') }}" required maxlength="16">
                                    <small class="text-muted">NIK harus berisi 16 digit angka</small>
                                    @error('nik')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="invalid-feedback">NIK harus berisi 16 digit angka</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="no_hp" class="form-label">No HP</label>
                                    <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" name="no_hp" value="{{ old('no_hp') }}" required>
                                    @error('no_hp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="invalid-feedback">Nomor HP harus diisi</div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="mb-3">
                                    <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                    <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}" required>
                                    @error('tempat_lahir')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="mb-3">
                                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
                                    @error('tanggal_lahir')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="mb-3">
                                    <label for="gender" class="form-label">Jenis Kelamin</label>
                                    <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender" required>
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="Laki-laki" {{ old('gender') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="Perempuan" {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    @error('gender')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="mb-3">
                                    <label for="tinggi_badan" class="form-label">Tinggi Badan (cm)</label>
                                    <input type="number" class="form-control @error('tinggi_badan') is-invalid @enderror" id="tinggi_badan" name="tinggi_badan" value="{{ old('tinggi_badan') }}" required>
                                    @error('tinggi_badan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="mb-3">
                                    <label for="berat_badan" class="form-label">Berat Badan (kg)</label>
                                    <input type="number" class="form-control @error('berat_badan') is-invalid @enderror" id="berat_badan" name="berat_badan" value="{{ old('berat_badan') }}" required>
                                    @error('berat_badan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="mb-3">
                                    <label for="id_disabilitas" class="form-label">Disabilitas</label>
                                    <select class="form-select @error('id_disabilitas') is-invalid @enderror" id="id_disabilitas" name="id_disabilitas">
                                        <option value="">Pilih Disabilitas</option>
                                        @foreach($disabilitas as $item)
                                            <option value="{{ $item->id }}" {{ old('id_disabilitas') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_disabilitas')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="id_agama" class="form-label">Agama</label>
                                    <select class="form-select @error('id_agama') is-invalid @enderror" id="id_agama" name="id_agama" required>
                                        <option value="">Pilih Agama</option>
                                        @foreach($agama as $item)
                                            <option value="{{ $item->id }}" {{ old('id_agama') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_agama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="id_status_perkawinan" class="form-label">Status Perkawinan</label>
                                    <select class="form-select @error('id_status_perkawinan') is-invalid @enderror" id="id_status_perkawinan" name="id_status_perkawinan" required>
                                        <option value="">Pilih Status</option>
                                        @foreach($status_perkawinan as $item)
                                            <option value="{{ $item->id }}" {{ old('id_status_perkawinan') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_status_perkawinan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="jumlah_anak" class="form-label">Jumlah Anak</label>
                                    <input type="number" class="form-control @error('jumlah_anak') is-invalid @enderror" id="jumlah_anak" name="jumlah_anak" value="{{ old('jumlah_anak', 0) }}">
                                    @error('jumlah_anak')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="kendaraan" class="form-label">Kepemilikan Kendaraan</label>
                                    <select class="form-select @error('kendaraan') is-invalid @enderror" id="kendaraan" name="kendaraan">
                                        <option value="">Pilih Kepemilikan Kendaraan</option>
                                        <option value="Tidak Punya" {{ old('kendaraan') == 'Tidak Punya' ? 'selected' : '' }}>Tidak Punya</option>
                                        <option value="Roda 2" {{ old('kendaraan') == 'Roda 2' ? 'selected' : '' }}>Roda 2</option>
                                        <option value="Roda 4" {{ old('kendaraan') == 'Roda 4' ? 'selected' : '' }}>Roda 4</option>
                                    </select>
                                    @error('kendaraan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3">{{ old('alamat') }}</textarea>
                                    @error('alamat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="rt" class="form-label">RT</label>
                                    <input type="text" class="form-control @error('rt') is-invalid @enderror" id="rt" name="rt" value="{{ old('rt') }}" required>
                                    @error('rt')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="rw" class="form-label">RW</label>
                                    <input type="text" class="form-control @error('rw') is-invalid @enderror" id="rw" name="rw" value="{{ old('rw') }}" required>
                                    @error('rw')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="id_kelurahan" class="form-label">Kelurahan</label>
                                    <select class="form-select @error('id_kelurahan') is-invalid @enderror" id="id_kelurahan" name="id_kelurahan" required>
                                        <option value="">Pilih Kelurahan</option>
                                        @foreach($kelurahan as $item)
                                            <option value="{{ $item->id }}" {{ old('id_kelurahan') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_kelurahan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="kode_pos" class="form-label">Kode Pos</label>
                                    <input type="text" class="form-control @error('kode_pos') is-invalid @enderror" id="kode_pos" name="kode_pos" value="{{ old('kode_pos') }}" required>
                                    @error('kode_pos')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="tempat_tinggal" class="form-label">Tempat Tinggal</label>
                                    <select class="form-select @error('tempat_tinggal') is-invalid @enderror" id="tempat_tinggal" name="tempat_tinggal" required>
                                        <option value="">Pilih Tempat Tinggal</option>
                                        <option value="Sewa" {{ old('tempat_tinggal') == 'Sewa' ? 'selected' : '' }}>Sewa</option>
                                        <option value="Milik Sendiri" {{ old('tempat_tinggal') == 'Milik Sendiri' ? 'selected' : '' }}>Milik Sendiri</option>
                                        <option value="Menumpang Dengan Keluarga" {{ old('tempat_tinggal') == 'Menumpang Dengan Keluarga' ? 'selected' : '' }}>Menumpang Dengan Keluarga</option>
                                    </select>
                                    @error('tempat_tinggal')   
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Pendidikan -->
                    <div class="tab-pane fade" id="pendidikan" role="tabpanel" aria-labelledby="pendidikan-tab">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="id_tingkat_pendidikan" class="form-label">Tingkat Pendidikan</label>
                                    <select class="form-select @error('id_tingkat_pendidikan') is-invalid @enderror" id="id_tingkat_pendidikan" name="id_tingkat_pendidikan" required>
                                        <option value="">Pilih Tingkat Pendidikan</option>
                                        @foreach($tingkat_pendidikan as $item)
                                            <option value="{{ $item->id }}" {{ old('id_tingkat_pendidikan') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_tingkat_pendidikan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="institusi_pendidikan" class="form-label">Institusi Pendidikan</label>
                                    <input type="text" class="form-control @error('institusi_pendidikan') is-invalid @enderror" id="institusi_pendidikan" name="institusi_pendidikan" value="{{ old('institusi_pendidikan') }}" required>
                                    @error('institusi_pendidikan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="jurusan" class="form-label">Jurusan</label>
                                    <input type="text" class="form-control @error('jurusan') is-invalid @enderror" id="jurusan" name="jurusan" value="{{ old('jurusan') }}" required>
                                    @error('jurusan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="tahun_lulus" class="form-label">Tahun Lulus</label>
                                    <input type="number" class="form-control @error('tahun_lulus') is-invalid @enderror" id="tahun_lulus" name="tahun_lulus" value="{{ old('tahun_lulus') }}" required>
                                    @error('tahun_lulus')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="nilai" class="form-label">Nilai (IPK/Rata-rata)</label>
                                    <input type="text" class="form-control @error('nilai') is-invalid @enderror" id="nilai" name="nilai" value="{{ old('nilai') }}" required>
                                    @error('nilai')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Minat Kerja -->
                    <div class="tab-pane fade" id="minat" role="tabpanel" aria-labelledby="minat-tab">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="id_kelompok_jabatan" class="form-label">Kelompok Jabatan</label>
                                    <select class="form-select @error('id_kelompok_jabatan') is-invalid @enderror" id="id_kelompok_jabatan" name="id_kelompok_jabatan" required>
                                        <option value="">Pilih Kelompok Jabatan</option>
                                        @foreach($kelompok_jabatan as $item)
                                            <option value="{{ $item->id }}" {{ old('id_kelompok_jabatan') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_kelompok_jabatan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="id_sektor_usaha" class="form-label">Sektor Usaha</label>
                                    <select class="form-select @error('id_sektor_usaha') is-invalid @enderror" id="id_sektor_usaha" name="id_sektor_usaha" required>
                                        <option value="">Pilih Sektor Usaha</option>
                                        @foreach($sektor_usaha as $item)
                                            <option value="{{ $item->id }}" {{ old('id_sektor_usaha') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_sektor_usaha')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="jabatan_minat" class="form-label">Jabatan yang Diminati</label>
                                    <input type="text" class="form-control @error('jabatan_minat') is-invalid @enderror" id="jabatan_minat" name="jabatan_minat" value="{{ old('jabatan_minat') }}" required>
                                    @error('jabatan_minat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="lokasi_kerja" class="form-label">Lokasi Kerja yang Diinginkan</label>
                                    {{-- <input type="text" class="form-control @error('lokasi_kerja') is-invalid @enderror" id="lokasi_kerja" name="lokasi_kerja" value="{{ old('lokasi_kerja') }}" required> --}}
                                    <select name="lokasi_kerja" id="lokasi_kerja" class="form-select @error('lokasi_kerja') is-invalid @enderror">
                                        <option value="">Pilih Lokasi Kerja</option>
                                        <option value="Dalam Negeri">Dalam Negeri</option>
                                        <option value="Luar Negeri">Luar Negeri</option>
                                    </select>
                                    @error('lokasi_kerja')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="kota_negara_minat" class="form-label">Kota/Negara Minat</label>
                                    <input type="text" class="form-control @error('kota_negara_minat') is-invalid @enderror" id="kota_negara_minat" name="kota_negara_minat" value="{{ old('kota_negara_minat') }}">
                                    @error('kota_negara_minat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="id_besaran_upah" class="form-label">Besaran Upah</label>
                                    <select class="form-select @error('id_besaran_upah') is-invalid @enderror" id="id_besaran_upah" name="id_besaran_upah" required>
                                        <option value="">Pilih Besaran Upah</option>
                                        @foreach($besaran_upah as $item)
                                            <option value="{{ $item->id }}" {{ old('id_besaran_upah') == $item->id ? 'selected' : '' }}> Rp {{ number_format($item->min, 0, ',', '.') }} - Rp {{ number_format($item->max, 0, ',', '.') }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_besaran_upah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="is_pernah_bekerja" class="form-label">Pernah Bekerja</label>
                                    <select class="form-select @error('is_pernah_bekerja') is-invalid @enderror" id="is_pernah_bekerja" name="is_pernah_bekerja" required>
                                        <option value="">Pilih Pernah Bekerja</option>
                                        <option value="1" {{ old('is_pernah_bekerja') == '1' ? 'selected' : '' }}>Ya</option>
                                        <option value="0" {{ old('is_pernah_bekerja') == '0' ? 'selected' : '' }}>Tidak</option>
                                    </select>
                                    @error('is_pernah_bekerja')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        

                        <div class="mb-3">
                            <label for="keterangan_singkat_pengalaman" class="form-label">Keterangan Singkat Pengalaman</label>
                            <textarea class="form-control @error('keterangan_singkat_pengalaman') is-invalid @enderror" id="keterangan_singkat_pengalaman" name="keterangan_singkat_pengalaman" rows="3">{{ old('keterangan_singkat_pengalaman') }}</textarea>
                            @error('keterangan_singkat_pengalaman')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Dokumen -->
                    <div class="tab-pane fade" id="dokumen" role="tabpanel" aria-labelledby="dokumen-tab">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="file_foto" class="form-label">Foto (3x4)</label>
                                    <input type="file" class="form-control @error('file_foto') is-invalid @enderror" id="file_foto" name="file_foto" accept="image/*" required>
                                    @error('file_foto')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="file_ktp" class="form-label">Scan KTP</label>
                                    <input type="file" class="form-control @error('file_ktp') is-invalid @enderror" id="file_ktp" name="file_ktp" accept="image/*,.pdf" required>
                                    @error('file_ktp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="file_ijazah" class="form-label">Scan Ijazah</label>
                                    <input type="file" class="form-control @error('file_ijazah') is-invalid @enderror" id="file_ijazah" name="file_ijazah" accept=".pdf" required>
                                    @error('file_ijazah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="file_transkrip" class="form-label">Scan Transkrip Nilai</label>
                                    <input type="file" class="form-control @error('file_transkrip') is-invalid @enderror" id="file_transkrip" name="file_transkrip" accept=".pdf" required>
                                    @error('file_transkrip')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="file_ak1" class="form-label">Scan Kartu AK1 (Jika Ada)</label>
                                    <input type="file" class="form-control @error('file_ak1') is-invalid @enderror" id="file_ak1" name="file_ak1" accept=".pdf">
                                    @error('file_ak1')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="is_active" class="form-label">Status</label>
                                    <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" checked>
                                    @error('is_active')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <!-- <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="is_verified" class="form-label">Verifikasi</label>
                                    <input type="checkbox" class="form-check-input" id="is_verified" name="is_verified" value="1">
                                    @error('is_verified')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('ak1.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                    <div>
                        <button type="button" id="prevTab" class="btn btn-info d-none">
                            <i class="fas fa-chevron-left me-1"></i> Sebelumnya
                        </button>
                        <button type="button" id="nextTab" class="btn btn-info">
                            Selanjutnya <i class="fas fa-chevron-right ms-1"></i>
                        </button>
                        <button type="submit" id="submitForm" class="btn btn-success d-none">
                            <i class="fas fa-save me-1"></i> Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Definisi variabel global
        let currentTab = 0;
        const tabIDs = ['data-pribadi', 'pendidikan', 'minat', 'dokumen'];
        const tabButtons = tabIDs.map(id => $(`#${id}-tab`));
        const tabs = tabIDs.map(id => $(`#${id}`));
        
        // Memastikan tab navigation berfungsi dengan validasi
        $('#myTab button[data-bs-toggle="tab"]').on('click', function (e) {
            e.preventDefault();
            
            const clickedTabIndex = tabButtons.findIndex(btn => btn[0] === this);
            
            if ($(this).hasClass('disabled')) {
                return false;
            }
            
            // Validasi tab saat ini sebelum pindah
            if (clickedTabIndex > currentTab) {
                // Mencoba pindah ke tab setelahnya, perlu validasi
                if (!validateTab(currentTab)) {
                    return false;
                }
                
                // Kalau pindahnya lebih dari 1 tab ke depan, tidak diizinkan
                if (clickedTabIndex > currentTab + 1) {
                    switchToTab(currentTab + 1);
                    return false;
                }
            }
            
            switchToTab(clickedTabIndex);
        });
        
        // Mengelola perpindahan tab dengan tombol Sebelumnya/Selanjutnya
        $('#nextTab').on('click', function() {
            if (validateTab(currentTab)) {
                if (currentTab < tabIDs.length - 1) {
                    switchToTab(currentTab + 1);
                }
            }
        });
        
        $('#prevTab').on('click', function() {
            if (currentTab > 0) {
                switchToTab(currentTab - 1);
            }
        });
        
        // Fungsi untuk beralih ke tab tertentu
        function switchToTab(tabIndex) {
            // Aktifkan tab yang dipilih
            tabButtons[tabIndex].tab('show');
            
            // Perbarui tab yang dinonaktifkan berdasarkan aturan
            updateDisabledTabs(tabIndex);
            
            // Perbarui tombol sebelumnya/selanjutnya
            updateNavButtons(tabIndex);
            
            // Perbarui tab saat ini
            currentTab = tabIndex;
        }
        
        // Perbarui status tombol navigasi (Sebelumnya/Selanjutnya/Simpan)
        function updateNavButtons(tabIndex) {
            // Reset dulu
            $('#prevTab, #nextTab, #submitForm').addClass('d-none');
            
            // Tampilkan tombol yang sesuai
            if (tabIndex > 0) {
                $('#prevTab').removeClass('d-none');
            }
            
            if (tabIndex < tabIDs.length - 1) {
                $('#nextTab').removeClass('d-none');
            } else {
                $('#submitForm').removeClass('d-none');
            }
        }
        
        // Mengelola tab yang dinonaktifkan
        function updateDisabledTabs(currentTabIndex) {
            tabButtons.forEach((btn, index) => {
                if (index <= currentTabIndex + 1 && index <= tabIDs.length - 1) {
                    btn.removeClass('disabled');
                } else {
                    btn.addClass('disabled');
                }
            });
        }
        
        // Validasi tab berdasarkan indeks
        function validateTab(tabIndex) {
            let isValid = true;
            const currentTabElement = tabs[tabIndex];
            
            // Validasi semua input required di tab ini
            currentTabElement.find('input[required], select[required], textarea[required]').each(function() {
                // Reset validasi visual
                $(this).removeClass('is-invalid');
                
                // Cek apakah kosong
                if ($(this).val() === '' || $(this).val() === null) {
                    $(this).addClass('is-invalid');
                    isValid = false;
                }
                
                // Validasi khusus berdasarkan tipe
                if ($(this).attr('id') === 'nik') {
                    const nikValue = $(this).val();
                    if (nikValue.length !== 16 || !/^\d+$/.test(nikValue)) {
                        $(this).addClass('is-invalid');
                        isValid = false;
                    }
                }
                
                if ($(this).attr('type') === 'email') {
                    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
                    if ($(this).val() && !emailPattern.test($(this).val())) {
                        $(this).addClass('is-invalid');
                        isValid = false;
                    }
                }
            });
            
            // Hitung dan tampilkan error
            countErrorsInTabs();
            
            // Scroll ke error pertama jika ada
            if (!isValid) {
                const firstError = currentTabElement.find('.is-invalid').first();
                if (firstError.length) {
                    $('html, body').animate({
                        scrollTop: firstError.offset().top - 100
                    }, 200);
                }
            }
            
            return isValid;
        }
        
        // Fungsi untuk validasi input universal
        function setupInputValidation() {
            // Validasi NIK - hanya angka dan max 16 digit
            $('#nik').on('input', function() {
                // Hapus semua karakter non-digit
                let value = $(this).val().replace(/\D/g, '');
                
                // Batasi maksimum 16 karakter
                if (value.length > 16) {
                    value = value.substring(0, 16);
                }
                
                // Set nilai yang sudah difilter
                $(this).val(value);
                
                // Validasi panjang NIK
                if (value.length !== 16) {
                    $(this).addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid');
                }
                
                countErrorsInTabs();
            });
            
            // Tambahkan validasi untuk input number lainnya agar hanya angka
            $('input[type="number"]').on('input', function() {
                let value = $(this).val().replace(/\D/g, '');
                $(this).val(value);
            });
            
            // Validasi universal untuk required fields
            $('input[required], select[required], textarea[required]').on('change input blur', function() {
                if ($(this).val() === '' || $(this).val() === null) {
                    $(this).addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid');
                }
                countErrorsInTabs();
            });
            
            // Validasi khusus untuk email
            $('#email').on('input blur', function() {
                const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
                const email = $(this).val();
                
                if (email && !emailPattern.test(email)) {
                    $(this).addClass('is-invalid');
                } else if (email) {
                    $(this).removeClass('is-invalid');
                }
                
                countErrorsInTabs();
            });
        }
        
        // Fungsi untuk menghitung error di setiap tab
        function countErrorsInTabs() {
            // Reset semua counter
            $('.error-counter').text('0').addClass('d-none');
            
            // Hitung error di setiap tab
            tabs.forEach((tabPane, index) => {
                const invalidInputs = tabPane.find('.is-invalid').length;
                const counter = tabButtons[index].find('.error-counter');
                
                if (invalidInputs > 0) {
                    counter.text(invalidInputs).removeClass('d-none');
                } else {
                    counter.text('0').addClass('d-none');
                }
            });
        }
        
        // Form submission handler
        $('#formPermohonanAK1').on('submit', function(e) {
            e.preventDefault();
            
            // Validasi semua tab sebelum submit
            let allValid = true;
            let firstInvalidTabIndex = -1;
            
            for (let i = 0; i < tabIDs.length; i++) {
                if (!validateTab(i)) {
                    allValid = false;
                    if (firstInvalidTabIndex === -1) {
                        firstInvalidTabIndex = i;
                    }
                }
            }
            
            if (allValid) {
                // Jika semua valid, lanjutkan submit
                this.submit();
            } else {
                // Jika ada tab yang tidak valid, pindah ke tab pertama yang tidak valid
                if (firstInvalidTabIndex !== -1) {
                    switchToTab(firstInvalidTabIndex);
                }
            }
        });
        
        // Inisialisasi
        setupInputValidation();
        updateDisabledTabs(currentTab);
        updateNavButtons(currentTab);
        
        // Panggil fungsi saat halaman dimuat jika ada error
        @if($errors->any())
            countErrorsInTabs();
            
            // Validasi semua tab untuk menandai error
            for (let i = 0; i < tabIDs.length; i++) {
                validateTab(i);
            }
            
            // Aktifkan tab pertama yang memiliki error
            const firstErrorTab = $('.tab-pane:has(.is-invalid)').first().attr('id');
            if (firstErrorTab) {
                const tabIndex = tabIDs.indexOf(firstErrorTab);
                if (tabIndex !== -1) {
                    switchToTab(tabIndex);
                }
            }
        @endif
    });
</script>
@endsection
