@extends('layout.app')

@section('title')
    annyeong <3
@endsection

@section('content')
    <div class="carousel carousel-vertical">
        <!-- Basic Definition of Software Testing -->
        <div id="slide-1" class="carousel-item hero min-h-screen bg-base-200">
            <div class="w-screen hero-content flex-row justify-center px-20">
                <div class="max-w-md space-y-5">
                    <h1 class="text-8xl font-bold">annyeong!</h1> 
                    <h2 class="text-3xl">> welcome to kpop101 ^^</h2> 
                    <a href="{{ url('/') }}" class="btn btn-primary float-right">Get Started</a>
                </div>
            </div>
        </div>
    </div>
@endsection