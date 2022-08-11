let mix = require('laravel-mix');

mix
    .setPublicPath('dist')
    .setResourceRoot('/wp-content/themes/ruy-sanchez/dist')
    .options({
        processCssUrls: false
    })
    .copyDirectory('assets/images', 'dist/images')
    .copyDirectory('assets/fonts', 'dist/fonts')
    .postCss('assets/css/app.css', 'dist', [
        require('tailwindcss'),
    ])
    .js('assets/js/app.js', 'dist')
    .autoload({'jquery': ['window.$', 'window.jQuery', '$']})
;

if (mix.inProduction()) {
    mix.version();
}
