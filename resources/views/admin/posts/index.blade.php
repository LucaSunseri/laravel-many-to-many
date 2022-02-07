@extends('layouts.admin')

@section('title')
    | Elenco Post
@endsection

@section('content')
    <div class="container">
        <h1>Lista Post</h1>

        @if (session('deleted'))
            <div class="alert alert-success" role="alert">
                {{ session('deleted') }}
            </div>
        @endif

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Category</th>
                    <th scope="col">Tags</th>
                    <th colspan="4" scope="col">Content</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($posts as $post)
                    <tr>
                        <th scope="row">{{ $post->id }}</th>

                        <td>{{ $post->title }}</td>

                        <td>
                            @if ($post->category)
                                {{ $post->category->name }}
                            @else
                                /
                            @endif
                        </td>

                        <td>
                            @forelse ($post->tags as $tag)
                                <span class="badge bg-primary">{{ $tag->name }}</span>
                            @empty
                                /
                            @endforelse
                        </td>

                        <td>{{ Str::limit($post->content, 50, '...') }}</td>

                        <td>
                            <a class="btn btn-success" href="{{ route('admin.posts.show', $post) }}">INFO</a>
                        </td>

                        <td>
                            <a class="btn btn-primary" href="{{ route('admin.posts.edit', $post) }}">EDIT</a>
                        </td>

                        <td>
                            <form action="{{ route('admin.posts.destroy', $post) }}" method="post"
                                onsubmit="return confirm('Sei sicuro di voler eliminare il post {{ $post->title }}')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">DELETE</button>
                            </form>
                        </td>

                    </tr>
                @endforeach

            </tbody>
        </table>

        {{ $posts->links() }}

    </div>
@endsection
