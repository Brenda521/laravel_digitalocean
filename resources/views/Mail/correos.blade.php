@extends('layaout')

@section('conteiner')
    <h1>Bienvenid@ {{$name}}</h1>
    <p>El siguiente código debe de ser ingresado en su télefono {{$codigo}}</p>
    <p>Después se le generará otro codigo, el cual debera de ser ingresado en el siguiente link<p/>
    <a href={{$url}} class="btn btn-primary">Verificar mi código</a>
@endsection
