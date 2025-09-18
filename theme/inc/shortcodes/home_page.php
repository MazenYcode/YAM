<?php
function custom_image_gallery_shortcode()
{
    $background_url = get_template_directory_uri() . '/img/img4_2.jpg';
    $attachment_id = attachment_url_to_postid($background_url);
    $bg_small = $attachment_id ? wp_get_attachment_image_src($attachment_id, 'medium')[0] : $background_url;
    $bg_large = $attachment_id ? wp_get_attachment_image_src($attachment_id, 'full')[0] : $background_url;

    ob_start(); ?>

    <li class="selected">
        <div class="w-full min-h-screen min-h-[700px] flex flex-col bg-cover bg-center relative overflow-hidden">
            <picture class="absolute inset-0 w-full h-full z-0">
                <source media="(max-width: 768px)" srcset="<?php echo esc_url($bg_small); ?>">
                <img src="<?php echo esc_url($bg_large); ?>" alt="" class="w-full h-full object-cover" loading="lazy">
            </picture>

            <div class="nav_gap flex-grow flex items-center relative z-10">
                <div class="container mx-auto px-4" data-page-no="1" data-page-type="gallery">
                    <div class="text-center mb-12">
                        <h1 class="slide-text text-3xl font-bold text-white mb-4">
                            Willkommen auf meiner kunterbunten Seite! Ich bin Yam
                        </h1>
                    </div>

                    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        <div class="bg-white bg-opacity-90 rounded shadow text-center px-6 py-12">
                            <i class="icon slide-text fa fa-4x fa-pencil text-black-600 mb-7 mx-auto"></i>
                            <h2 class="slide-text text-2xl font-semibold mb-7">
                                Yam liebt Zeichnen!
                            </h2>
                            <p class="slide-text text-gray-800 text-base">
                                Ich bin Yam und ich zeichne soooo gern! Am liebsten male ich Delfine, Bäume, Blumen, die
                                Sonne und kleine süße Mäuse.
                                Ich nehme oft meine Stifte und male einfach drauflos – das macht so viel Spaß! Macht ihr das
                                auch gern?“
                            </p>
                        </div>
                        <div class="bg-white bg-opacity-90 rounded shadow text-center px-6 py-12">
                            <i class="icon slide-text fa fa-4x fa-bicycle text-black-600 mb-7 mx-auto"></i>
                            <h2 class="slide-text text-2xl font-semibold mb-7">
                                Ich fahr’ sooo gern Fahrrad!
                            </h2>
                            <p class="slide-text text-gray-800 text-base">
                                Ich freu mich immer sooo auf’s Wochenende! Dann machen wir als Familie einen Ausflug –
                                meistens in den Park oder aufs Land. Natürlich nehm ich mein Fahrrad oder meinen Roller mit.
                                Das macht soooo viel Spaß!“
                            </p>
                        </div>
                        <div class="bg-white bg-opacity-90 rounded shadow text-center px-6 py-12">
                            <i class="icon slide-text fa fa-4x fa-scissors text-black-600 mb-7 mx-auto"></i>
                            <h2 class="slide-text text-2xl font-semibold mb-7">
                                Kleben, Schneiden, Falten – los geht’s!
                            </h2>
                            <p class="slide-text text-gray-800 text-base">
                                Ich bastle total gern! Am liebsten schneide, klebe und falte ich bunte Sachen aus Papier.
                                Ich mache Tiere, Blumen oder kleine Geschenke für meine Familie. Das ist sooo schön!
                            </p>
                        </div>
                    </div>
                    <div class="h-20 lg:h-32"></div>
                </div>
            </div>
        </div>
    </li>

    <?php
    return ob_get_clean();
}

add_shortcode('home_page', 'custom_image_gallery_shortcode');
?>