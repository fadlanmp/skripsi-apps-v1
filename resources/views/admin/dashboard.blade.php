@extends('dashboard.layouts.main')

@section('container')
    
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Welcome back, {{ auth()->user()->name }}</h1>
  </div>
  
  <div class="row">
    <div class="col-md-6">
      @canany(['admin', 'ustad'])
        <div id="civitas"></div>
      @endcanany

      @can('santri')
        <div id="civitasSantri"></div>
      @endcan
    </div>
    <div class="col-md-6">
      <div id="posts"></div>
    </div>
  </div>
  

  <div id="kitab"></div>
  <div id="nilai"></div>
  

  <h2>Daftar Nilai</h2>
  <div class="table-responsive">
    <table class="table table-striped table-sm">
      <a href="/dashboard/nilais">Lihat lebih banyak!</a>
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Rumpun</th>
          <th scope="col">Nama Kitab</th>
          <th scope="col">Pengajar</th>
          <th scope="col">Nama Santri</th>
          <th scope="col">Nilai</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($nilais as $nilai)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $nilai->rumpun->name }}</td>
          <td>{{ $nilai->kitab->title }}</td>
          <td>{{ $nilai->ustad->name }}</td>
          <td> {{ $nilai->santri->name }} </td>
          <td> {{ $nilai->nilai }} </td>
        </tr>
        @if ($loop->iteration == 5)
            @break
          @endif
        @endforeach
      </tbody>
    </table>
  </div>
  {{-- <h2>Blog</h2>
  <div class="table-responsive">
    <table class="table table-striped table-sm">
      <a href="/dashboard/posts">Lihat lebih banyak!</a>
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Kategori</th>
          <th scope="col">Judul</th>
          <th scope="col">Penulis</th>
          <th scope="col">Tanggal</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($posts as $post)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $post->category->name }}</td>
          <td>{{ $post->title }}</td>
          <td> {{ $post->author->name }} </td>
          <td>{{ $post->created_at}}</td>
          @if ($loop->iteration == 5)
            @break
          @endif
        </tr>
        @endforeach
      </tbody>
    </table>
  </div> --}}

  @include('admin.script')

@endsection