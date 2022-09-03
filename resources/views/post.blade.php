@extends('layouts.main')

@section('container')

<div class="container pt-3">
    <div class="row justify-content-center">
        <div class="col-md-10 ">
            <h2 class="mb-5">{{ $post->title }}</h2>
    
            <p>By. <a href="/posts?author={{ $post->author->username }}" class="text-decoration-none">{{ $post->author->name }}</a> in <a href="/posts?category={{ $post->category->slug }}" class="text-decoration-none">{{ $post->category->name }}</a> {{ $post->created_at->diffForHumans() }}</p>
    
            @if ($post->image)
                <img src=" {{ asset('storage/' . $post->image) }}" alt="{{ $post->category->name }}" class="img-fluid">
            @else
                <img src="https://source.unsplash.com/1200x400?{{ $post->category->name }}" alt="{{ $post->category->name }}" class="card-img-top">
            @endif

            <article class="my-3 fs-5">
                {!! $post->body !!}
            </article>
        
            <a href="/posts" class="text-decoration-none d-block mt-3">Kembali ke Berita</a>
        </div>
    </div>
</div>

@endsection
