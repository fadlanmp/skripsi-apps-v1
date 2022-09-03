@extends('dashboard.layouts.main')

@section('container')
    
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">My Posts</h1>
</div>

@if (session()->has('success'))
  <div class="alert alert-success col-md-8" role="alert">
    {{ session('success') }}
  </div>
@endif

  <div class="table-responsive col-md">
    <a href="/dashboard/posts/create" class="btn btn-primary mb-3">Create new post</a>
    <table class="table table-striped table table-bordered align-middle">
      <thead>
        <tr class="text-center">
          <th scope="col">No</th>
          <th scope="col">Kategori</th>
          <th scope="col">Judul</th>
          <th scope="col">Penulis</th>
          <th scope="col">Tanggal</th>
          <th scope="col">Action</th>

        </tr>
      </thead>
      <tbody>
        @foreach ($posts as $post)
        <tr>
          <td class="text-center">{{ $loop->iteration }}</td>
          <td>{{ $post->category->name }}</td>
          <td>{{ $post->title }}</td>
          <td> {{ $post->author->name }} </td>
          <td class="text-center">{{ $post->created_at}}</td>
          <td class="text-center">
            <a href="/dashboard/posts/{{ $post->slug }}" class="badge btn-info"><span data-feather="eye"></span></a>
            <a href="/dashboard/posts/{{ $post->slug }}/edit" class="badge btn-warning"><span data-feather="edit"></span></a>
            <form action="/dashboard/posts/{{ $post->slug }}" method="post" class="d-inline">
            @method('delete')
            @csrf
            <button class="badge btn-danger border-0" onclick="return confirm('Are you sure?')"><span data-feather="x-circle"></span></button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection