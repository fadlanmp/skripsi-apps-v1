@extends('dashboard.layouts.main')

@section('container')
<div class="container pt-3">
    <div class="row ">
        <div class="col-md-9 ">
            <h2 class="mb-5">Profil Ustad</h2>

            <a href="/dashboard/ustads" class="btn btn-success mb-2"><span data-feather="arrow-left"></span> Kembali ke daftar ustad</a>
            @canany(['admin', 'ustad'])
                
            {{-- <a href="/dashboard/password/{{ $ustad->user_id }}" class="btn btn-info mb-2"><span data-feather="edit"></span> Edit Password</a> --}}
            @endcanany

            @can('admin')
                <a href="/dashboard/ustads/{{ $ustad->id }}/edit" class="btn btn-primary mb-2"><span data-feather="edit"></span> Edit Profil</a>


                {{-- <form action="/dashboard/ustads/{{ $ustad->id }}/reset" method="post" class="d-inline">
                    @csrf
                    <button class="btn btn-warning mb-2" onclick="return confirm('Are you sure?')"><span data-feather="rotate-ccw"></span> Reset Password</button>
                </form> --}}
    
                <form action="/dashboard/ustads/{{ $ustad->id }}" method="post" class="d-inline">
                    @method('delete')
                    @csrf
                    <button class="btn btn-danger mb-2" onclick="return confirm('Are you sure?')"><span data-feather="x-circle"></span> Delete</button>
                </form>
                
            @endcan

            <table class="table">
                <tr>
                    <th scope="row">Nama</th>
                    <th scope="row">:</th>
                    <td>{{ $ustad->name }}</td>
                </tr>
                @canany(['admin', 'ustad'])
                    
                <tr>
                    <th scope="row">Username</th>
                    <th scope="row">:</th>
                    <td>{{ $ustad->user->username }}</td>
                </tr>
                @endcanany
                <tr>
                    <th scope="row">Jenis Kelamin</th>
                    <th scope="row">:</th>
                    <td>{{ $ustad->jk }}</td>
                </tr>
                <tr>
                    <th scope="row">Nomor Kontak</th>
                    <th scope="row">:</th>
                    <td>{{ $ustad->no_kontak }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection