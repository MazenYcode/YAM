<?php

function custom_about_us_shortcode()
{
    ob_start();
    ?>
    <li>
        <div class="w-full min-h-screen min-h-[700px] bg-cover bg-center"
            style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/img_about.jpg')">
            <div class="container mx-auto px-4 py-12" data-page-no="5">
                <div class="nav_gap">

                    <div class="flex flex-col mb-8">
                        <div class="bg-white bg-opacity-70 backdrop-blur-sm rounded-lg p-6 text-left shadow-md">
                            <h2 class="slide-text text-2xl font-bold mb-4">
                                Lorem ipsum dolor
                            </h2>
                            <p class="slide-text text-gray-800">
                                Nulla efficitur, ligula et imperdiet volutpat, lacus
                                tortor tempus massa, eget tempus quam nibh vel nulla.
                                Vivamus non molestie leo, non tincidunt diam. Mauris
                                sagittis elit in velit ultricies aliquet sed in magna.
                                Pellentesque semper, est nec consequat viverra, sem augue
                                tincidunt nisi, a posuere nisi sapien sed sapien. Nulla
                                facilisi.
                            </p>
                        </div>
                    </div>

                    <div class="flex flex-col lg:flex-row gap-6">
                        <div class="bg-white bg-opacity-70 backdrop-blur-sm rounded-lg p-6 text-left shadow-md flex-1">
                            <h2 class="slide-text text-2xl font-bold mb-4">
                                Nulla facilisi
                            </h2>
                            <p class="slide-text text-gray-800">
                                Donec vitae bibendum est, et ultrices urna. Curabitur ac
                                bibendum augue, a convallis mi. Cum sociis natoque
                                penatibus et magnis dis parturient montes, nascetur
                                ridiculus mus. Sed ultrices placerat arcu.
                            </p>
                        </div>
                        <div class="bg-white bg-opacity-70 backdrop-blur-sm rounded-lg p-6 text-left shadow-md flex-1">
                            <h2 class="slide-text text-2xl font-bold mb-4">
                                Aliquam sem sem
                            </h2>
                            <p class="slide-text text-gray-800">
                                Proin sagittis mauris dolor, vel efficitur lectus dictum
                                nec. Sed ultrices placerat arcu, id malesuada metus cursus
                                suscipit. Donex quis consectetur ligula. Proin accumsan
                                eros id nisi porttitor, a facilisis quam cursus.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </li>
    <?php
    return ob_get_clean();
}

add_shortcode('about_us', 'custom_about_us_shortcode');


?>