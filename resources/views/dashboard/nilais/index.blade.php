@extends('dashboard.layouts.main')

@section('container')
    
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Daftar Nilai</h1>
</div>

@if (session()->has('success'))
  <div class="alert alert-success col-md-8" role="alert">
    {{ session('success') }}
  </div>
@endif

  <div class="table-responsive col-md-8">
    @canany(['admin', 'ustad'])
      <a href="/dashboard/nilais/create" class="btn btn-primary mb-3">Tambah Nilai</a>
    @endcanany
    <table class="table table-striped table-sm table-bordered">
      <thead>
        <tr class="text-center">
          <th scope="col">No</th>
          <th scope="col">Rumpun</th>
          <th scope="col">Nama Kitab</th>
          <th scope="col">Pengajar</th>
          <th scope="col">Nama Santri</th>
          <th scope="col">Nilai</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($nilais as $nilai)
        <tr class="text-center">
          <td>{{ $loop->iteration }}</td>
          <td>{{ $nilai->rumpun->name }}</td>
          <td>{{ $nilai->kitab->title }}</td>
          <td>{{ $nilai->ustad->name }}</td>
          <td> {{ $nilai->santri->name }} </td>
          <td> {{ $nilai->nilai }} </td>
          <td>
            <a href="/dashboard/nilais/{{ $nilai->id }}" class="badge btn-info"><span data-feather="eye"></span></a>
            @canany(['admin', 'ustad'])
            <a href="/dashboard/nilais/{{ $nilai->id }}/edit" class="badge btn-warning"><span data-feather="edit"></span></a>
            <form action="/dashboard/nilais/{{ $nilai->id }}" method="post" class="d-inline">
            @method('delete')
            @csrf
            <button class="badge btn-danger border-0" onclick="return confirm('Are you sure?')"><span data-feather="x-circle"></span></button>
            </form>
            @endcanany
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection