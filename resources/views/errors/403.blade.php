@extends('errors.layout')

@section('title', 'Access Denied')
@section('code', '403')

@section('icon')
    <i class="fa-solid fa-user-shield text-amber-500"></i>
@endsection

@section('message', 'Security Blocked')

@section('description')
    Your request has been flagged and intercepted by our high-security firewall shield. If you believe this is an error, please try refreshing or verify your credentials.
@endsection

@section('action')
    <a href="{{ url('/') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-sm font-semibold transition-all duration-300 shadow-md hover:shadow-lg shadow-indigo-600/20 hover:scale-[1.02]">
        <i class="fa-solid fa-house-chimney mr-2"></i>
        <span>Return to Portfolio</span>
    </a>
@endsection
