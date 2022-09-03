@extends('dashboard.layouts.main')

@section('container')
    
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Daftar Kitab</h1>
</div>

@if (session()->has('success'))
  <div class="alert alert-success col-md-8" role="alert">
    {{ session('success') }}
  </div>
@endif

  <div class="table-responsive col-md">
    @can('admin')
      <a href="/dashboard/kitabs/create" class="btn btn-primary mb-3">Tambah Kitab</a>
    @endcan
    <table class="table table-striped table-sm table-bordered">
      <thead>
        <tr class="text-center">
          <th scope="col">No</th>
          <th scope="col">Rumpun</th>
          <th scope="col">Nama Kitab</th>
          <th scope="col">Pengarang</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($kitabs as $kitab)
        <tr>
          <td class="text-center">{{ $loop->iteration }}</td>
          <td>{{ $kitab->rumpun->name }}</td>
          <td>{{ $kitab->title }}</td>
          <td> {{ $kitab->pengarang }} </td>
          <td class="text-center">
            <a href="/dashboard/kitabs/{{ $kitab->slug }}" class="badge btn-info"><span data-feather="eye"></span></a>
            @can('admin')
            <a href="/dashboard/kitabs/{{ $kitab->slug }}/edit" class="badge btn-warning"><span data-feather="edit"></span></a>
              <form action="/dashboard/kitabs/{{ $kitab->slug }}" method="post" class="d-inline">
              @method('delete')
              @csrf
              <button class="badge btn-danger border-0" onclick="return confirm('Are you sure?')"><span data-feather="x-circle"></span></button>
              </form>
            </td>
          @endcan
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection