@extends('dashboard.layouts.main')

@section('container')
    
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Welcome back, {{ auth()->user()->name }}</h1>
  </div>

  <div id="chart">

  </div>

  <h2>Daftar Ustad</h2>
  <div class="table-responsive">
    <table class="table table-striped table-sm">
      <a href="/dashboard/ustads">Lihat lebih banyak!</a>
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Nama</th>
          <th scope="col">Jenis Kelamin</th>
          <th scope="col">Nomor Kontak</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($ustads as $ustad)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $ustad->name }}</td>
          <td>{{ $ustad->jk }}</td>
          <td> {{ $ustad->no_kontak }} </td>
          @if ($loop->iteration == 5)
            @break
          @endif
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  @can('admin', 'ustad')
      
  <h2>Daftar Santri</h2>
  <div class="table-responsive">
    <table class="table table-striped table-sm">
      <a href="/dashboard/santris">Lihat lebih banyak!</a>
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Nomor Induk</th>
          <th scope="col">Nama</th>
          <th scope="col">Jenis Kelamin</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($santris as $santri)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td> {{ $santri->no_induk }} </td>
          <td>{{ $santri->name }}</td>
          <td>{{ $santri->jk }}</td>
          @if ($loop->iteration == 5)
            @break
          @endif
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  @endcan
  
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
  <h2>Daftar Kitab</h2>
  <div class="table-responsive">
    <table class="table table-striped table-sm">
      <a href="/dashboard/kitabs">Lihat lebih banyak!</a>
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Rumpun</th>
          <th scope="col">Nama Kitab</th>
          <th scope="col">Pengarang</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($kitabs as $kitab)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $kitab->rumpun->name }}</td>
          <td>{{ $kitab->title }}</td>
          <td> {{ $kitab->pengarang }} </td>
        </tr>
        @if ($loop->iteration == 5)
            @break
          @endif
        @endforeach
      </tbody>
    </table>
  </div>
  <h2>Blog</h2>
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
  </div>


  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script>
    Highcharts.chart('chart', {
      chart: {
          type: 'column'
      },
      title: {
          text: 'Rekap Civitas PP Manarul Hasan'
      },
      xAxis: {
          categories: [            
              'Laki-laki',
              'Perempuan'
          ],
          crosshair: true
      },
      yAxis: {
          title: {
              useHTML: true,
              text: 'Jumlah'
          }
      },
      tooltip: {
          headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
          pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
              '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
          footerFormat: '</table>',
          shared: true,
          useHTML: true
      },
      plotOptions: {
          column: {
              pointPadding: 0.2,
              borderWidth: 0
          }
      },
      series: [{
          name: 'Santri',
          data: [30,50]
      },
      {
        name: 'Ustad',
        data: [3,8]
      }]
  });
  </script>
@endsection