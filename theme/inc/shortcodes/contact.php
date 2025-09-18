<?php

function custom_contact_shortcode()
{
    ob_start();
    ?>
    <li>
        <div class="w-full min-h-screen min-h-[700px] bg-gray-100 flex items-center justify-center"
            style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/img4_2.jpg')">
            <div class="w-full max-w-2xl mx-auto p-6 bg-white bg-opacity-70 backdrop-blur-md rounded-lg shadow-md"
                data-page-no="5">
                <h2 class="slide-text text-3xl font-bold text-gray-800 mb-4 text-center">
                    Schreib uns, Freunde!
                </h2>
                <p class="slide-text text-gray-700 mb-6 text-center">
                    Wir freuen uns riesig auf eure Nachrichten! Erzählt uns alles, was ihr mögt, und lasst uns zusammen Spaß
                    haben!


                </p>
                <form action="" method="post" class="space-y-4">
                    <?php wp_nonce_field('custom_contact_form', 'contact_nonce'); ?>

                    <div>
                        <input type="text" id="name_contact" name="name_contact" placeholder="Name" required
                            class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-pink-400" />
                    </div>

                    <div>
                        <input type="email" id="email_contact" name="email_contact" placeholder="Email" required
                            class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-pink-400" />
                    </div>

                    <div>
                        <textarea id="message" name="message" rows="5" placeholder="Deine Nachricht" required
                            class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-pink-400"></textarea>
                    </div>

                    <div class="text-right">
                        <button type="submit" name="submit_contact"
                            class="slide-text bg-pink-500 hover:bg-pink-400 text-white font-semibold py-2 px-6 rounded transition">
                            Senden
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </li>
    <?php
    return ob_get_clean();
}

add_shortcode('contact', 'custom_contact_shortcode');



function handle_custom_contact_submission()
{
    if (
        isset($_POST['submit_contact']) &&
        isset($_POST['contact_nonce']) &&
        wp_verify_nonce($_POST['contact_nonce'], 'custom_contact_form')
    ) {
        if (
            !empty($_POST['name_contact']) &&
            !empty($_POST['email_contact']) &&
            !empty($_POST['message'])
        ) {
            global $wpdb;

            $name = sanitize_text_field($_POST['name_contact']);
            $email = sanitize_email($_POST['email_contact']);
            $message = sanitize_textarea_field($_POST['message']);

            if (!is_email($email)) {
                wp_die('Ups! Die E-Mail ist nicht richtig.');
            }

            $table = $wpdb->prefix . 'user_contact';
            $inserted = $wpdb->insert($table, [
                'name_contact' => $name,
                'email_contact' => $email,
                'message' => $message,
            ]);

            if ($inserted) {
                $to = get_option('admin_email');
                $subject = 'رسالة جديدة من نموذج التواصل';
                $body = "الاسم: $name\nالبريد: $email\n\nالرسالة:\n$message\n";
                $headers = ['Content-Type: text/plain; charset=UTF-8'];

                wp_mail($to, $subject, $body, $headers);

                wp_redirect(add_query_arg('contact', 'success', $_SERVER['REQUEST_URI']));
                exit;
            } else {
                wp_die('Oh nein! Die Nachricht konnte nicht gespeichert werden. Versuch’s später nochmal, ja?');
            }
        } else {
            wp_die('Hey, du hast was vergessen! Bitte alle Felder ausfüllen!');
        }
    }
}
add_action('init', 'handle_custom_contact_submission');


function show_success_contact_banner()
{
    if (isset($_GET['contact']) && $_GET['contact'] === 'success') {
        echo '<div class="fixed top-0 left-0 w-full bg-pink-500 text-white text-center py-4 text-lg z-50 shadow-md">
     Juhu! Deine Nachricht ist da! Danke, dass du uns geschrieben hast!
</div>';
        echo '<script>
            setTimeout(function() {
                window.location.href = "' . esc_url(home_url()) . '";
            }, 4000);
        </script>';
    }
}
add_action('wp_footer', 'show_success_contact_banner');










?>