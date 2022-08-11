<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="@php bloginfo('charset') @endphp">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <title><?php bloginfo('name'); ?> | <?php is_front_page() ? bloginfo('description') : wp_title(''); ?></title>

    <link href="{{ mix('app.css') }}" type="text/css" rel="stylesheet">

    @php wp_head() @endphp

    @include('partials.favicon')
</head>
<body @php body_class(get_field('background_color') == 'pink' ? 'bg-accent-light':'bg-white') @endphp>

@if(get_field('popup_is_active','option'))
    @include('components.popup',['type'=>get_field('popup_type','option')])
@endif

@include('partials.navigation')

<main class="page-content" id="content">
    @yield('content')
</main>

@include('partials.footer')

<script src="{{ mix('app.js') }}" type="application/javascript"></script>
@php wp_footer() @endphp
</body>
</html>
