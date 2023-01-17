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
  {{-- memanggil javasript --}}
  @include('admin.script') 

@endsection