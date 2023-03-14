@extends('log')
<section>
    @if ($message = Session::get('Mensaje'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>
            {{ $message }}
        </strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" arial-lab>
        </button>
    </div>
@endif
</section>
{{-- <div class="login-dark">
<form method="POST" action="{{url("ingresar")}}">
    @csrf
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Email address</label>
      <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
      @error('email')
            <p class="text-danger">{{$message}}</p>
        @enderror
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Password</label>
      <input type="password" name="password" class="form-control" id="exampleInputPassword1" required>
      @error('password')
            <p class="text-danger">{{$message}}</p>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div> --}}


@section('contenedor')
    <div class="login-dark">
        <form method="post" action="{{url("ingresar")}}" >
            @csrf
            <h2 class="sr-only">Login</h2>
            <div class="illustration"><i class="icon ion-ios-locked-outline"></i></div>
            <div class="form-group"><input class="form-control" type="email" name="email" placeholder="Email" required>
                @error('email')
                <p class="text-danger">{{$message}}</p>
            @enderror</div>
            <div class="form-group"><input class="form-control" type="password" name="password" placeholder="Password" required>
                @error('password')
                <p class="text-danger">{{$message}}</p>
            @enderror
            </div>
            <div class="form-group"><button class="btn btn-primary btn-block" type="submit">Login</button></div>
            <a href="/register" class="forgot">Registrarme</a>
        </form>
    </div>
@endsection


