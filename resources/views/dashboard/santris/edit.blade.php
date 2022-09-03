@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Update Profil Santri {{ $santri->name }}</h1>
</div>
<div class="col-md-8">
    <form method="post" action="/dashboard/santris/{{ $santri->id }}" class="mb-5">
      @method('put')  
      @csrf
      <div class="mb-3">
        <label for="no_induk" class="form-label">Nomor Induk Santri</label>
        <input type="text" class="form-control @error('no_induk') is-invalid @enderror" id="no_induk" name="no_induk"  value="{{ old('no_induk', $santri->no_induk) }}" readonly>
        @error('no_induk')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

      <div class="mb-3">
        <label for="name" class="form-label">Nama</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $santri->name) }}" placeholder="Silakan isi nama di sini" autofocus required>
        @error('name')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username', $santri->user->username) }}" placeholder="Silakan isi nama di sini" readonly>
        @error('username')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      
      <div class="mb-3">
        <label for="jk" class="form-label">Jenis Kelamin</label>
        <select class="form-select" id="jk" name="jk" aria-label="Default select example" value="{{ old('jk', $santri->jk) }}">
          <option value="laki-laki">Laki-laki</option>
          <option value="perempuan">Perempuan</option>
        </select>
      </div>
      

      {{-- <div class="mb-3">
        <label for="password" class="form-label">Password Lama</label>
        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Silakan isi dengan password lama apabila ingin merubah password" name="password_lama">
        @error('password')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password Baru</label>
        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Silakan isi dengan password baru apabila ingin merubah password" name="password_baru">
        @error('password')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div> --}}

        <button type="submit" class="btn btn-primary">Update</button>
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