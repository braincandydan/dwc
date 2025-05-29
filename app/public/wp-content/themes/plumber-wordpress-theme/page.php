<?php get_header(); ?>

<main class="main-content">
    <div class="container" style="padding: 2rem 0;">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <article class="page-content">
                    <header class="page-header">
                        <h1 class="page-title"><?php the_title(); ?></h1>
                    </header>
                    
                    <div class="page-content">
                        <?php the_content(); ?>
                    </div>
                </article>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>
