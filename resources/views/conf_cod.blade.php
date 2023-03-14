@extends('log')
@section('contenedor')
    <div class="login-dark">
        <form method="post" action="{{ url('valCod') }}">
            @csrf
            <h2 class="sr-only">Ingresar Código</h2>
            <div class="illustration"><i class="icon ion-ios-locked-outline"></i></div>
            <div class="form-group"><input class="form-control" type="name" name="codigo" placeholder="Código" required>
                @error('codigo')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group"><button class="btn btn-primary btn-block" type="submit">Ingresar</button></div>
        </form>
    </div>
@endsection

