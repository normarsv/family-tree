<?php

/**
 * Disable comments column
 * https://wordpress.stackexchange.com/questions/232802/remove-comment-column-in-all-post-types
 */
//function disable_comments()
//{
//    $post_types = get_post_types();
//    foreach ($post_types as $post_type) {
//        if (post_type_supports($post_type, 'comments')) {
//            remove_post_type_support($post_type, 'comments');
//            remove_post_type_support($post_type, 'trackbacks');
//        }
//    }
//}
//
//add_action('admin_init', 'disable_comments');


/**
 * Remove pingbacks from comment count
 */
function comment_count($count)
{
    global $id;
    $comments = get_approved_comments($id);
    $comment_count = 0;

    foreach ($comments as $comment) {
        if ($comment->comment_type == '') {
            $comment_count++;
        }
    }

    return $comment_count;
}

add_filter('get_comments_number', 'comment_count', 0);

/**
 * Allow upload of svg
 */
function cc_mime_types($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}

add_filter('upload_mimes', 'cc_mime_types');

/**
 * Disable WordPress Admin Bar for all users but admins.
 */
show_admin_bar(false);

/*
* REMOVE WP EMOJI
* https://www.denisbouquet.com/remove-wordpress-emoji-code/
 */
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('admin_print_styles', 'print_emoji_styles');


/**
 * Remove WP embedded js
 * https://wordpress.stackexchange.com/questions/211701/what-does-wp-embed-min-js-do-in-wordpress-4-4
 */
function my_deregister_scripts()
{
    wp_deregister_script('wp-embed');
}

add_action('wp_footer', 'my_deregister_scripts');

//Add featured image to posts
add_theme_support('post-thumbnails');


//Change the main logo in the CMS
function login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo get_template_directory_uri()?>/assets/images/cms-logo.png);
            width: 220px;
            height: 70px;
            background-size: contain;
            background-repeat: no-repeat;
        }
    </style>
<?php }

add_action('login_enqueue_scripts', 'login_logo');

//Disable Edit Default Posts & Comments
add_action('admin_menu', function () {
    remove_menu_page('edit.php');
});

//Disable ld-json schema from the seo framework
add_filter('the_seo_framework_ldjson_scripts', function ( ) { return ''; } );