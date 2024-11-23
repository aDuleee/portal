@extends('layouts.app')

@section('content')
<h1>Edit Kategori</h1>
<form action="{{ route('categories.update', $category) }}" method="POST">
    @csrf
    @method('PUT')
    <label for="name">Nama Kategori:</label>
    <input type="text" name="name" id="name" value="{{ $category->name }}" required>
    <button type="submit">Update</button>
</form>
@endsection
