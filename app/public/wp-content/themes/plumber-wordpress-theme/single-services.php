<?php get_header(); ?>

<main class="main-content">
    <div class="container" style="padding: 4rem 0;">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <article class="service-single">
                    <header class="service-header" style="text-align: center; margin-bottom: 3rem;">
                        <?php 
                        $icon = get_post_meta(get_the_ID(), '_service_icon', true);
                        if ($icon) :
                        ?>
                        <div class="service-icon" style="font-size: 4rem; margin-bottom: 1rem; background: linear-gradient(45deg, #29d1d1, #c7d3e4); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                            <?php echo $icon; ?>
                        </div>
                        <?php endif; ?>
                        
                        <h1 class="service-title" style="font-size: 3rem; color: #171717; margin-bottom: 1rem;"><?php the_title(); ?></h1>
                        
                        <?php 
                        $price_range = get_post_meta(get_the_ID(), '_service_price_range', true);
                        if ($price_range) :
                        ?>
                        <div class="service-price" style="font-size: 1.5rem; color: #29d1d1; font-weight: 600;">
                            <?php echo esc_html($price_range); ?>
                        </div>
                        <?php endif; ?>
                    </header>
                    
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="service-image" style="margin-bottom: 3rem; text-align: center;">
                            <?php the_post_thumbnail('large', array('style' => 'border-radius: 16px; box-shadow: 0 16px 48px rgba(0, 0, 0, 0.1);')); ?>
                        </div>
                    <?php endif; ?>
                    
                    <div class="service-content" style="font-size: 1.1rem; line-height: 1.8; color: #171717;">
                        <?php the_content(); ?>
                    </div>
                    
                    <div class="service-cta" style="margin-top: 3rem; text-align: center; padding: 2rem; background: linear-gradient(135deg, #29d1d1, #1fb8b8); border-radius: 16px;">
                        <h3 style="color: white; margin-bottom: 1rem;">Ready to get started?</h3>
                        <a href="#contact" class="btn btn-secondary" style="background: rgba(255, 255, 255, 0.2); color: white; border: 2px solid white;">Get Free Quote</a>
                    </div>
                </article>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>
