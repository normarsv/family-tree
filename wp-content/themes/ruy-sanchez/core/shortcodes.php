<?php

add_shortcode('full-width-img', function ($atts = [], $content = null) {
    return "<div class='w-full overflow-hidden aspect-w-16 aspect-h-7 rounded-lg'>" . gt_escape_br($content) . "</div>";
});

add_shortcode('double-img', function ($atts = [], $content = null) {
    $output = preg_replace(
        '|(<img [^>]+>)|',
        '<div class="w-2/3 md:w-1/2 overflow-hidden rounded-lg"><div class="">$1</div></div>',
        $content
    );
    return "<div class='my-12 flex flex-col md:flex-row space-y-12 md:space-y-0 md:space-x-20 items-center justify-around'>".gt_escape_br($output)."</div>";
});
