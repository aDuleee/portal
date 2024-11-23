@extends('layouts.app')

@section('content')
<h1>Kategori</h1>
<a href="{{ route('categories.create') }}">Tambah Kategori</a>
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
<ul>
    @foreach($categories as $category)
        <li>{{ $category->name }}
            <a href="{{ route('categories.edit', $category) }}">Edit</a>
            <form action="{{ route('categories.destroy', $category) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit">Hapus</button>
            </form>
        </li>
    @endforeach
</ul>
@endsection
