@extends('layouts.admin')

@section('title', 'Edit Loker')

@section('content')
<div class="mt-4">
    <div class="card">
        <div class="card-header bg-primary bg-opacity-10 text-dark">
            <h4 class="mb-0">Edit Loker</h4>
        </div>
        <div class="card-body bg-white">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('loker.update', $loker->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="perusahaan" class="form-label">Perusahaan</label>
                    <select name="id_perusahaan" id="perusahaan" class="form-control @error('id_perusahaan') is-invalid @enderror" required>
                        <option value="">Pilih Perusahaan</option>
                        @foreach($perusahaan as $p)
                            <option value="{{ $p->id }}" {{ $loker->id_perusahaan == $p->id ? 'selected' : '' }}>
                                {{ $p->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_perusahaan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="posisi" class="form-label">Posisi</label>
                    <input type="text" name="posisi" id="posisi" class="form-control @error('posisi') is-invalid @enderror" value="{{ old('posisi', $loker->posisi) }}" required>
                    @error('posisi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="3" required>{{ old('deskripsi', $loker->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="kualifikasi" class="form-label">Kualifikasi</label>
                    <textarea name="kualifikasi" id="kualifikasi" class="form-control @error('kualifikasi') is-invalid @enderror" rows="3" required>{{ old('kualifikasi', $loker->kualifikasi) }}</textarea>
                    @error('kualifikasi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="lokasi" class="form-label">Lokasi</label>
                    <input type="text" name="lokasi" id="lokasi" class="form-control @error('lokasi') is-invalid @enderror" value="{{ old('lokasi', $loker->lokasi) }}" required>
                    @error('lokasi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="gaji" class="form-label">Gaji</label>
                    <input type="number" name="gaji" id="gaji" class="form-control @error('gaji') is-invalid @enderror" value="{{ old('gaji', $loker->gaji) }}" required>
                    @error('gaji')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="gambar" class="form-label">Gambar (Opsional)</label>
                    <input type="file" name="gambar" id="gambar" class="form-control @error('gambar') is-invalid @enderror" accept="image/*">
                    @if($loker->gambar)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $loker->gambar) }}" alt="Gambar Loker" class="img-thumbnail" style="max-height: 100px;">
                            <p class="small text-muted">Gambar saat ini. Unggah untuk mengubah.</p>
                        </div>
                    @endif
                    @error('gambar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="expired" class="form-label">Expired</label>
                    <input type="date" name="expired" id="expired" class="form-control @error('expired') is-invalid @enderror" value="{{ old('expired', \Carbon\Carbon::parse($loker->expired)->format('Y-m-d')) }}" required>
                    @error('expired')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('loker.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save me-1"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
