@extends('home')
@section('container')
    <h1>Title</h1>
    <?php foreach ($params as $key => $value) { ?>
        <li>{{$key}}</li>
        <li>{{$value}}</li>
    <?php } ?>
@endsection