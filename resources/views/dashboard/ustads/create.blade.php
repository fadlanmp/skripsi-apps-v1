@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Tambah Ustaz</h1>
</div>
<div class="col-md-8">
    <form method="post" action="/dashboard/ustads" class="mb-5" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="name" class="form-label">Nama</label>
          <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Silakan isi nama di sini" autofocus required>
          @error('name')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username') }}" placeholder="Silakan isi username di sini" required>
          @error('username')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="jk" class="form-label">Jenis Kelamin</label>
          <select class="form-select" id="jk" name="jk" aria-label="Default select example" value="{{ old('jk') }}">
            <option value="laki-laki">Laki-laki</option>
            <option value="perempuan">Perempuan</option>
          </select>
        </div>
        <div class="mb-3">
            <label for="no_kontak" class="form-label">Nomor Kontak</label>
            <input type="text" class="form-control @error('no_kontak') is-invalid @enderror" id="no_kontak" name="no_kontak"  value="{{ old('no_kontak') }}" placeholder="Silakan isi nomor kontak di sini">
            @error('no_kontak')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="kitab" class="form-label">Nama Kitab</label>
          <select class="form-select @error('kitab_id') is-invalid @enderror" name="kitab_id">
            @foreach ($kitabs as $kitab)
            @if (old('kitab_id') == $kitab->id)
            <option value="{{ $kitab->id }}" selected>{{ $kitab->title }}</option>
            @else
            <option value="{{ $kitab->id }}">{{ $kitab->title }}</option>
            @endif
            @endforeach
          </select>
          @error('kitab_id')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <button type="submit" class="btn btn-primary">Tambah Ustaz</button>
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