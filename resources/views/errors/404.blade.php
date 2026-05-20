@extends('errors.layout')

@section('title', 'Page Not Found')
@section('code', '404')

@section('icon')
    <i class="fa-solid fa-compass text-indigo-500"></i>
@endsection

@section('message', 'Page Not Found')

@section('description')
    The link you followed may be broken, or the page has been moved. Let's get you back to the portfolio so you can continue exploring.
@endsection

@section('action')
    <a href="{{ url('/') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-sm font-semibold transition-all duration-300 shadow-md hover:shadow-lg shadow-indigo-600/20 hover:scale-[1.02]">
        <i class="fa-solid fa-arrow-left-long mr-2"></i>
        <span>Go Back Home</span>
    </a>
@endsection
