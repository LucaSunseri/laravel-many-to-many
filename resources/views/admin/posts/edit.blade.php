@extends('layouts.admin')

@section('title')
    | Modifica Post - {{ $post->title }}
@endsection

@section('content')
    <div class="container">

        <h1>Modifica "{{ $post->title }}"</h1>

        <form action="{{ route('admin.posts.update', $post) }}" method="post">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Titolo</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                    value="{{ old('title', $post->title) }}" aria-describedby="emailHelp">
                @error('title')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="content">Contenuto</label>
                <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content"
                    rows="3">{{ old('content', $post->content) }}</textarea>
                @error('content')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="category_id">Categoria</label>
                <select class="form-control" name="category_id" id="category_id" aria-label="Default select example">
                    <option value="">Seleziona una Categoria</option>
                    @foreach ($categories as $category)
                        <option @if ($category->id == old('category_id', $post->category_id)) selected @endif value="{{ $category->id }}">{{ $category->name }} </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <p>Seleziona i Tag</p>
                @foreach ($tags as $tag)
                    <div class="custom-control custom-checkbox d-inline-block mr-3">
                        <input type="checkbox" class="custom-control-input" name="tags[]" value="{{ $tag->id }}"
                            id="tag-{{ $tag->id }}" @if (!$errors->any() && $post->tags->contains($tag->id)) checked @elseif ($errors->any() && in_array($tag->id, old('tags', []))) checked @endif>
                        <label class="custom-control-label" for="tag-{{ $tag->id }}">{{ $tag->name }}</label>
                    </div>
                @endforeach
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>


    </div>
@endsection
