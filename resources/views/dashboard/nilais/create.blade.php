@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Tambah Nilai</h1>
</div>
<div class="col-md-8">
    <form method="post" action="/dashboard/nilais" class="mb-5">
        @csrf
        
        @can('admin')
          <div class="mb-3">
            <label for="ustad" class="form-label">Pengajar</label>
            <select class="form-select" name="ustad_id" id="ustad">
              @foreach ($ustads as $ustad)
              @if (old('id') == $ustad->id)
              <option value="{{ $ustad->id }}" selected>{{$ustad->kitab->title}} oleh {{ $ustad->name}}</option>
              @else
              <option value="{{ $ustad->id }}">{{$ustad->kitab->title}} oleh {{ $ustad->name}}</option>
              @endif
              @endforeach
            </select>
          </div>
        @endcan

        

        <div class="mb-3">
          <label for="santri" class="form-label">Nama Santri</label>
          <select class="form-select" name="santri_id">
            @foreach ($santris as $santri)
            @if (old('santri_id') == $santri->id)
            <option value="{{ $santri->id }}" selected>{{ $santri->name }}</option>
            @else
            <option value="{{ $santri->id }}">{{ $santri->name }}</option>
            @endif
            @endforeach
          </select>
        </div>

        <div class="mb-3">
          <label for="nilai" class="form-label">Nilai</label>
          <input type="number" max="100" step="1" min="0"  class="form-control @error('nilai') is-invalid @enderror" id="nilai" name="nilai" autofocus required value="{{ old('nilai') }}">
          @error('nilai')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>

        <button type="submit" class="btn btn-primary">Tambah Nilai</button>
      </form>
</div>

<script>
  const title = document.querySelector('#title');
  const slug = document.querySelector('#slug');

  title.addEventListener('change', function(){
      fetch('/dashboard/posts/checkSlug?title=' + title.value)
      .then(response => response.json())
      .then(data => slug.value = data.slug)
  });

  document.addEventListener('trix-file-accept', function(e){
    e.preventDefault();
  })

  function previewImage()
  {
    const image = document.querySelector('#image');
    const imgPreview = document.querySelector('.img-preview');

    imgPreview.style.display = 'block';

    const oFReader = new FileReader();
    oFReader.readAsDataURL(image.files[0]);

    oFReader.onload = function(oFREvent)
    {
      imgPreview.src = oFREvent.target.result;
    }
  }
</script>
@endsection