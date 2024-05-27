@extends('layouts.app')
@section('content')
    <div class="jumbotron p-5 mb-4 bg-dark text-white ">
        <div class="container py-5">

            <h1 class="display-5 fw-bold py-5">
                Welcome to My Portfolio
            </h1>

            <div class="text-center py-3 ">
                <a class="btn btn-outline-light " href="{{ route('login') }}">{{ __('Login') }}</a>
                <a class="btn btn-warning " href="{{ route('register') }}">{{ __('Register') }}</a>
            </div>

        </div>
    </div>

    <div class="content ">
        <div class="container">
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempora temporibus, dicta nemo aliquam totam nisi
                deserunt soluta quas voluptatum ab beatae praesentium necessitatibus minus, facilis illum rerum officiis
                accusamus dolores!</p>
        </div>
    </div>
@endsection
