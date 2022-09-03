@extends('dashboard.layouts.main')

@section('container')
<div class="container pt-3">
    <div class="row ">
        <div class="col-md-8 ">
            <h2 class="mb-5">Detail Nilai</h2>
            <a href="/dashboard/nilais" class="btn btn-success mb-2"><span data-feather="arrow-left"></span> Kembali ke daftar nilai</a>
            @canany(['admin', 'ustad'])
            <a href="/dashboard/nilais/{{ $nilai->id }}/edit" class="btn btn-warning mb-2"><span data-feather="edit"></span> Edit</a>
            <form action="/dashboard/nilais/{{ $nilai->id }}" method="post" class="d-inline">
                @method('delete')
                @csrf
                <button class="btn btn-danger mb-2" onclick="return confirm('Are you sure?')"><span data-feather="x-circle"></span> Delete</button>
            </form>
            @endcanany

            <table class="table">
                <tr>
                    <th scope="row">Nomor Induk Santri</th>
                    <th scope="row">:</th>
                    <td>{{ $nilai->santri->no_induk }}</td>
                </tr>
                <tr>
                    <th scope="row">Nama</th>
                    <th scope="row">:</th>
                    <td>{{ $nilai->santri->name }}</td>
                </tr>
                <tr>
                    <th scope="row">Kitab</th>
                    <th scope="row">:</th>
                    <td>{{ $nilai->kitab->title }}</td>
                </tr>
                <tr>
                    <th scope="row">Rumpun</th>
                    <th scope="row">:</th>
                    <td>{{ $nilai->rumpun->name }}</td>
                </tr>
                <tr>
                    <th scope="row">Pengajar</th>
                    <th scope="row">:</th>
                    <td>{{ $nilai->ustad->name }}</td>
                </tr>
                <tr>
                    <th scope="row">Nilai</th>
                    <th scope="row">:</th>
                    <td>{{ $nilai->nilai }}</td>
                </tr>
            </table>

            

            {{-- @if ($post->image)
            <div style="max-height: 350px; overflow:hidden">
                <img src=" {{ asset('storage/' . $post->image) }}" alt="{{ $post->category->name }}" class="img-fluid mt-3">
            </div>
                
            @else
                <img src="https://source.unsplash.com/1200x400?{{ $post->category->name }}" alt="{{ $post->category->name }}" class="img-fluid mt-3">
            @endif --}}

            {{-- <article class="my-3 fs-5">
                {!! $post->body !!}
            </article> --}}
        </div>
    </div>
</div>
@endsection