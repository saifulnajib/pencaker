@extends('layouts.admin')

@section('content')
<div class="mt-4">
    <div class="card">
        <div class="card-header bg-primary bg-opacity-10 text-dark">
            <h4 class="mb-0">Edit Kelurahan</h4>
        </div>
        <div class="card-body bg-white">
            <form action="{{ route('admin.kelurahan.update', $kelurahan->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="id_kecamatan" class="form-label">Pilih Kecamatan</label>
                    <select name="id_kecamatan" id="id_kecamatan" class="form-control @error('id_kecamatan') is-invalid @enderror">
                        <option value="">-- Pilih Kecamatan --</option>
                        @foreach ($kecamatans as $kecamatan)
                            <option value="{{ $kecamatan->id }}" 
                                {{ $kelurahan->id_kecamatan == $kecamatan->id ? 'selected' : '' }}>
                                {{ $kecamatan->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_kecamatan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Nama Kelurahan</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ $kelurahan->name }}" required autofocus>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="is_active" class="form-label">Status</label>
                    <select name="is_active" id="is_active" class="form-control @error('is_active') is-invalid @enderror">
                        <option value="1" {{ $kelurahan->is_active ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ !$kelurahan->is_active ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                    @error('is_active')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.kelurahan.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save me-1"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
