<?php

include_once(get_template_directory() . '/config.php');
include_once(INC . '/wp_enqueue/enqueue_css_js.php');

include_once(INC . '/shortcodes/home_page.php');
include_once(INC . '/shortcodesshortcodes/first_gallery.php');
include_once(INC . '/shortcodes/second_gallery.php');
include_once(INC . '/shortcodes/third_gallery.php');
include_once(INC . '/shortcodes/contact.php');


function register_my_menu()
{
    register_nav_menus([
        'primary' => __('Primary Menu'),
    ]);
}
add_action('init', 'register_my_menu');


?>