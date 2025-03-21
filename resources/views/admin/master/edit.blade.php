@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Edit Data Master</h2>

    <form action="{{ route('master.update', $master->id) }}" method="POST">
        @csrf
        <label>Nama</label>
        <input type="text" name="nama" value="{{ $master->nama }}" required>
        
        <label>Deskripsi</label>
        <textarea name="deskripsi">{{ $master->deskripsi }}</textarea>

        <button type="submit">Update</button>
    </form>
</div>
@endsection
