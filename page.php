<?php
/**
 * Default page template — renders WP page content.
 */
get_header();
?>
<main class="main">
    <div class="container" style="padding: 4rem 0;">
        <?php while ( have_posts() ) : the_post(); ?>
            <h1><?php the_title(); ?></h1>
            <div class="entry-content">
                <?php the_content(); ?>
            </div>
        <?php endwhile; ?>
    </div>
</main>
<?php get_footer(); ?>
