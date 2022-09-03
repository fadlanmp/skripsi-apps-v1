@extends('dashboard.layouts.main')

@section('container')
<div class="container pt-3">
    <div class="row justify-content-center">
        <div class="col-md-10 ">
            <h2 class="mb-5">Detail Kitab</h2>

            <a href="/dashboard/kitabs" class="btn btn-success mb-2"><span data-feather="arrow-left"></span> Kembali ke daftar kitab</a>
            @can('admin')
            <a href="/dashboard/kitabs/{{ $kitabs->slug }}/edit" class="btn btn-warning mb-2"><span data-feather="edit"></span> Edit</a>
            <form action="/dashboard/kitabs/{{ $kitabs->slug }}" method="post" class="d-inline">
                @method('delete')
                @csrf
                <button class="btn btn-danger mb-2" onclick="return confirm('Are you sure?')"><span data-feather="x-circle"></span> Delete</button>
            </form>
            @endcan

            <div class="row">
                <div class="col-md-4">
                    @if ($kitabs->image)
                    <div style="max-height: 350px; overflow:hidden">
                        <img src=" {{ asset('storage/' . $kitabs->image) }}" alt="{{ $kitabs->rumpun->name }}" class="img-fluid mt-3">
                    </div>
                        
                    @else
                        <img src="https://source.unsplash.com/400x300?{{ $kitabs->rumpun->name }}" alt="{{ $kitabs->rumpun->name }}" class="img-fluid mt-3">
                    @endif
                </div>
                <div class="col-md-5">
                    <table class="table">
                        <tr>
                            <th scope="row">Nama Kitab</th>
                            <th scope="row">:</th>
                            <td>{{ $kitabs->title }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Penulis</th>
                            <th scope="row">:</th>
                            <td>{{ $kitabs->pengarang }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Rumpun</th>
                            <th scope="row">:</th>
                            <td>{{ $kitabs->rumpun->name }}</td>
                        </tr>
                    </table>
                </div>
            </div>



            
        </div>
    </div>
</div>
@endsection