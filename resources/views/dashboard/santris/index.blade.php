@extends('dashboard.layouts.main')

@section('container')
    
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Daftar Santri</h1>
</div>

@if (session()->has('success'))
  <div class="alert alert-success col-md-8" role="alert">
    {{ session('success') }}
  </div>
@endif

  <div class="table-responsive col-md-8">
    @can('admin')
      <a href="/dashboard/santris/create" class="btn btn-primary mb-3">Tambah Santri</a>
    @endcan
    <table class="table table-striped table-sm table-bordered">
      <thead>
        <tr class="text-center">
          <th scope="col">No</th>
          <th scope="col">No Induk Santri</th>
          <th scope="col">Nama</th>
          <th scope="col">Jenis Kelamin</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($santris as $santri)
        <tr class="text-center">
          <td>{{ $loop->iteration }}</td>
          <td> {{ $santri->no_induk }} </td>
          <td>{{ $santri->name }}</td>
          <td>{{ $santri->jk }}</td>
          <td>
            <a href="/dashboard/santris/{{ $santri->id }}" class="badge btn-success"><span data-feather="eye"></span></a>
            @can('admin')
              <a href="/dashboard/santris/{{ $santri->id }}/edit" class="badge btn-info"><span data-feather="edit"></span></a>
              <form action="/dashboard/santris/{{ $santri->id }}/reset" method="post" class="d-inline">
                @csrf
                <button class="badge btn-warning border-0" onclick="return confirm('Are you sure?')"><span data-feather="rotate-ccw"></span></button>
                </form>
              <form action="/dashboard/santris/{{ $santri->id }}" method="post" class="d-inline">
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