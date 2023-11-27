@extends('dashboard.layouts.main')

@section('container')
<div class="row justify-content-center">
    <div class="col-md-5 bg-light rounded p-3">
        <main class="form-registration w-100 m-auto">
            <h1 class="h3 my-3 fw-bold text-center">Registration Form</h1>
            @if (session()->has('success'))
              <div class="alert alert-success" role="alert">
                {{ session('success') }}
              </div>
            @endif
            <form action="/register" method="POST">
              @csrf
              <div class="d-flex justify-content-center">
                <img class="mb-4" src="/img/logo_pmk.png" alt="" width="136" height="136">
              </div>
          
              <div class="form-floating">
                <input type="text" name="name" class="form-control rounded-top @error('name') is-invalid @enderror" id="name" placeholder="name" required value="{{ old('name') }}">
                <label for="name">Nama</label>
                @error('name')
                <div class="invalid-feedback">
                  {{ $message }}
                </div> 
                @enderror
              </div>
              <div class="form-floating">
                <input type="text" name="nim" class="form-control @error('nim') is-invalid @enderror" id="nim" placeholder="nim" required value="{{ old('nim') }}">
                <label for="nim">NIM</label>
                @error('nim')
                <div class="invalid-feedback">
                  {{ $message }}
                </div> 
                @enderror
              </div>
              <div class="form-floating">
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" required value="{{ old('email') }}">
                <label for="email">Email address</label>
                @error('email')
                <div class="invalid-feedback">
                  {{ $message }}
                </div> 
                @enderror
              </div>
              <button class="w-100 btn btn-lg btn-primary mt-2" type="submit">Register</button>
            </form>
        </main>
    </div>
</div>

@endsection
