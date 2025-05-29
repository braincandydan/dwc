<?php get_header(); ?>

<main class="main-content">
    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <div class="page-header-content">
                <h1 class="page-title">Contact Us</h1>
                <p class="page-subtitle">Get in touch with our expert team for all your plumbing needs</p>
            </div>
        </div>
    </section>

    <!-- Emergency Banner -->
    <section style="padding: 2rem 0;">
        <div class="container">
            <div class="emergency-banner">
                <h3>Emergency Plumbing Service</h3>
                <a href="tel:<?php echo get_theme_mod('phone_number', '(555) 123-4567'); ?>" class="emergency-phone">
                    <?php echo get_theme_mod('phone_number', '(555) 123-4567'); ?>
                </a>
                <p style="margin: 0.5rem 0 0; opacity: 0.9;">Available 24/7 for urgent repairs</p>
            </div>
        </div>
    </section>

    <!-- Contact Methods -->
    <section class="contact-page">
        <div class="container">
            <div class="contact-methods">
                <div class="contact-method">
                    <div class="contact-method-icon">📞</div>
                    <h3>Call Us</h3>
                    <p>Speak directly with our expert team for immediate assistance and scheduling.</p>
                    <a href="tel:<?php echo get_theme_mod('phone_number', '(555) 123-4567'); ?>" class="contact-method-link">
                        <?php echo get_theme_mod('phone_number', '(555) 123-4567'); ?>
                    </a>
                </div>

                <div class="contact-method">
                    <div class="contact-method-icon">✉️</div>
                    <h3>Email Us</h3>
                    <p>Send us your questions or project details for a detailed response within 24 hours.</p>
                    <a href="mailto:<?php echo get_theme_mod('email', 'info@plumberpro.com'); ?>" class="contact-method-link">
                        <?php echo get_theme_mod('email', 'info@plumberpro.com'); ?>
                    </a>
                </div>

                <div class="contact-method">
                    <div class="contact-method-icon">📍</div>
                    <h3>Visit Us</h3>
                    <p>Stop by our office to discuss your plumbing needs in person with our team.</p>
                    <a href="https://maps.google.com/?q=<?php echo urlencode(get_theme_mod('address', '123 Tech Boulevard, Smart City, ST 12345')); ?>" class="contact-method-link" target="_blank">
                        Get Directions
                    </a>
                    <p style="margin-top: 1rem; font-size: 0.9rem; color: #868686;">
                        <?php echo get_theme_mod('address', '123 Tech Boulevard, Smart City, ST 12345'); ?>
                    </p>
                </div>

                <div class="contact-method">
                    <div class="contact-method-icon">💬</div>
                    <h3>Live Chat</h3>
                    <p>Chat with our support team in real-time for quick answers to your questions.</p>
                    <a href="#" class="contact-method-link" onclick="alert('Live chat feature coming soon!')">
                        Start Chat
                    </a>
                </div>
            </div>

            <!-- Business Hours -->
            <div class="business-hours">
                <h3>Business Hours</h3>
                <ul class="hours-list">
                    <li>
                        <span class="day">Monday - Friday</span>
                        <span class="time">7:00 AM - 6:00 PM</span>
                    </li>
                    <li>
                        <span class="day">Saturday</span>
                        <span class="time">8:00 AM - 4:00 PM</span>
                    </li>
                    <li>
                        <span class="day">Sunday</span>
                        <span class="time">Emergency Only</span>
                    </li>
                    <li>
                        <span class="day">Emergency Service</span>
                        <span class="time emergency-time">24/7 Available</span>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Contact Form Section -->
    <section class="contact-form-section">
        <div class="container">
            <div class="contact-form-content">
                <h2 class="contact-form-title">Send Us a Message</h2>
                
                <form method="post" action="" style="max-width: 100%;">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.5rem;">
                        <div class="form-group">
                            <label for="first_name">First Name *</label>
                            <input type="text" id="first_name" name="first_name" required placeholder="John">
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name *</label>
                            <input type="text" id="last_name" name="last_name" required placeholder="Doe">
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.5rem;">
                        <div class="form-group">
                            <label for="email">Email Address *</label>
                            <input type="email" id="email" name="email" required placeholder="john@example.com">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" id="phone" name="phone" placeholder="(555) 123-4567">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="service_type">Service Type</label>
                        <select id="service_type" name="service_type" style="width: 100%; padding: 1rem; border: 1px solid rgba(255, 255, 255, 0.3); border-radius: 8px; background: rgba(255, 255, 255, 0.1); color: white; font-size: 1rem;">
                            <option value="">Select a service</option>
                            <option value="emergency">Emergency Repair</option>
                            <option value="installation">New Installation</option>
                            <option value="maintenance">Maintenance</option>
                            <option value="inspection">Inspection</option>
                            <option value="consultation">Consultation</option>
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
                        <label for="property_type">Property Type</label>
                        <select id="property_type" name="property_type" style="width: 100%; padding: 1rem; border: 1px solid rgba(255, 255, 255, 0.3); border-radius: 8px; background: rgba(255, 255, 255, 0.1); color: white; font-size: 1rem;">
                            <option value="">Select property type</option>
                            <option value="residential">Residential Home</option>
                            <option value="apartment">Apartment/Condo</option>
                            <option value="commercial">Commercial Building</option>
                            <option value="industrial">Industrial Facility</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="urgency">Urgency Level</label>
                        <select id="urgency" name="urgency" style="width: 100%; padding: 1rem; border: 1px solid rgba(255, 255, 255, 0.3); border-radius: 8px; background: rgba(255, 255, 255, 0.1); color: white; font-size: 1rem;">
                            <option value="normal">Normal - Within a few days</option>
                            <option value="urgent">Urgent - Within 24 hours</option>
                            <option value="emergency">Emergency - Immediate attention</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="message">Describe Your Plumbing Issue *</label>
                        <textarea id="message" name="message" required placeholder="Please describe your plumbing needs, including any symptoms, location of the problem, and when it started..." style="height: 150px;"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="preferred_contact">Preferred Contact Method</label>
                        <div style="display: flex; gap: 2rem; margin-top: 0.5rem;">
                            <label style="display: flex; align-items: center; cursor: pointer;">
                                <input type="radio" name="preferred_contact" value="phone" style="margin-right: 0.5rem;">
                                Phone Call
                            </label>
                            <label style="display: flex; align-items: center; cursor: pointer;">
                                <input type="radio" name="preferred_contact" value="email" checked style="margin-right: 0.5rem;">
                                Email
                            </label>
                            <label style="display: flex; align-items: center; cursor: pointer;">
                                <input type="radio" name="preferred_contact" value="text" style="margin-right: 0.5rem;">
                                Text Message
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="form-submit" style="width: 100%; font-size: 1.1rem; padding: 1.2rem;">
                        Send Message
                    </button>

                    <p style="text-align: center; margin-top: 1rem; font-size: 0.9rem; opacity: 0.8;">
                        We'll respond to your message within 2 hours during business hours.
                    </p>
                </form>
            </div>
        </div>
    </section>

    <!-- Service Areas -->
    <section style="padding: 4rem 0; background: #f8fafc;">
        <div class="container">
            <h2 style="text-align: center; font-size: 3rem; margin-bottom: 2rem; color: #171717; letter-spacing: 2px;">Service Areas</h2>
            <p style="text-align: center; font-size: 1.2rem; color: #868686; margin-bottom: 3rem; max-width: 600px; margin-left: auto; margin-right: auto;">
                We proudly serve the following areas with our professional plumbing services:
            </p>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; text-align: center;">
                <div style="padding: 1.5rem; background: white; border-radius: 10px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);">
                    <h4 style="color: #29d1d1; margin-bottom: 0.5rem; font-size: 1.3rem; letter-spacing: 1px;">Downtown Area</h4>
                    <p style="color: #868686;">Central business district and surrounding neighborhoods</p>
                </div>
                <div style="padding: 1.5rem; background: white; border-radius: 10px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);">
                    <h4 style="color: #29d1d1; margin-bottom: 0.5rem; font-size: 1.3rem; letter-spacing: 1px;">Residential Districts</h4>
                    <p style="color: #868686;">All major residential areas and suburbs</p>
                </div>
                <div style="padding: 1.5rem; background: white; border-radius: 10px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);">
                    <h4 style="color: #29d1d1; margin-bottom: 0.5rem; font-size: 1.3rem; letter-spacing: 1px;">Industrial Zone</h4>
                    <p style="color: #868686;">Commercial and industrial facilities</p>
                </div>
                <div style="padding: 1.5rem; background: white; border-radius: 10px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);">
                    <h4 style="color: #29d1d1; margin-bottom: 0.5rem; font-size: 1.3rem; letter-spacing: 1px;">Surrounding Cities</h4>
                    <p style="color: #868686;">Extended service area within 50 miles</p>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
