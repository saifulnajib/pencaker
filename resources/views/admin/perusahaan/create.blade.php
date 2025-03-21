@extends('layouts.admin')

@section('content')
<div class="mt-4">
    <div class="card">
        <div class="card-header bg-primary bg-opacity-10 text-dark">
            <h4 class="mb-0">Tambah Perusahaan</h4>
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

            <form action="{{ route('perusahaan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Perusahaan</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                        id="name" name="name" value="{{ old('name') }}" required autofocus>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                        id="email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="telp" class="form-label">Telepon</label>
                    <input type="text" class="form-control @error('telp') is-invalid @enderror" 
                        id="telp" name="telp" value="{{ old('telp') }}" required>
                    @error('telp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="logo" class="form-label">Logo Perusahaan</label>
                    <input type="file" class="form-control @error('logo') is-invalid @enderror" 
                        id="logo" name="logo" accept="image/*">
                    <small class="text-muted">Format: JPG, PNG, GIF. Maks: 2MB</small>
                    @error('logo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control @error('alamat') is-invalid @enderror" 
                        id="alamat" name="alamat" rows="3" required>{{ old('alamat') }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="is_active" class="form-label">Status</label>
                    <div class="d-flex align-items-center">
                        <button type="button" class="btn btn-success" id="toggleStatus">
                            <i class="fas fa-check-circle me-1"></i> Aktif
                        </button>
                        <input type="hidden" name="is_active" id="is_active" value="1">
                        <span class="ms-2 text-muted">Klik untuk mengubah status</span>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('perusahaan.index') }}" class="btn btn-secondary">
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

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const toggleButton = document.getElementById("toggleStatus");
        const isActiveInput = document.getElementById("is_active");

        toggleButton.addEventListener("click", function () {
            if (isActiveInput.value == "1") {
                isActiveInput.value = "0";
                toggleButton.classList.remove("btn-success");
                toggleButton.classList.add("btn-danger");
                toggleButton.innerHTML = '<i class="fas fa-times-circle me-1"></i> Tidak Aktif';
            } else {
                isActiveInput.value = "1";
                toggleButton.classList.remove("btn-danger");
                toggleButton.classList.add("btn-success");
                toggleButton.innerHTML = '<i class="fas fa-check-circle me-1"></i> Aktif';
            }
        });
    });
</script>
@endsection
