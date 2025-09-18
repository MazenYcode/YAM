<?php



function yam_enqueue_scripts()
{

    wp_enqueue_style(
        'tailwind',
        get_template_directory_uri() . '/assets/css/tailwind.min.css',
        array(),
        '2.0.2'
    );


    wp_enqueue_style(
        'custom-md-style',
        get_template_directory_uri() . '/assets/css/custom_md_style.css',
        array('tailwind'),
        '1.0.0'
    );


    wp_enqueue_script(
        'imagesloaded',
        get_template_directory_uri() . '/assets/js/imagesloaded.pkgd.min.js',
        array(),
        null,
        true
    );


    wp_enqueue_script(
        'custom-md',
        get_template_directory_uri() . '/assets/js/custom_md.js',
        array('imagesloaded'),
        '1.0.1',
        true
    );
}
add_action('wp_enqueue_scripts', 'yam_enqueue_scripts');




function custom_fonts()
{
    echo "<style>
        @font-face {
            font-display: swap;
            font-family: 'Chewy';
            font-style: normal;
            font-weight: 400;
            src: url('" . get_template_directory_uri() . "/assets/fonts/chewy-v18-latin-regular.woff2') format('woff2'),
                 url('" . get_template_directory_uri() . "/assets/fonts/chewy-v18-latin-regular.woff') format('woff');
        }

        @font-face {
            font-display: swap;
            font-family: 'Kalam';
            font-style: normal;
            font-weight: 400;
            src: url('" . get_template_directory_uri() . "/assets/fonts/kalam-v17-latin-regular.woff2') format('woff2'),
                 url('" . get_template_directory_uri() . "/assets/fonts/kalam-v17-latin-regular.woff') format('woff');
        }

        @font-face {
            font-display: swap;
            font-family: 'Kalam';
            font-style: normal;
            font-weight: 700;
            src: url('" . get_template_directory_uri() . "/assets/fonts/kalam-v17-latin-700.woff2') format('woff2'),
                 url('" . get_template_directory_uri() . "/assets/fonts/kalam-v17-latin-700.woff') format('woff');
        }
    </style>";
}
add_action('wp_head', 'custom_fonts');





function load_local_font_awesome()
{
    wp_enqueue_style('font-awesome-local', get_template_directory_uri() . '/assets/css/font-awesome.min.css', array(), '6.5.0');
}
add_action('wp_enqueue_scripts', 'load_local_font_awesome');




?>