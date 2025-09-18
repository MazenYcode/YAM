<?php
/**
 * Plugin Name: All Galleries Sidebar
 */

add_action('enqueue_block_editor_assets', function () {
    wp_enqueue_script(
        'all-galleries-sidebar',
        plugin_dir_url(__FILE__) . 'sidebar.js',
        array('wp-plugins', 'wp-edit-post', 'wp-element', 'wp-components', 'wp-data'),
        filemtime(__DIR__ . '/sidebar.js')
    );
});

function register_all_galleries_sidebar_meta()
{
    $gallery_prefixes = ['first_gallery', 'second_gallery', 'third_gallery'];

    $fields = [
        'title',
        'description',
        'caption',
        'background',
        'image',
        'images',
    ];

    $post_types = ['post', 'page'];

    foreach ($post_types as $post_type) {
        foreach ($gallery_prefixes as $prefix) {
            foreach ($fields as $field) {
                $meta_key = "{$prefix}_{$field}";

                register_post_meta($post_type, $meta_key, [
                    'show_in_rest' => true,
                    'single' => true,
                    'type' => 'string',
                    'auth_callback' => function () {
                        return current_user_can('edit_posts');
                    },
                ]);
            }
        }
    }
}
add_action('init', 'register_all_galleries_sidebar_meta');


// ------------------------------------

function myplugin_editor_assets()
{
    wp_enqueue_style(
        'myplugin-editor-style',
        plugin_dir_url(__FILE__) . 'editor.css',
        array('wp-edit-post'),
        time()
    );
}
add_action('enqueue_block_editor_assets', 'myplugin_editor_assets');
