@extends('log')
<section>
    @if ($message = Session::get('Mensaje'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>
                {{ $message }}
            </strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" arial-lab>
            </button>
        </div>
    @endif
</section>
{{-- <form method="POST" action="{{url("registracion")}}">
    @csrf
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Nombre</label>
        <input type="text" name="name" class="form-control" aria-describedby="emailHelp" required>
        @error('name')
            <p class="text-danger">{{$message}}</p>
        @enderror
      </div>
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Email</label>
      <input type="email" name="email" class="form-control" aria-describedby="emailHelp" required>
      @error('email')
      <p class="text-danger">{{$message}}</p>
    @enderror
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Password</label>
      <input type="password" name="password" class="form-control" required>
      @error('password')
      <p class="text-danger">{{$message}}</p>
    @enderror
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form> --}}
@section('contenedor')
    <div class="login-dark">
        <form method="post" action="{{ url('registracion') }}">
            @csrf
            <h2 class="sr-only">Signup</h2>
            <div class="illustration"><i class="icon ion-ios-locked-outline"></i></div>
            <div class="form-group"><input class="form-control" type="name" name="name" placeholder="Name" required>
                @error('name')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group"><input class="form-control" type="email" name="email" placeholder="Email" required>
                @error('email')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group"><input class="form-control" type="password" name="password" placeholder="Password"
                    required>
                @error('password')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group"><button class="btn btn-primary btn-block" type="submit">Registrarme</button></div>
            <a href="/login" class="forgot">Login</a>
        </form>
    </div>
@endsection
