<?php

function custom_post_type_setup()
{
    $post_types = [
        [
            'name'               => 'relatives',
            'exclude_sites'      => [],
            'publicly_queryable' => true,
            'singular_label'     => 'Relative',
            'plural_label'       => 'Relatives',
            'has_archive'        => true,
            'rewrite'            => ['slug' => 'relative'],
            'menu_icon'          => 'dashicons-groups',
//            'taxonomies'         => ['topics', 'post_tag']
        ],
        [
            'name'               => 'events',
            'exclude_sites'      => [],
            'publicly_queryable' => true,
            'singular_label'     => 'Family Event',
            'plural_label'       => 'Family Events',
            'has_archive'        => true,
            'rewrite'            => ['slug' => 'events'],
            'menu_icon'          => 'dashicons-megaphone',
//            'taxonomies'         => ['topics', 'post_tag']
        ],
        [
            'name'               => 'history',
            'exclude_sites'      => [],
            'publicly_queryable' => true,
            'singular_label'     => 'History Blog',
            'plural_label'       => 'History Blog',
            'has_archive'        => true,
            'rewrite'            => ['slug' => 'history'],
            'menu_icon'          => 'dashicons-book-alt',
//            'taxonomies'         => ['topics', 'post_tag']
        ],
//        [
//            'name'               => 'blog',
//            'exclude_sites'      => [],
//            'publicly_queryable' => true,
//            'singular_label'     => 'Blog',
//            'plural_label'       => 'Blog',
//            'has_archive'        => true,
//            'rewrite'            => ['slug' => 'blog'],
//            'menu_icon'          => 'dashicons-welcome-write-blog',
//            'taxonomies'         => []
//        ],
    ];

    foreach ($post_types as $post_type) {

        $labels = [
            'name'               => _x($post_type['plural_label'], 'Post Type General Name'),
            'singular_name'      => _x($post_type['singular_label'], 'Post Type Singular Name'),
            'menu_name'          => __($post_type['plural_label']),
            'name_admin_bar'     => __($post_type['plural_label']),
            'parent_item_colon'  => __('Parent Item:'),
            'all_items'          => __('All ' . $post_type['plural_label']),
            'add_new_item'       => __('Add New ' . $post_type['singular_label']),
            'add_new'            => __('Add New'),
            'new_item'           => __('New ' . $post_type['plural_label']),
            'edit_item'          => __('Edit ' . $post_type['plural_label']),
            'update_item'        => __('Update ' . $post_type['plural_label']),
            'view_item'          => __('View ' . $post_type['plural_label']),
            'search_items'       => __('Search ' . $post_type['plural_label']),
            'not_found'          => __($post_type['plural_label'] . ' Not found'),
            'not_found_in_trash' => __($post_type['plural_label'] . ' Not found in Trash'),
        ];

        $args = [
            'label'               => __($post_type['name']),
            'description'         => __('The post type for ' . $post_type['name']),
            'menu_icon'           => __($post_type['menu_icon']),
            'labels'              => $labels,
            'supports'            => [
                'title',
                'thumbnail',
                'editor',
                'excerpt',
                'revisions',
                'custom-fields',
                'page-attributes',
                'post-formats',
            ],
            'taxonomies'          => isset($post_type['taxonomies']) ? $post_type['taxonomies'] : [],
            'hierarchical'        => true,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => isset($post_type['hide_in_menu']) && !$post_type['hide_in_menu'] ? false : true,
            'menu_position'       => 5,
            'show_in_admin_bar'   => true,
            'show_in_nav_menus'   => true,
            'can_export'          => true,
            'has_archive'         => isset($post_type['has_archive']) && !$post_type['has_archive'] ? false : true,
            'rewrite'             => isset($post_type['rewrite']) ? $post_type['rewrite'] : false,
            'exclude_from_search' => false,
            'publicly_queryable'  => isset($post_type['publicly_queryable']) && !$post_type['publicly_queryable'] ? false : true,
            'capability_type'     => 'post',
        ];

        register_post_type($post_type['name'], $args);
    }
}

function custom_taxonomies_setup()
{
    $labels = [
        'name'                       => _x('Topics', 'Taxonomy General name'),
        'singular_name'              => _x('Topic', 'Taxonomy Singular name'),
        'search_items'               => __('Search Topics'),
        'popular_items'              => __('Popular Topics'),
        'all_items'                  => __('All Topics'),
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => __('Edit Topic'),
        'update_item'                => __('Update Topic'),
        'add_new_item'               => __('Add New Topic'),
        'new_item_name'              => __('New Topic Name'),
        'separate_items_with_commas' => __('Separate topics with commas'),
        'add_or_remove_items'        => __('Add or remove topics'),
        'choose_from_most_used'      => __('Choose from the most used topics'),
        'menu_name'                  => __('Topics'),
    ];

    register_taxonomy('topics', ['relative'], [
        'hierarchical'      => false,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => false,
        'query_var'         => true,
        'rewrite'           => ['slug' => 'topic'],
    ]);
}

//function custom_post_status()
//{
//    register_post_status('flagged', [
//        'label'                     => _x('Flagged', 'post'),
//        'public'                    => true,
//        'exclude_from_search'       => false,
//        'show_in_admin_all_list'    => true,
//        'show_in_admin_status_list' => true,
//        'label_count'               => _n_noop('Flagged <span class="count">(%s)</span>', 'Flagged <span class="count">(%s)</span>'),
//    ]);
//}

function create_post_type()
{
    custom_post_type_setup();
    custom_taxonomies_setup();
//    custom_post_status();
}

add_action('init', 'create_post_type');

// Display Custom Post Status Option in Post Edit
//add_action('admin_footer-post.php', function () {
//    global $post;
//    $complete = '';
//    $label = '';
//
//    if ($post->post_type == 'question') {
//        if ($post->post_status == 'flagged') {
//            $complete = 'selected="selected"';
//            $label = 'Flagged';
//        }
//        echo "<script>
//            jQuery(document).ready( function() {
//                jQuery( 'select#post_status' ).append( '<option value=\"flagged\" " . $complete . ">Flagged</option>' );
//                ";
//        if ($label !== '') {
//            echo "jQuery( '#post-status-display' ).append( '$label' )";
//        }
//        echo "
//            });
//            </script>";
//    }
//});

// Display custom post status in post list view
//add_filter('display_post_states', function ($states) {
//    global $post;
//    $arg = get_query_var('post_status');
//    if ($arg != 'flagged' && $post->post_status == 'flagged') {
//        return ['Flagged'];
//    }
//    return $states;
//});