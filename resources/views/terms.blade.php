@extends('layout.layout')

@section('title','Terms')
@section('content')
    <div class="row">
        <div class="col-3">
            @include('shared.left-sidebar')
        </div>
        <div class="col-6">
            <h1>Terms</h1>
            <div>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus magni amet quibusdam nihil voluptatem
                cumque
                consequatur? Minima, impedit alias consequuntur libero quam non temporibus voluptatibus voluptates
                voluptatem
                aliquid eius fuga.
            </div>
        </div>
        <div class="col-3">
            @include('shared.searchbar')
            @include('shared.followbox')
        </div>
    </div>
@endsection
