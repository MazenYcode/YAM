<?php
function custom_first_gallery_shortcode()
{
    $post_id = get_the_ID();


    $background_image = get_post_meta($post_id, 'first_gallery_background', true);
    $title = get_post_meta($post_id, 'first_gallery_title', true);
    $description = get_post_meta($post_id, 'first_gallery_description', true);
    $gallery_images = get_post_meta($post_id, 'first_gallery_images', true);
    $gallery_images = json_decode($gallery_images, true);
    $background_id = attachment_url_to_postid($background_image);
    $bg_small = wp_get_attachment_image_src($background_id, 'medium')[0];
    $bg_large = wp_get_attachment_image_src($background_id, 'full')[0];

    ob_start(); ?>

    <li>
        <div class="w-full min-h-screen min-h-[700px] flex flex-col bg-cover bg-center">
            <picture class="absolute inset-0 w-full h-full z-0">
                <source media="(max-width: 768px)" srcset="<?php echo esc_url($bg_small); ?>">
                <img src="<?php echo esc_url($bg_large); ?>" alt="" class="w-full h-full object-cover" loading="lazy">
            </picture>



            <div class="nav_gap flex-grow flex items-center">
                <div class="container mx-auto px-4" data-page-no="2" data-page-type="gallery">

                    <div class="text-center mb-12">
                        <h2 class="slide-text text-3xl font-bold text-white mb-4">
                            <?php echo esc_html($title); ?>
                        </h2>
                        <p class="slide-text text-white max-w-2xl mx-auto">
                            <?php echo esc_html($description); ?>
                        </p>
                    </div>

                    <div class="slide-img grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                        <?php if (!empty($gallery_images) && is_array($gallery_images)): ?>
                            <?php foreach ($gallery_images as $img): ?>
                                <?php

                                $attachment_id = attachment_url_to_postid($img['url']);
                                if (!$attachment_id)
                                    continue;
                                ?>

                                <div class="overflow-hidden rounded shadow-lg group relative">
                                    <?php
                                    echo wp_get_attachment_image(
                                        $attachment_id,
                                        'medium_large',
                                        false,
                                        array(
                                            'alt' => esc_attr($img['caption'] ?? 'Gallery Image'),
                                            'class' => 'w-full h-[500px] scale-110 max-w-[500px] mx-auto object-cover transform group-hover:scale-105 transition-transform duration-300'
                                        )
                                    );
                                    ?>
                                    <div
                                        class="absolute inset-0 bg-black bg-opacity-60 opacity-0 group-hover:opacity-100 transition duration-300 flex flex-col justify-center items-center p-4">
                                        <div class="border border-white rounded-lg p-4 text-white text-center max-w-xs">
                                            <h2 class="text-xl font-bold">
                                                <?php echo esc_html($img['caption']); ?>
                                            </h2>
                                        </div>
                                        <a href="<?php echo esc_url($img['url']); ?>"
                                            class="mt-4 inline-block underline text-white view-more"
                                            data-img="<?php echo esc_url($img['url']); ?>">
                                            Bild vergrößern
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>

                        <div class="h-20 lg:h-32"></div>
                    </div>
                </div>
            </div>
        </div>
    </li>

    <?php
    return ob_get_clean();
}

add_shortcode('first_gallery', 'custom_first_gallery_shortcode');
