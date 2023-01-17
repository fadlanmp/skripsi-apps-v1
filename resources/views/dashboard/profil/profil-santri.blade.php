@extends('dashboard.layouts.main')

@section('container')
<div class="container pt-3">
    <div class="row ">
        <div class="col-md-8 ">
            <h2 class="mb-5">Profil Santri</h2>

            @if (session()->has('success'))
                <div class="alert alert-success col-md-8" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <table class="table">
                <tr>
                    <th scope="row">Nomor Induk Santri</th>
                    <th scope="row">:</th>
                    <td>{{ auth()->user()->santri->no_induk}}</td>
                </tr>
                <tr>
                    <th scope="row">Nama</th>
                    <th scope="row">:</th>
                    <td>{{ auth()->user()->santri->name }}</td>
                </tr>
                <tr>
                    <th scope="row">Username</th>
                    <th scope="row">:</th>
                    <td>{{ auth()->user()->username }}</td>
                </tr>
                <tr>
                    <th scope="row">Jenis Kelamin</th>
                    <th scope="row">:</th>
                    <td>{{ auth()->user()->santri->jk }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection