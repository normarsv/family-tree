<?php

$acf_local_path = get_template_directory() . '/acf/';

add_filter('acf/settings/load_json', function ($paths) {
    global $acf_local_path;

    unset($paths[0]);
    $paths[] = $acf_local_path;
    return $paths;
});


add_filter('acf/settings/save_json', function ($path) {
    global $acf_local_path;

    $path = $acf_local_path;
    return $path;
});

add_filter('acf/settings/show_admin', function () {

    $site_url = get_bloginfo('url');

    $enabled_urls = array(
        'http://ruy-sanchez.test'
    );

    return (in_array($site_url, $enabled_urls)) ? true : false;
});

