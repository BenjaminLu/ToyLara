@extends('home')
@section('container')
    <h1>Title</h1>
    @foreach ($params as $key => $value)
        <li>{{$key}}</li>
        <li>{{$value}}</li>
    @endforeach
@endsection