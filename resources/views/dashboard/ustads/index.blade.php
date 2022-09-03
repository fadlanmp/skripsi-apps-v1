@extends('dashboard.layouts.main')

@section('container')
    
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Daftar Ustad</h1>
</div>

@if (session()->has('success'))
  <div class="alert alert-success col-md-8" role="alert">
    {{ session('success') }}
  </div>
@endif

  <div class="table-responsive col-md-8">
    @can('admin')
      <a href="/dashboard/ustads/create" class="btn btn-primary mb-3">Tambah Ustad</a>
    @endcan
    <table class="table table-striped table-sm table-bordered">
      <thead>
        <tr class="text-center">
          <th scope="col">No</th>
          <th scope="col">Nama</th>
          <th scope="col">Jenis Kelamin</th>
          <th scope="col">Nomor Kontak</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($ustads as $ustad)
        <tr class="text-center">
          <td>{{ $loop->iteration }}</td>
          <td class="text-start">{{ $ustad->name }}</td>
          <td>{{ $ustad->jk }}</td>
          <td> {{ $ustad->no_kontak }} </td>
          <td>
            <a href="/dashboard/ustads/{{ $ustad->id }}" class="badge btn-success"><span data-feather="eye"></span></a>
            @can('admin')
              <a href="/dashboard/ustads/{{ $ustad->id }}/edit" class="badge btn-info"><span data-feather="edit"></span></a>

              <form action="/dashboard/ustads/{{ $ustad->id }}/reset" method="post" class="d-inline">
                @csrf
                <button class="badge btn-warning border-0" onclick="return confirm('Are you sure?')"><span data-feather="rotate-ccw"></span></button>
                </form>

              <form action="/dashboard/ustads/{{ $ustad->id }}" method="post" class="d-inline">
              @method('delete')
              @csrf
              <button class="badge btn-danger border-0" onclick="return confirm('Are you sure?')"><span data-feather="trash-2"></span></button>
              </form>
                
            @endcan
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection