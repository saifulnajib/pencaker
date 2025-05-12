@extends('layouts.admin')

@section('content')
<div class="mt-4">
    <div class="card">
        <div class="card-header bg-primary bg-opacity-10 text-dark">
            <h4 class="mb-0">Tambah Status Perkawinan</h4>
        </div>
        <div class="card-body bg-white">
            <form action="{{ route('admin.status_perkawinan.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Status</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" required autofocus>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="is_active" class="form-label">Status Aktif</label>
                    <select name="is_active" id="is_active" class="form-control @error('is_active') is-invalid @enderror">
                        <option value="1">Aktif</option>
                        <option value="0">Tidak Aktif</option>
                    </select>
                    @error('is_active')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.status_perkawinan.index') }}" class="btn btn-secondary">
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
