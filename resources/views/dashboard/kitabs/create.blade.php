@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Tambah Kitab Baru</h1>
</div>
<div class="col-md-8">
    <form method="post" action="/dashboard/kitabs" class="mb-5" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="title" class="form-label">Nama / Judul Kitab</label>
          <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" autofocus required value="{{ old('title') }}">
          @error('title')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" readonly required value="{{ old('slug') }}">
            @error('slug')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="rumpun" class="form-label">Rumpun Kitab</label>
          <select class="form-select" name="rumpun_id">
            @foreach ($rumpuns as $rumpun)
            @if (old('rumpun_id') == $rumpun->id)
            <option value="{{ $rumpun->id }}" selected>{{ $rumpun->name }}</option>
            @else
            <option value="{{ $rumpun->id }}">{{ $rumpun->name }}</option>
            @endif
            @endforeach
          </select>
        </div>
        <div class="mb-3">
          <label for="pengarang" class="form-label">Pengarang Kitab</label>
          <input type="text" class="form-control @error('pengarang') is-invalid @enderror" id="pengarang" name="pengarang" autofocus required value="{{ old('pengarang') }}">
          @error('pengarang')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="image" class="form-label @error('image') is-invalid @enderror">Gambar Kitab</label>
          <img class="img-preview img-fluid mb-5 col-sm-5">
          <input class="form-control" type="file" id="image" name="image" onchange="previewImage()">
          @error('image')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>

        <button type="submit" class="btn btn-primary">Tambah Kitab</button>
      </form>
</div>

<script>
  const title = document.querySelector('#title');
  const slug = document.querySelector('#slug');

  title.addEventListener('change', function(){
      fetch('/dashboard/kitabs/checkSlug?title=' + title.value)
      .then(response => response.json())
      .then(data => slug.value = data.slug)
  });


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