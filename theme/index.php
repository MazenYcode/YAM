<?php get_header(); ?>

<main class="md-hero lg:relative">

    <?php get_template_part('template-parts/navigation'); ?>

    <ul class="md-hero-slider">
        <?php
        if (have_posts()):
            while (have_posts()):
                the_post();
                the_content();
            endwhile;
        endif;
        ?>
    </ul>

    <?php get_template_part('template-parts/footer'); ?>

</main>

<?php get_template_part('template-parts/modal'); ?>
<?php get_template_part('template-parts/loader'); ?>

<?php get_footer(); ?>