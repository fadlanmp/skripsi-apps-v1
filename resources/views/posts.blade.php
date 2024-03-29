@extends('layouts.main')

@section('container')
    <h1 class="mb-1 pt-3 text-center">{{ $title }}</h1>
    <div class="row justify-content-center mb-1">
      <div class="col-md-12 text-center">
        <p>Kategori : 
          <a href="/posts?category=announcement" class="text-decoration-none text-dark">Pengumuman</a>
          |
          <a href="/posts?category=News" class="text-decoration-none text-dark">Berita</a>
        </p>
      </div>
    </div>

    <div class="row justify-content-center mb-3">
      <div class="col-md-8">
        <form action="/posts">
          @if (request('category'))
              <input type="hidden" name="category" value="{{ request('category') }}">
          @endif
          @if (request('author'))
              <input type="hidden" name="author" value="{{ request('author') }}">
          @endif
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Cari ..." name="search" value="{{ request('search') }}">
            <button class="btn btn-secondary btn-dark " type="submit">Cari</button>
          </div>
        </form>
      </div>
    </div>

    @if ($posts->count())

    <div class="card mb-3">
      @if ($posts[0]->image)
        <div style="max-height: 400px; overflow:hidden">
            <img src=" {{ asset('storage/' . $posts[0]->image) }}" alt="{{ $posts[0]->category->name }}" class="img-fluid card-img-top">
        </div>
      @else
        <img src="https://source.unsplash.com/1200x400?{{ $posts[0]->category->name }}" alt="{{ $posts[0]->category->name }}" class="card-img-top">
      @endif
      
      <div class="card-body text-center">
        <h2 class="card-title">{{ $posts[0]->title}}</h2>
        <p class="card-text">{{ $posts[0]->excerpt }}</p>
        <p>
          <small class="text-muted">
            By. <a href="/posts?author={{ $posts[0]->author->username }}" class="text-decoration-none">{{ $posts[0]->author->name }}</a> in <a href="/posts?category={{ $posts[0]->category->slug }}" class="text-decoration-none">{{ $posts[0]->category->name }}</a> {{ $posts[0]->created_at->diffForHumans() }}
          </small>
        </p>

        <a href="/posts/{{ $posts[0]->slug }}" class="text-decoration-none btn btn-primary">Selengkapnya</a>

      </div>
    </div>

    <div class="container">
      <div class="row">
        @foreach ($posts->skip(1) as $post)
            
        <div class="col-md-6 mb-3">
          <div class="card">
            @if ($post->image)
              <img src=" {{ asset('storage/' . $post->image) }}" alt="{{ $post->category->name }}" class="img-fluid" height="400">
            @else
              <img src="https://source.unsplash.com/500x400?{{ $post->category->name }}" alt="{{ $post->category->name }}" class="card-img-top">
            @endif
          
            <div class="card-body">
              <h5 class="card-title">{{ $post->title }}</h5>
              <p>
                <small class="text-muted">
                  By. <a href="/posts?author={{ $post->author->username }}" class="text-decoration-none">{{ $post->author->name }}</a> in <a href="/posts?category={{ $post->category->slug }}" class="text-decoration-none">{{ $post->category->name }}</a> {{ $post->created_at->diffForHumans() }}
                </small>
              </p>
              <p class="card-text">{{ $post->excerpt }}</p>
              <a href="/posts/{{ $post->slug }}" class="btn btn-primary">Selengkapnya</a>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
    
    @else

    <p class="text-center fs-4">Tidak ada blog yang ditemukan</p>

    @endif

    <div class="d-flex justify-content-end">
      {{ $posts->links() }}
  </div>
@endsection
    
