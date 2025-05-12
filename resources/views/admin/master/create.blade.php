@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Tambah Data Master</h2>

    <form action="{{ route('master.store') }}" method="POST">
        @csrf
        <label>Nama</label>
        <input type="text" name="nama" required>
        
        <label>Deskripsi</label>
        <textarea name="deskripsi"></textarea>

        <button type="submit">Simpan</button>
    </form>
</div>
@endsection
