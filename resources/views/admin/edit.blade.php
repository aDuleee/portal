{{-- edit.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Post</h1>

        <form action="{{ route('posts.update', $post->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Title --}}
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}" required>
            </div>

            {{-- Content --}}
            <div class="form-group">
                <label for="content">Content</label>
                <textarea class="form-control" id="content" name="content" rows="5" required>{{ $post->content }}</textarea>
            </div>

            {{-- Category --}}
            <div class="form-group">
                <label for="category_id">Category</label>
                <select class="form-control" id="category_id" name="category_id" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $post->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Published At --}}
            <div class="form-group">
                <label for="published_at">Publish Date</label>
                <input type="datetime-local" class="form-control" id="published_at" name="published_at" value="{{ $post->published_at ? $post->published_at->format('Y-m-d\TH:i') : '' }}">
            </div>

            {{-- Submit Button --}}
            <button type="submit" class="btn btn-primary">Update Post</button>
        </form>
    </div>
@endsection
