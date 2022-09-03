@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Ganti Password User {{ $user->name }}</h1>
</div>
<div class="col-md-8">
    <form method="post" action="/dashboard/password/{{ $user->id }}" class="mb-5">
      @method('put')  
      @csrf

      <div class="mb-3">
        <label for="password_lama" class="form-label">Password Lama</label>
        <input type="password" class="form-control @error('password_lama') is-invalid @enderror" id="password_lama" placeholder="Silakan isi dengan password lama apabila ingin merubah password" name="password_lama">
        @error('password_lama')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Password Baru</label>
        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Silakan isi dengan password baru apabila ingin merubah password" name="password">
        @error('password')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" placeholder="Masukkan ulang password baru" name="password_confirmation">
        @error('password_confirmation')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>

        <button type="submit" class="btn btn-primary">Update</button>
      </form>
</div>

{{-- <script>
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

</script> --}}
@endsection