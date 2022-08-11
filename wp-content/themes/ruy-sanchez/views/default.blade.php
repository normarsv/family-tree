@extends('layouts.master')

@section('content')

    @while( have_posts() )
        @php
            the_post();
        @endphp
        <section class="container font-sans prose md:prose-xl md:text-lg leading-normal md:leading-normal text-dark pt-16 pb-28 sm:pt-24 sm:pb-36 max-w-900">
            @php the_content() @endphp
        </section>
    @endwhile

@endsection