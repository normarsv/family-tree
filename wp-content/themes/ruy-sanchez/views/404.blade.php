@extends('layouts.master')

@section('content')
    <section class="container flex flex-col justify-center items-center space-y-8 py-24">
{{--        <h1 class="text-4xl">404</h1>--}}
        <p class="font-title text-5xl md:text-6xl font-bold text-center">Page Not found</p>
        <a href="/" class="text-xl md:text-xl underline">Go back home</a>
    </section>
@endsection