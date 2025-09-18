<nav class="bg-white bg-opacity-90 lg:bg-opacity-75 shadow fixed top-6 left-0 right-0 mx-4 rounded-lg z-50">
    <div class="container mx-auto px-4 sm:px-7 py-4 sm:py-7 flex items-center justify-between flex-wrap">
        <a class="text-4xl uppercase  text-gray-800 flex items-center " href="#">
            <div class="yam_Y">Y</div>
            <div class="yam_A">A</div>
            <div class="yam_M">M</div>
        </a>

        <button class="block lg:hidden text-gray-800 focus:outline-none"
            onclick="document.getElementById('dmNavbar').classList.toggle('hidden')">
            &#9776;
        </button>

        <div class="w-full items-center lg:flex lg:w-auto hidden" id="dmNavbar">
            <?php
            wp_nav_menu([
                'theme_location' => 'primary',
                'container' => false,
                'menu_class' => 'mt-4 lg:mt-0 lg:flex lg:space-x-6 text-xl uppercase text-center',
                'walker' => new Custom_Walker_Nav(),
                'fallback_cb' => '__return_false',
            ]);
            ?>
        </div>
    </div>
</nav>
<?php




class Custom_Walker_Nav extends Walker_Nav_Menu
{

    function start_el(&$output, $item, $depth = 0, $args = [], $id = 0)
    {
        $classes = empty($item->classes) ? [] : (array) $item->classes;
        $has_children = in_array('menu-item-has-children', $classes);
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item));


        $li_classes = 'nav-item ' . esc_attr($class_names);
        if ($has_children) {
            $li_classes .= ' relative group';
        }

        $output .= '<li class="' . $li_classes . '">';

        $is_active = isset($args->active_page) && $args->active_page == $item->menu_order;


        $link_class = $is_active
            ? 'block text-xl py-2 px-4 text-pink-500 font-bold'
            : 'block text-xl py-2 px-4 text-black hover:text-pink-500 transition duration-300';


        if ($has_children) {
            $link_class .= ' flex justify-center items-center w-full';
        }


        $attributes = ' class="' . $link_class . ' focus:outline-none" tabindex="0"';
        if (!empty($item->url)) {
            $attributes .= ' href="' . esc_url($item->url) . '"';
        } else {
            $attributes .= ' href="javascript:void(0);"';
        }

        $attributes .= !empty($item->attr_title) ? ' data-no="' . esc_attr($item->attr_title) . '"' : '';

        $title = apply_filters('the_title', $item->title, $item->ID);


        $output .= '<a' . $attributes . ($has_children ? ' data-toggle="dropdown"' : '') . '>' . $title;

        if ($has_children) {
            $output .= ' <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>';
        }

        $output .= '</a>';
    }


    function end_el(&$output, $item, $depth = 0, $args = [])
    {
        $output .= "</li>\n";
    }


    function start_lvl(&$output, $depth = 0, $args = [])
    {

        $output .= '<ul class="dropdown-menu absolute left-0 top-full w-48 bg-white border 
        border-gray-200 rounded shadow-lg opacity-0 scale-95 transform transition-all duration-300 ease-out z-50 
        pointer-events-none group-hover:opacity-100 group-hover:scale-100 pointer-events-auto hidden lg:block">';
    }


    function end_lvl(&$output, $depth = 0, $args = [])
    {
        $output .= "</ul>\n";
    }
}






?>