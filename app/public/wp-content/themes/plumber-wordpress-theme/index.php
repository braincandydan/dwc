<?php get_header(); ?>

<main class="main-content">
    <!-- Hero Section -->
    <section class="hero" <?php 
        $hero_bg = get_theme_mod('hero_background_image');
        if ($hero_bg) {
            echo 'style="background-image: linear-gradient(135deg, rgba(23, 23, 23, 0.9) 0%, rgba(42, 42, 42, 0.8) 100%), url(' . esc_url($hero_bg) . ');"';
        }
    ?>>
        <div class="container">
            <div class="hero-content">
                <h1><?php echo plumberpro_get_content('hero_title', 'Next-Gen Plumbing Solutions'); ?></h1>
                <p><?php echo plumberpro_get_content('hero_subtitle', 'Advanced plumbing technology meets expert craftsmanship. Smart solutions for modern homes and businesses.'); ?></p>
                <div class="hero-buttons">
                    <a href="<?php echo plumberpro_get_content('hero_primary_button_link', '#contact'); ?>" class="btn btn-primary"><?php echo plumberpro_get_content('hero_primary_button_text', 'Get Smart Quote'); ?></a>
                    <a href="tel:<?php echo plumberpro_get_content('phone_number', '(555) 123-4567'); ?>" class="btn btn-secondary"><?php echo plumberpro_get_content('hero_secondary_button_text', 'Emergency Call'); ?></a>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services" id="services">
        <div class="container">
            <h2 class="section-title">Our Advanced Services</h2>
            <div class="services-grid">
                <?php 
                $services = plumberpro_get_services();
                if ($services) :
                    foreach ($services as $service) :
                        $icon = get_post_meta($service->ID, '_service_icon', true);
                        $short_desc = get_post_meta($service->ID, '_service_short_description', true);
                        $price_range = get_post_meta($service->ID, '_service_price_range', true);
                ?>
                <div class="service-card">
                    <div class="service-icon"><?php echo $icon ? $icon : '🔧'; ?></div>
                    <h3><?php echo get_the_title($service); ?></h3>
                    <p><?php echo $short_desc ? $short_desc : get_the_excerpt($service); ?></p>
                    <?php if ($price_range) : ?>
                        <div class="service-price" style="margin-top: 1rem; font-weight: 600; color: #29d1d1;">
                            <?php echo esc_html($price_range); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <?php 
                    endforeach;
                else :
                    // Fallback services if none are created yet
                ?>
                <div class="service-card">
                    <div class="service-icon">🔧</div>
                    <h3>Emergency Repairs</h3>
                    <p>24/7 emergency plumbing services with smart diagnostic tools for rapid problem identification.</p>
                </div>
                <div class="service-card">
                    <div class="service-icon">🚿</div>
                    <h3>Smart Bathroom Systems</h3>
                    <p>High-tech bathroom installations with IoT fixtures and automated water management.</p>
                </div>
                <div class="service-card">
                    <div class="service-icon">🏠</div>
                    <h3>Kitchen Tech Integration</h3>
                    <p>Modern kitchen plumbing with smart appliance connections and water filtration systems.</p>
                </div>
                <div class="service-card">
                    <div class="service-icon">🔥</div>
                    <h3>Smart Water Heaters</h3>
                    <p>Energy-efficient tankless systems with remote monitoring and temperature control.</p>
                </div>
                <div class="service-card">
                    <div class="service-icon">🚰</div>
                    <h3>Hydro-Jetting</h3>
                    <p>Advanced drain cleaning using high-pressure water technology for complete blockage removal.</p>
                </div>
                <div class="service-card">
                    <div class="service-icon">💧</div>
                    <h3>Leak Detection Tech</h3>
                    <p>Cutting-edge leak detection using thermal imaging and acoustic sensors.</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about" id="about">
        <div class="container">
            <div class="about-content">
                <div class="about-text">
                    <h2><?php echo plumberpro_get_content('about_title', 'The Future of Plumbing'); ?></h2>
                    <p><?php echo plumberpro_get_content('about_paragraph_1', 'We combine traditional craftsmanship with cutting-edge technology to deliver plumbing solutions that are smarter, more efficient, and built for the future.'); ?></p>
                    <p><?php echo plumberpro_get_content('about_paragraph_2', 'Our team of certified technicians uses advanced diagnostic tools, IoT-enabled fixtures, and sustainable practices to ensure your plumbing system operates at peak performance.'); ?></p>
                    <ul>
                        <?php 
                        $features = array(
                            plumberpro_get_content('about_feature_1', '✓ Licensed & Insured Professionals'),
                            plumberpro_get_content('about_feature_2', '✓ 24/7 Smart Monitoring Available'),
                            plumberpro_get_content('about_feature_3', '✓ Transparent Digital Pricing'),
                            plumberpro_get_content('about_feature_4', '✓ Lifetime Warranty on Premium Services'),
                            plumberpro_get_content('about_feature_5', '✓ Eco-Friendly Solutions')
                        );
                        foreach ($features as $feature) :
                            if (!empty($feature)) :
                        ?>
                        <li><?php echo esc_html($feature); ?></li>
                        <?php 
                            endif;
                        endforeach; 
                        ?>
                    </ul>
                </div>
                <div class="about-image">
                    <?php 
                    $about_image = plumberpro_get_content('about_image');
                    if ($about_image) :
                    ?>
                    <img src="<?php echo esc_url($about_image); ?>" alt="<?php echo esc_attr(plumberpro_get_content('about_title', 'About Us')); ?>">
                    <?php else : ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/images/tech-plumber.jpg" alt="Advanced Plumbing Technology">
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact" id="contact">
        <div class="container">
            <h2 class="section-title"><?php echo plumberpro_get_content('contact_section_title', 'Connect With Us'); ?></h2>
            <div class="contact-content">
                <div class="contact-info">
                    <h3><?php echo plumberpro_get_content('contact_info_title', 'Get In Touch'); ?></h3>
                    <div class="contact-item">
                        <i>📞</i>
                        <span><?php echo plumberpro_get_content('phone_number', '(555) 123-4567'); ?></span>
                    </div>
                    <div class="contact-item">
                        <i>✉️</i>
                        <span><?php echo plumberpro_get_content('email', 'info@plumberpro.com'); ?></span>
                    </div>
                    <div class="contact-item">
                        <i>📍</i>
                        <span><?php echo plumberpro_get_content('address', '123 Tech Boulevard, Smart City, ST 12345'); ?></span>
                    </div>
                    <div class="contact-item">
                        <i>🕒</i>
                        <span><?php echo plumberpro_get_content('business_hours', 'Mon-Fri: 7AM-6PM | Emergency: 24/7'); ?></span>
                    </div>
                </div>
                <div class="contact-form">
                    <h3><?php echo plumberpro_get_content('contact_form_title', 'Request Smart Quote'); ?></h3>
                    <form method="post" action="">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" required placeholder="Your Name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" required placeholder="your@email.com">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="tel" id="phone" name="phone" placeholder="(555) 123-4567">
                        </div>
                        <div class="form-group">
                            <label for="service">Service Needed</label>
                            <select id="service" name="service" style="width: 100%; padding: 1rem; border: 1px solid rgba(255, 255, 255, 0.3); border-radius: 8px; background: rgba(255, 255, 255, 0.1); color: white;">
                                <option value="">Select a service</option>
                                <?php 
                                $services = plumberpro_get_services();
                                if ($services) :
                                    foreach ($services as $service) :
                                ?>
                                <option value="<?php echo esc_attr(get_the_title($service)); ?>"><?php echo get_the_title($service); ?></option>
                                <?php 
                                    endforeach;
                                endif;
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea id="message" name="message" placeholder="Describe your plumbing needs..."></textarea>
                        </div>
                        <button type="submit" class="form-submit">Send Request</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
