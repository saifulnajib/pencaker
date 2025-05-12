@extends('layouts.admin')

@section('content')
<div class="mt-4">
    <div class="card">
        <div class="card-header bg-primary bg-opacity-10 text-dark">
            <h4 class="mb-0">Tambah Besaran Upah</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.besaran_upah.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="min" class="form-label">Minimal Upah</label>
                    <input type="number" name="min" id="min" class="form-control @error('min') is-invalid @enderror" required autofocus>
                    @error('min')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="max" class="form-label">Maksimal Upah</label>
                    <input type="number" name="max" id="max" class="form-control @error('max') is-invalid @enderror" required>
                    @error('max')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="is_active" class="form-label">Status</label>
                    <select name="is_active" id="is_active" class="form-select @error('is_active') is-invalid @enderror">
                        <option value="1">Aktif</option>
                        <option value="0">Tidak Aktif</option>
                    </select>
                    @error('is_active')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.besaran_upah.index') }}" class="btn btn-secondary">
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
