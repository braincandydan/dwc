<footer class="site-footer">
    <div class="container">
        <div class="footer-content">
            <!-- Logo Section -->
            <div class="footer-section footer-logo">
                <div class="footer-brand">
                    <?php plumberpro_display_logo('footer'); ?>
                </div>
                <p class="footer-tagline">Professional plumbing, renovations, installation & repair services you can trust.</p>
            </div>
            
            <!-- Service Hours Section -->
            <div class="footer-section footer-hours">
                <h3 class="footer-title">Regular Service Hours</h3>
                <div class="hours-info">
                    <div class="regular-hours">
                        <p class="days">Monday - Friday</p>
                        <p class="times">07:30 AM - 04:00 PM</p>
                    </div>
                    <div class="emergency-info">
                        <p>Available for after hours and emergencies by request.</p>
                    </div>
                </div>
            </div>
            
            <!-- Contact Section -->
            <div class="footer-section footer-contact">
                <h3 class="footer-title">Get In Touch</h3>
                <div class="contact-info">
                    <div class="contact-item">
                        <span class="contact-icon">📞</span>
                        <div class="contact-details">
                            <a href="tel:<?php echo plumberpro_get_content('phone_number', '(555) 123-4567'); ?>" class="contact-link">
                                <?php echo plumberpro_get_content('phone_number', '(555) 123-4567'); ?>
                            </a>
                        </div>
                    </div>
                    <div class="contact-item">
                        <span class="contact-icon">✉️</span>
                        <div class="contact-details">
                            <a href="mailto:<?php echo plumberpro_get_content('email', 'info@driftwellcontracting.com'); ?>" class="contact-link">
                                <?php echo plumberpro_get_content('email', 'info@driftwellcontracting.com'); ?>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="contact-blurb">
                    <p>If you have any questions, feel free to call us.</p>
                </div>
            </div>
        </div>
        
        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <div class="footer-copyright">
                <p>&copy; <?php echo date('Y'); ?> Driftwell Contracting. All rights reserved.</p>
                <p class="footer-credentials">Licensed & Insured Plumbing Services</p>
            </div>
            <div class="footer-emergency">
                <p class="emergency-text">
                    <span class="emergency-label">24/7 Emergency Service:</span>
                    <a href="tel:<?php echo plumberpro_get_content('phone_number', '(555) 123-4567'); ?>" class="emergency-phone">
                        <?php echo plumberpro_get_content('phone_number', '(555) 123-4567'); ?>
                    </a>
                </p>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
