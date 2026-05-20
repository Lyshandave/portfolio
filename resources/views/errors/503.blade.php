@extends('errors.layout')

@section('title', 'Service Unavailable')
@section('code', '503')

@section('icon')
    <i class="fa-solid fa-screwdriver-wrench text-emerald-500"></i>
@endsection

@section('message', 'System Maintenance')

@section('description')
    We are temporarily offline conducting scheduled security hardening and upgrades. Our portfolio will be back online shortly.
@endsection

@section('action')
    <a href="javascript:window.location.reload();" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-sm font-semibold transition-all duration-300 shadow-md hover:shadow-lg shadow-indigo-600/20 hover:scale-[1.02]">
        <i class="fa-solid fa-arrows-rotate mr-2"></i>
        <span>Reload Page</span>
    </a>
@endsection
