@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Post</h1>
        <form action="{{ route('posts.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" value="{{ old('title') }}" required>
                @error('title') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="content">Content</label>
                <textarea class="form-control" name="content" required>{{ old('content') }}</textarea>
                @error('content') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="category_id">Category</label>
                <select class="form-control" name="category_id" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="published_at">Publish Date</label>
                <input type="datetime-local" class="form-control" name="published_at" value="{{ old('published_at') }}">
            </div>

            <button type="submit" class="btn btn-primary">Create Post</button>
        </form>
    </div>
@endsection
