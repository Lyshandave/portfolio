@extends('errors.layout')

@section('title', 'Server Error')
@section('code', '500')

@section('icon')
    <i class="fa-solid fa-server text-rose-500"></i>
@endsection

@section('message', 'System Error')

@section('description')
    An unexpected error occurred on our server. The incident has been securely logged, and stack traces have been completely hidden for security protection.
@endsection

@section('action')
    <a href="{{ url('/') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-sm font-semibold transition-all duration-300 shadow-md hover:shadow-lg shadow-indigo-600/20 hover:scale-[1.02]">
        <i class="fa-solid fa-rotate-right mr-2"></i>
        <span>Retry Home</span>
    </a>
@endsection
