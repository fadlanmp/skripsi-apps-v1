@extends('dashboard.layouts.main')

@section('container')
<div class="container pt-3">
    <div class="row justify-content-center">
        <div class="col-md-10 ">
            <h2 class="mb-5">{{ $post->title }}</h2>

            <a href="/dashboard/posts" class="btn btn-success mb-2"><span data-feather="arrow-left"></span> Back to all my posts</a>
            <a href="/dashboard/posts/{{ $post->slug }}/edit" class="btn btn-warning mb-2"><span data-feather="edit"></span> Edit</a>
            <form action="/dashboard/posts/{{ $post->slug }}" method="post" class="d-inline">
                @method('delete')
                @csrf
                <button class="btn btn-danger mb-2" onclick="return confirm('Are you sure?')"><span data-feather="x-circle"></span> Delete</button>
            </form>

            @if ($post->image)
            <div style="max-height: 350px; overflow:hidden">
                <img src=" {{ asset('storage/' . $post->image) }}" alt="{{ $post->category->name }}" class="img-fluid mt-3">
            </div>
                
            @else
                <img src="https://source.unsplash.com/1200x400?{{ $post->category->name }}" alt="{{ $post->category->name }}" class="img-fluid mt-3">
            @endif

            <article class="my-3 fs-5">
                {!! $post->body !!}
            </article>
        </div>
    </div>
</div>
@endsection