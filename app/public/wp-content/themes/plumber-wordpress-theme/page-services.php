<?php get_header(); ?>

<main class="main-content">
    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <div class="page-header-content">
                <h1 class="page-title">Our Services</h1>
                <p class="page-subtitle">Advanced plumbing solutions powered by cutting-edge technology and expert craftsmanship</p>
            </div>
        </div>
    </section>

    <!-- Services Content -->
    <section class="services-page">
        <div class="container">
            <div class="services-intro">
                <p>We offer comprehensive plumbing services that combine traditional expertise with modern technology. From emergency repairs to complete system installations, our certified technicians deliver solutions that are built to last.</p>
            </div>

            <?php 
            $services = plumberpro_get_services();
            if ($services) :
                foreach ($services as $service) :
                    $icon = get_post_meta($service->ID, '_service_icon', true);
                    $short_desc = get_post_meta($service->ID, '_service_short_description', true);
                    $price_range = get_post_meta($service->ID, '_service_price_range', true);
                    $content = apply_filters('the_content', $service->post_content);
            ?>
            <div class="service-detail-card">
                <div class="service-detail-header">
                    <div class="service-detail-icon"><?php echo $icon ? $icon : '🔧'; ?></div>
                    <div>
                        <h2 class="service-detail-title"><?php echo get_the_title($service); ?></h2>
                        <?php if ($price_range) : ?>
                            <div class="service-detail-price"><?php echo esc_html($price_range); ?></div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="service-description">
                    <p style="font-size: 1.1rem; color: #868686; margin-bottom: 2rem; line-height: 1.7;">
                        <?php echo $short_desc ? $short_desc : wp_trim_words($content, 30); ?>
                    </p>
                </div>

                <div class="service-features">
                    <div class="service-feature">
                        <div class="service-feature-icon">⚡</div>
                        <div>
                            <strong>Fast Response</strong><br>
                            <span style="color: #868686;">Quick diagnosis and repair</span>
                        </div>
                    </div>
                    <div class="service-feature">
                        <div class="service-feature-icon">🛡️</div>
                        <div>
                            <strong>Guaranteed Work</strong><br>
                            <span style="color: #868686;">Warranty on all services</span>
                        </div>
                    </div>
                    <div class="service-feature">
                        <div class="service-feature-icon">💰</div>
                        <div>
                            <strong>Transparent Pricing</strong><br>
                            <span style="color: #868686;">No hidden fees</span>
                        </div>
                    </div>
                    <div class="service-feature">
                        <div class="service-feature-icon">🔧</div>
                        <div>
                            <strong>Expert Technicians</strong><br>
                            <span style="color: #868686;">Licensed & insured</span>
                        </div>
                    </div>
                </div>

                <?php if ($content && strlen(strip_tags($content)) > 200) : ?>
                <div class="service-full-content" style="margin-top: 2rem; padding-top: 2rem; border-top: 1px solid rgba(41, 209, 209, 0.2);">
                    <?php echo $content; ?>
                </div>
                <?php endif; ?>

                <div style="text-align: center; margin-top: 2rem;">
                    <a href="#contact" class="btn btn-primary">Get Quote for This Service</a>
                </div>
            </div>
            <?php 
                endforeach;
            else :
                // Fallback content if no services are created
            ?>
            <div class="service-detail-card">
                <div class="service-detail-header">
                    <div class="service-detail-icon">🔧</div>
                    <div>
                        <h2 class="service-detail-title">Emergency Repairs</h2>
                        <div class="service-detail-price">$150 - $500</div>
                    </div>
                </div>
                <div class="service-description">
                    <p style="font-size: 1.1rem; color: #868686; margin-bottom: 2rem; line-height: 1.7;">
                        24/7 emergency plumbing services with smart diagnostic tools for rapid problem identification and resolution.
                    </p>
                </div>
                <div class="service-features">
                    <div class="service-feature">
                        <div class="service-feature-icon">⚡</div>
                        <div><strong>24/7 Availability</strong><br><span style="color: #868686;">Always ready to help</span></div>
                    </div>
                    <div class="service-feature">
                        <div class="service-feature-icon">🚨</div>
                        <div><strong>Rapid Response</strong><br><span style="color: #868686;">30-minute arrival time</span></div>
                    </div>
                    <div class="service-feature">
                        <div class="service-feature-icon">🔍</div>
                        <div><strong>Smart Diagnostics</strong><br><span style="color: #868686;">Advanced leak detection</span></div>
                    </div>
                    <div class="service-feature">
                        <div class="service-feature-icon">💯</div>
                        <div><strong>Quality Guarantee</strong><br><span style="color: #868686;">Satisfaction assured</span></div>
                    </div>
                </div>
            </div>

            <div class="service-detail-card">
                <div class="service-detail-header">
                    <div class="service-detail-icon">🚿</div>
                    <div>
                        <h2 class="service-detail-title">Smart Bathroom Systems</h2>
                        <div class="service-detail-price">$800 - $3,500</div>
                    </div>
                </div>
                <div class="service-description">
                    <p style="font-size: 1.1rem; color: #868686; margin-bottom: 2rem; line-height: 1.7;">
                        Complete bathroom installations with IoT fixtures, automated water management, and energy-efficient systems.
                    </p>
                </div>
                <div class="service-features">
                    <div class="service-feature">
                        <div class="service-feature-icon">🏠</div>
                        <div><strong>Smart Integration</strong><br><span style="color: #868686;">IoT-enabled fixtures</span></div>
                    </div>
                    <div class="service-feature">
                        <div class="service-feature-icon">💧</div>
                        <div><strong>Water Efficiency</strong><br><span style="color: #868686;">Eco-friendly solutions</span></div>
                    </div>
                    <div class="service-feature">
                        <div class="service-feature-icon">📱</div>
                        <div><strong>App Control</strong><br><span style="color: #868686;">Remote monitoring</span></div>
                    </div>
                    <div class="service-feature">
                        <div class="service-feature-icon">⭐</div>
                        <div><strong>Premium Quality</strong><br><span style="color: #868686;">Top-tier materials</span></div>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <!-- Call to Action -->
            <div style="text-align: center; margin-top: 4rem; padding: 3rem; background: linear-gradient(135deg, #29d1d1, #1fb8b8); border-radius: 20px; color: white;">
                <h2 style="font-size: 2.5rem; margin-bottom: 1rem; letter-spacing: 2px;">Ready to Upgrade Your Plumbing?</h2>
                <p style="font-size: 1.2rem; margin-bottom: 2rem; opacity: 0.9;">Get a free consultation and discover how our advanced plumbing solutions can improve your home or business.</p>
                <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                    <a href="/contact" class="btn btn-secondary" style="background: rgba(255, 255, 255, 0.2); border: 2px solid white;">Schedule Consultation</a>
                    <a href="tel:<?php echo get_theme_mod('phone_number', '(555) 123-4567'); ?>" class="btn btn-secondary" style="background: rgba(255, 255, 255, 0.2); border: 2px solid white;">Call Now</a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
