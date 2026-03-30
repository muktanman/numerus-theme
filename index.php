<?php
/**
 * Fallback template — redirects to front page if no blog is configured.
 */
get_header();
?>
<main class="main">
    <div class="container" style="padding: 4rem 0;">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <h1><?php the_title(); ?></h1>
            <?php the_content(); ?>
        <?php endwhile; else: ?>
            <p>No content found.</p>
        <?php endif; ?>
    </div>
</main>
<?php get_footer(); ?>
