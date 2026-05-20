@extends('errors.layout')

@section('title', 'Not Implemented')
@section('code', '501')

@section('icon')
    <i class="fa-solid fa-code text-indigo-500"></i>
@endsection

@section('message', 'Not Implemented')

@section('description')
    The requested method or function is not supported or implemented on our secure server gateway. Please return home or check your connection.
@endsection

@section('action')
    <a href="{{ url('/') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-sm font-semibold transition-all duration-300 shadow-md hover:shadow-lg shadow-indigo-600/20 hover:scale-[1.02]">
        <i class="fa-solid fa-house-chimney mr-2"></i>
        <span>Go Back Home</span>
    </a>
@endsection
