@extends('layouts.main')

@section('container')

<div class="row justify-content-center pt-5">
    <div class="col-md-4">
      
      @if (session()->has('success'))
          
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>

      @endif

      @if (session()->has('loginError'))
          
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('loginError') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>

      @endif

        <main class="form-signin text-center">
            <img class="mb-2" src="img/logo.png" alt="" width="72" >
            <h1 class="h3 mb-3 fw-normal text-center">Please login</h1>
            <form action="/login" method="post">
              @csrf
          
              <div class="form-floating">
                <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="username" name="username" autofocus required>
                <label for="username">Username</label>
                @error('username')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="form-floating">
                <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
                <label for="password">Password</label>
              </div>
              <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
            </form>
            <small>Belum terdaftar? Silakan  <a href="mailto:manarulhasankotabanjar@gmail.com">hubungin operator</a></small>
          </main>
    </div>
</div>
@endsection