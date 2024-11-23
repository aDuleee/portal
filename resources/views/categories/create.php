@extends('layouts.app')

@section('content')
<h1>Tambah Kategori</h1>
<form action="{{ route('categories.store') }}" method="POST">
    @csrf
    <label for="name">Nama Kategori:</label>
    <input type="text" name="name" id="name" required>
    <button type="submit">Simpan</button>
</form>
@endsection
