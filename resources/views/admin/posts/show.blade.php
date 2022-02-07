@extends('layouts.admin')

@section('title')
    | Post - {{ $post->title }}
@endsection

@section('content')
    <div class="container">

        <h1>{{ $post->title }}</h1>

        @if ($post->category)
            <h4>Categoria: {{ $post->category->name }}</h4>
        @endif

        <p>{{ $post->content }}</p>

        <a href="{{ route('admin.posts.index') }}">Back Lista Post</a>

    </div>
@endsection
