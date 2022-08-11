<footer>
    <div class="bg-blue pt-10 md:pt-0 pb-7">
        <div class="container columns-4 gap-20 px-6 md:px-10 flex flex-col md:flex-row relative justify-between px-8 py-10 max-w-none xl:max-w-screen-2xl">
            <div class="flex flex-col space-y-6">
                <img src="@asset('images/main-logo-light.png')" alt="Swiss Hospital Logo">
                <p>{{ get_field('footer_description','option') }}</p>
            </div>
            <div class="flex flex-col space-y-6">
                <img src="@asset('images/main-logo-light.png')" alt="Swiss Hospital Logo">
                <p>{{ get_field('footer_description','option') }}</p>
            </div>
            <div class="flex flex-col space-y-6">
                <img src="@asset('images/main-logo-light.png')" alt="Swiss Hospital Logo">
                <p>{{ get_field('footer_description','option') }}</p>
            </div>
            <div class="flex flex-col space-y-6">
                <img src="@asset('images/main-logo-light.png')" alt="Swiss Hospital Logo">
                <p>{{ get_field('footer_description','option') }}</p>
            </div>

{{--            <div class="flex flex-col space-y-3 mt-16">--}}
{{--                <h3 class="font-title text-4xl">{{ get_field('subscribe_title','option') }}</h3>--}}
{{--                <p>{!! get_field('subscribe_copy','option') !!}</p>--}}
{{--            </div>--}}

{{--            <div class="absolute bottom-0 left-6 md:left-11 text-sm">--}}
{{--                <p>{{ get_field('footer_description','option') }}</p>--}}
{{--                <div class="flex flex-row space-x-5 md:space-x-3 underline">--}}
{{--                    {!!--}}
{{--                        strip_tags(wp_nav_menu([--}}
{{--                        'theme_location' => 'footer-nav',--}}
{{--                        'container'  => false,--}}
{{--                        'echo'       => false,--}}
{{--                        'items_wrap' => '%3$s'--}}
{{--                        ]),'<a>');--}}
{{--                    !!}--}}
{{--                </div>--}}
{{--            </div>--}}

        </div>
    </div>
</footer>