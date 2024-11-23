{{-- create.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Post</h1>

        <form action="{{ route('posts.store') }}" method="POST">
            @csrf

            {{-- Title --}}
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
            </div>

            {{-- Content --}}
            <div class="form-group">
                <label for="content">Content</label>
                <textarea class="form-control" id="content" name="content" rows="5" required>{{ old('content') }}</textarea>
            </div>

            {{-- Category --}}
            <div class="form-group">
                <label for="category_id">Category</label>
                <select class="form-control" id="category_id" name="category_id" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Published At --}}
            <div class="form-group">
                <label for="published_at">Publish Date</label>
                <input type="datetime-local" class="form-control" id="published_at" name="published_at" value="{{ old('published_at') }}">
            </div>

            {{-- Submit Button --}}
            <button type="submit" class="btn btn-primary">Create Post</button>
        </form>
    </div>
@endsection
