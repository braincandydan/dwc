<?php
// Theme setup
function plumberpro_setup() {
    // Add theme support
    add_theme_support('title-tag');
    add_theme_support('custom-logo');
    add_theme_support('post_thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    
    // Register navigation menu
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'plumberpro'),
    ));
    
    // Initialize logo settings if not set
    if (empty(get_theme_mod('logo_type'))) {
        set_theme_mod('logo_type', 'builtin_white');
    }
}
add_action('after_setup_theme', 'plumberpro_setup');

// Enqueue styles and scripts
function plumberpro_scripts() {
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@400;500;600;700&display=swap');
    wp_enqueue_style('plumberpro-style', get_stylesheet_uri());
    wp_enqueue_script('plumberpro-script', get_template_directory_uri() . '/js/main.js', array('jquery'), '2.0.0', true);
}
add_action('wp_enqueue_scripts', 'plumberpro_scripts');

// Custom post type for services
function plumberpro_services_post_type() {
    register_post_type('services', array(
        'labels' => array(
            'name' => __('Services'),
            'singular_name' => __('Service'),
            'add_new' => __('Add New Service'),
            'add_new_item' => __('Add New Service'),
            'edit_item' => __('Edit Service'),
            'new_item' => __('New Service'),
            'view_item' => __('View Service'),
            'search_items' => __('Search Services'),
            'not_found' => __('No services found'),
            'not_found_in_trash' => __('No services found in trash'),
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_icon' => 'dashicons-admin-tools',
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'services'),
    ));
}
add_action('init', 'plumberpro_services_post_type');

// Add meta boxes for services
function plumberpro_add_service_meta_boxes() {
    add_meta_box(
        'service_details',
        'Service Details',
        'plumberpro_service_meta_box_callback',
        'services',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'plumberpro_add_service_meta_boxes');

// Service meta box callback
function plumberpro_service_meta_box_callback($post) {
    wp_nonce_field('plumberpro_save_service_meta', 'plumberpro_service_meta_nonce');
    
    $icon = get_post_meta($post->ID, '_service_icon', true);
    $short_description = get_post_meta($post->ID, '_service_short_description', true);
    $price_range = get_post_meta($post->ID, '_service_price_range', true);
    
    echo '<div class="service-meta-box">';
    
    echo '<div class="service-meta-field">';
    echo '<label for="service_icon">Service Icon (Emoji or Unicode):</label>';
    echo '<input type="text" id="service_icon" name="service_icon" value="' . esc_attr($icon) . '" placeholder="🔧" />';
    echo '</div>';
    
    echo '<div class="service-meta-field">';
    echo '<label for="service_short_description">Short Description:</label>';
    echo '<textarea id="service_short_description" name="service_short_description" rows="3" placeholder="Brief description for the service card...">' . esc_textarea($short_description) . '</textarea>';
    echo '</div>';
    
    echo '<div class="service-meta-field">';
    echo '<label for="service_price_range">Price Range (optional):</label>';
    echo '<input type="text" id="service_price_range" name="service_price_range" value="' . esc_attr($price_range) . '" placeholder="$100 - $500" />';
    echo '</div>';
    
    echo '</div>';
}

// Save service meta data
function plumberpro_save_service_meta($post_id) {
    if (!isset($_POST['plumberpro_service_meta_nonce']) || !wp_verify_nonce($_POST['plumberpro_service_meta_nonce'], 'plumberpro_save_service_meta')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    if (isset($_POST['service_icon'])) {
        update_post_meta($post_id, '_service_icon', sanitize_text_field($_POST['service_icon']));
    }
    
    if (isset($_POST['service_short_description'])) {
        update_post_meta($post_id, '_service_short_description', sanitize_textarea_field($_POST['service_short_description']));
    }
    
    if (isset($_POST['service_price_range'])) {
        update_post_meta($post_id, '_service_price_range', sanitize_text_field($_POST['service_price_range']));
    }
}
add_action('save_post', 'plumberpro_save_service_meta');

// Customizer settings
function plumberpro_customize_register($wp_customize) {
    // Hero Section
    $wp_customize->add_section('hero_section', array(
        'title' => __('Hero Section', 'plumberpro'),
        'priority' => 30,
        'description' => __('Customize the hero section content and appearance', 'plumberpro'),
    ));
    
    $wp_customize->add_setting('hero_title', array(
        'default' => 'Next-Gen Plumbing Solutions',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('hero_title', array(
        'label' => __('Hero Title', 'plumberpro'),
        'section' => 'hero_section',
        'type' => 'text',
    ));
    
    $wp_customize->add_setting('hero_subtitle', array(
        'default' => 'Advanced plumbing technology meets expert craftsmanship. Smart solutions for modern homes and businesses.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    
    $wp_customize->add_control('hero_subtitle', array(
        'label' => __('Hero Subtitle', 'plumberpro'),
        'section' => 'hero_section',
        'type' => 'textarea',
    ));
    
    // Hero buttons
    $wp_customize->add_setting('hero_primary_button_text', array(
        'default' => 'Get Smart Quote',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('hero_primary_button_text', array(
        'label' => __('Primary Button Text', 'plumberpro'),
        'section' => 'hero_section',
        'type' => 'text',
    ));
    
    $wp_customize->add_setting('hero_primary_button_link', array(
        'default' => '#contact',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('hero_primary_button_link', array(
        'label' => __('Primary Button Link', 'plumberpro'),
        'section' => 'hero_section',
        'type' => 'text',
    ));
    
    $wp_customize->add_setting('hero_secondary_button_text', array(
        'default' => 'Emergency Call',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('hero_secondary_button_text', array(
        'label' => __('Secondary Button Text', 'plumberpro'),
        'section' => 'hero_section',
        'type' => 'text',
    ));
    
    // Hero Background Image
    $wp_customize->add_setting('hero_background_image', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'hero_background_image', array(
        'label' => __('Hero Background Image', 'plumberpro'),
        'section' => 'hero_section',
        'settings' => 'hero_background_image',
    )));
    
    // About Section
    $wp_customize->add_section('about_section', array(
        'title' => __('About Section', 'plumberpro'),
        'priority' => 32,
        'description' => __('Customize the about section content', 'plumberpro'),
    ));
    
    $wp_customize->add_setting('about_title', array(
        'default' => 'The Future of Plumbing',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('about_title', array(
        'label' => __('About Section Title', 'plumberpro'),
        'section' => 'about_section',
        'type' => 'text',
    ));
    
    $wp_customize->add_setting('about_paragraph_1', array(
        'default' => 'We combine traditional craftsmanship with cutting-edge technology to deliver plumbing solutions that are smarter, more efficient, and built for the future.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    
    $wp_customize->add_control('about_paragraph_1', array(
        'label' => __('First Paragraph', 'plumberpro'),
        'section' => 'about_section',
        'type' => 'textarea',
    ));
    
    $wp_customize->add_setting('about_paragraph_2', array(
        'default' => 'Our team of certified technicians uses advanced diagnostic tools, IoT-enabled fixtures, and sustainable practices to ensure your plumbing system operates at peak performance.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    
    $wp_customize->add_control('about_paragraph_2', array(
        'label' => __('Second Paragraph', 'plumberpro'),
        'section' => 'about_section',
        'type' => 'textarea',
    ));
    
    // About features list
    $wp_customize->add_setting('about_feature_1', array(
        'default' => '✓ Licensed & Insured Professionals',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('about_feature_1', array(
        'label' => __('Feature 1', 'plumberpro'),
        'section' => 'about_section',
        'type' => 'text',
    ));
    
    $wp_customize->add_setting('about_feature_2', array(
        'default' => '✓ 24/7 Smart Monitoring Available',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('about_feature_2', array(
        'label' => __('Feature 2', 'plumberpro'),
        'section' => 'about_section',
        'type' => 'text',
    ));
    
    $wp_customize->add_setting('about_feature_3', array(
        'default' => '✓ Transparent Digital Pricing',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('about_feature_3', array(
        'label' => __('Feature 3', 'plumberpro'),
        'section' => 'about_section',
        'type' => 'text',
    ));
    
    $wp_customize->add_setting('about_feature_4', array(
        'default' => '✓ Lifetime Warranty on Premium Services',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('about_feature_4', array(
        'label' => __('Feature 4', 'plumberpro'),
        'section' => 'about_section',
        'type' => 'text',
    ));
    
    $wp_customize->add_setting('about_feature_5', array(
        'default' => '✓ Eco-Friendly Solutions',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('about_feature_5', array(
        'label' => __('Feature 5', 'plumberpro'),
        'section' => 'about_section',
        'type' => 'text',
    ));
    
    // About image
    $wp_customize->add_setting('about_image', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'about_image', array(
        'label' => __('About Section Image', 'plumberpro'),
        'section' => 'about_section',
        'settings' => 'about_image',
    )));
    
    // Contact Information Section
    $wp_customize->add_section('contact_info', array(
        'title' => __('Contact Information', 'plumberpro'),
        'priority' => 35,
        'description' => __('Customize contact details and information', 'plumberpro'),
    ));
    
    $wp_customize->add_setting('contact_section_title', array(
        'default' => 'Connect With Us',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('contact_section_title', array(
        'label' => __('Contact Section Title', 'plumberpro'),
        'section' => 'contact_info',
        'type' => 'text',
    ));
    
    $wp_customize->add_setting('contact_info_title', array(
        'default' => 'Get In Touch',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('contact_info_title', array(
        'label' => __('Contact Info Subtitle', 'plumberpro'),
        'section' => 'contact_info',
        'type' => 'text',
    ));
    
    $wp_customize->add_setting('phone_number', array(
        'default' => '(555) 123-4567',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('phone_number', array(
        'label' => __('Phone Number', 'plumberpro'),
        'section' => 'contact_info',
        'type' => 'text',
    ));
    
    $wp_customize->add_setting('email', array(
        'default' => 'info@plumberpro.com',
        'sanitize_callback' => 'sanitize_email',
    ));
    
    $wp_customize->add_control('email', array(
        'label' => __('Email Address', 'plumberpro'),
        'section' => 'contact_info',
        'type' => 'email',
    ));
    
    $wp_customize->add_setting('address', array(
        'default' => '123 Tech Boulevard, Smart City, ST 12345',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('address', array(
        'label' => __('Business Address', 'plumberpro'),
        'section' => 'contact_info',
        'type' => 'text',
    ));
    
    $wp_customize->add_setting('business_hours', array(
        'default' => 'Mon-Fri: 7AM-6PM | Emergency: 24/7',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('business_hours', array(
        'label' => __('Business Hours', 'plumberpro'),
        'section' => 'contact_info',
        'type' => 'text',
    ));
    
    // Contact form section
    $wp_customize->add_setting('contact_form_title', array(
        'default' => 'Request Smart Quote',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('contact_form_title', array(
        'label' => __('Contact Form Title', 'plumberpro'),
        'section' => 'contact_info',
        'type' => 'text',
    ));
}
add_action('customize_register', 'plumberpro_customize_register');

// Widget areas
function plumberpro_widgets_init() {
    register_sidebar(array(
        'name' => __('Sidebar', 'plumberpro'),
        'id' => 'sidebar-1',
        'description' => __('Add widgets here.', 'plumberpro'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
}
add_action('widgets_init', 'plumberpro_widgets_init');

// Custom post type for testimonials
function plumberpro_testimonials_post_type() {
    register_post_type('testimonials', array(
        'labels' => array(
            'name' => __('Testimonials'),
            'singular_name' => __('Testimonial'),
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_icon' => 'dashicons-format-quote',
    ));
}
add_action('init', 'plumberpro_testimonials_post_type');

// Custom admin page for content management
function plumberpro_admin_menu() {
    add_menu_page(
        'Content Management',
        'Site Content',
        'manage_options',
        'plumberpro-content',
        'plumberpro_content_management_page',
        'dashicons-edit-page',
        25
    );
    
    // Add logo management submenu
    add_submenu_page(
        'plumberpro-content',
        'Logo Management',
        'Logo Settings',
        'manage_options',
        'plumberpro-logo',
        'plumberpro_logo_management_page'
    );
}
add_action('admin_menu', 'plumberpro_admin_menu');

// Enqueue admin styles and scripts
function plumberpro_admin_enqueue_scripts($hook) {
    if ($hook === 'toplevel_page_plumberpro-content') {
        wp_enqueue_media(); // WordPress media uploader
        wp_enqueue_style('plumberpro-admin-style', get_template_directory_uri() . '/admin-style.css');
        wp_enqueue_script('plumberpro-admin-script', get_template_directory_uri() . '/admin-script.js', array('jquery', 'media-upload', 'media-views'), '1.0.0', true);
    }
}
add_action('admin_enqueue_scripts', 'plumberpro_admin_enqueue_scripts');

// Helper function to get content values (checks both options and theme mods)
function plumberpro_get_content($key, $default = '') {
    // Try getting from WordPress options first (more reliable)
    $option_value = get_option('plumberpro_' . $key, null);
    if ($option_value !== null) {
        return $option_value;
    }
    
    // Fallback to theme mods
    return get_theme_mod($key, $default);
}

// Content management page
function plumberpro_content_management_page() {
    $success_message = '';
    $error_message = '';
    $debug_info = array();
    
    // Check for success message from redirect
    if (isset($_GET['updated']) && $_GET['updated'] == '1') {
        $transient_message = get_transient('plumberpro_success_message');
        if ($transient_message) {
            $success_message = $transient_message;
            delete_transient('plumberpro_success_message');
        }
    }
    
    // Handle form submission FIRST, before any output
    if (!empty($_POST) && isset($_POST['_wpnonce'])) {
        $debug_info[] = "Form processing triggered - POST data detected";
        
        // Check nonce for security
        if (!wp_verify_nonce($_POST['_wpnonce'], 'plumberpro_content_nonce')) {
            $error_message = 'Security check failed. Please try again.';
            $debug_info[] = "Nonce verification FAILED";
        } else {
            $debug_info[] = "Nonce verification PASSED";
            $updated_fields = array();
            
            // Test basic write capability first
            $test_option = update_option('plumberpro_test_write', current_time('mysql'));
            $debug_info[] = "Database write test: " . ($test_option ? "SUCCESS" : "FAILED");
            
            // Hero Section - Use options instead of theme mods for better reliability
            if (isset($_POST['hero_title']) && !empty($_POST['hero_title'])) {
                $hero_title = sanitize_text_field($_POST['hero_title']);
                $result1 = update_option('plumberpro_hero_title', $hero_title);
                $result2 = set_theme_mod('hero_title', $hero_title);
                $debug_info[] = "Hero title - Option: " . ($result1 ? "OK" : "FAIL") . " | Theme mod: " . ($result2 !== false ? "OK" : "FAIL");
                $updated_fields[] = 'Hero Title';
            }
            
            if (isset($_POST['hero_subtitle']) && !empty($_POST['hero_subtitle'])) {
                $hero_subtitle = sanitize_textarea_field($_POST['hero_subtitle']);
                update_option('plumberpro_hero_subtitle', $hero_subtitle);
                set_theme_mod('hero_subtitle', $hero_subtitle);
                $updated_fields[] = 'Hero Subtitle';
            }
            
            if (isset($_POST['hero_primary_button_text'])) {
                $btn_text = sanitize_text_field($_POST['hero_primary_button_text']);
                update_option('plumberpro_hero_primary_button_text', $btn_text);
                set_theme_mod('hero_primary_button_text', $btn_text);
                $updated_fields[] = 'Primary Button Text';
            }
            
            if (isset($_POST['hero_primary_button_link'])) {
                $btn_link = sanitize_text_field($_POST['hero_primary_button_link']);
                update_option('plumberpro_hero_primary_button_link', $btn_link);
                set_theme_mod('hero_primary_button_link', $btn_link);
                $updated_fields[] = 'Primary Button Link';
            }
            
            if (isset($_POST['hero_secondary_button_text'])) {
                $btn_text = sanitize_text_field($_POST['hero_secondary_button_text']);
                update_option('plumberpro_hero_secondary_button_text', $btn_text);
                set_theme_mod('hero_secondary_button_text', $btn_text);
                $updated_fields[] = 'Secondary Button Text';
            }
            
            // About Section
            if (isset($_POST['about_title'])) {
                $about_title = sanitize_text_field($_POST['about_title']);
                update_option('plumberpro_about_title', $about_title);
                set_theme_mod('about_title', $about_title);
                $updated_fields[] = 'About Title';
            }
            
            if (isset($_POST['about_paragraph_1'])) {
                $about_p1 = sanitize_textarea_field($_POST['about_paragraph_1']);
                update_option('plumberpro_about_paragraph_1', $about_p1);
                set_theme_mod('about_paragraph_1', $about_p1);
                $updated_fields[] = 'About Paragraph 1';
            }
            
            if (isset($_POST['about_paragraph_2'])) {
                $about_p2 = sanitize_textarea_field($_POST['about_paragraph_2']);
                update_option('plumberpro_about_paragraph_2', $about_p2);
                set_theme_mod('about_paragraph_2', $about_p2);
                $updated_fields[] = 'About Paragraph 2';
            }
            
            // About features
            for ($i = 1; $i <= 5; $i++) {
                if (isset($_POST["about_feature_$i"])) {
                    $feature = sanitize_text_field($_POST["about_feature_$i"]);
                    update_option("plumberpro_about_feature_$i", $feature);
                    set_theme_mod("about_feature_$i", $feature);
                    $updated_fields[] = "About Feature $i";
                }
            }
            
            // About image
            if (isset($_POST['about_image'])) {
                $about_image = esc_url_raw($_POST['about_image']);
                update_option('plumberpro_about_image', $about_image);
                set_theme_mod('about_image', $about_image);
                $updated_fields[] = 'About Image';
            }
            
            // Contact Section
            if (isset($_POST['contact_section_title'])) {
                $contact_title = sanitize_text_field($_POST['contact_section_title']);
                update_option('plumberpro_contact_section_title', $contact_title);
                set_theme_mod('contact_section_title', $contact_title);
                $updated_fields[] = 'Contact Section Title';
            }
            
            if (isset($_POST['contact_info_title'])) {
                $contact_info = sanitize_text_field($_POST['contact_info_title']);
                update_option('plumberpro_contact_info_title', $contact_info);
                set_theme_mod('contact_info_title', $contact_info);
                $updated_fields[] = 'Contact Info Title';
            }
            
            if (isset($_POST['contact_form_title'])) {
                $form_title = sanitize_text_field($_POST['contact_form_title']);
                update_option('plumberpro_contact_form_title', $form_title);
                set_theme_mod('contact_form_title', $form_title);
                $updated_fields[] = 'Contact Form Title';
            }
            
            if (isset($_POST['phone_number'])) {
                $phone = sanitize_text_field($_POST['phone_number']);
                update_option('plumberpro_phone_number', $phone);
                set_theme_mod('phone_number', $phone);
                $updated_fields[] = 'Phone Number';
            }
            
            if (isset($_POST['email'])) {
                $email = sanitize_email($_POST['email']);
                update_option('plumberpro_email', $email);
                set_theme_mod('email', $email);
                $updated_fields[] = 'Email';
            }
            
            if (isset($_POST['address'])) {
                $address = sanitize_text_field($_POST['address']);
                update_option('plumberpro_address', $address);
                set_theme_mod('address', $address);
                $updated_fields[] = 'Address';
            }
            
            if (isset($_POST['business_hours'])) {
                $hours = sanitize_text_field($_POST['business_hours']);
                update_option('plumberpro_business_hours', $hours);
                set_theme_mod('business_hours', $hours);
                $updated_fields[] = 'Business Hours';
            }
            
            $debug_info[] = "Updated fields count: " . count($updated_fields);
            $debug_info[] = "Updated fields: " . implode(', ', $updated_fields);
            
            if (!empty($updated_fields)) {
                $success_message = '<strong>Content updated successfully!</strong><br>Updated fields: ' . implode(', ', $updated_fields);
                // Set a transient to show success message after redirect
                set_transient('plumberpro_success_message', $success_message, 30);
                
                // Add a small delay and redirect
                echo '<script>setTimeout(function(){ window.location.href = "' . admin_url('admin.php?page=plumberpro-content&updated=1') . '"; }, 1000);</script>';
            } else {
                $error_message = 'No changes were detected. Please make sure to fill in the fields you want to update.';
            }
        }
    }
    
    ?>
    <div class="wrap">
        <h1>Site Content Management</h1>
        <p>Edit the main page content sections below. Changes will be reflected immediately on your website.</p>
        
        <!-- Basic Debug - Always Show -->
        <div class="notice notice-info">
            <p><strong>Basic Status Check:</strong></p>
            <p>Current time: <?php echo current_time('Y-m-d H:i:s'); ?></p>
            <p>Form method: <?php echo $_SERVER['REQUEST_METHOD']; ?></p>
            <p>POST data exists: <?php echo !empty($_POST) ? 'YES' : 'NO'; ?></p>
            <p>Submit button in POST: <?php echo isset($_POST['submit']) ? 'YES (' . $_POST['submit'] . ')' : 'NO'; ?></p>
            <?php if (!empty($_POST)) : ?>
                <p>POST fields received: <?php echo implode(', ', array_keys($_POST)); ?></p>
            <?php endif; ?>
        </div>
        
        <!-- Show success/error messages -->
        <?php if (!empty($success_message)) : ?>
            <div class="notice notice-success"><p><?php echo $success_message; ?></p></div>
        <?php endif; ?>
        
        <?php if (!empty($error_message)) : ?>
            <div class="notice notice-error"><p><?php echo $error_message; ?></p></div>
        <?php endif; ?>
        
        <!-- Debug information -->
        <?php if (!empty($debug_info)) : ?>
            <div class="notice notice-info">
                <p><strong>Detailed Debug Information:</strong></p>
                <?php foreach ($debug_info as $info) : ?>
                    <p>• <?php echo esc_html($info); ?></p>
                <?php endforeach; ?>
                <p><strong>Current values in database:</strong></p>
                <p>Hero Title (theme mod): <?php echo esc_html(get_theme_mod('hero_title', 'NOT SET')); ?></p>
                <p>Hero Title (option): <?php echo esc_html(get_option('plumberpro_hero_title', 'NOT SET')); ?></p>
            </div>
        <?php endif; ?>
        
        <form method="post" action="<?php echo admin_url('admin.php?page=plumberpro-content'); ?>">
            <?php wp_nonce_field('plumberpro_content_nonce'); ?>
            
            <!-- Hero Section -->
            <div class="postbox" style="margin-top: 20px;">
                <div class="postbox-header">
                    <h2 class="hndle">Hero Section</h2>
                </div>
                <div class="inside" style="padding: 20px;">
                    <table class="form-table">
                        <tr>
                            <th scope="row"><label for="hero_title">Hero Title</label></th>
                            <td><input type="text" id="hero_title" name="hero_title" value="<?php echo esc_attr(plumberpro_get_content('hero_title', 'Next-Gen Plumbing Solutions')); ?>" class="regular-text" /></td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="hero_subtitle">Hero Subtitle</label></th>
                            <td><textarea id="hero_subtitle" name="hero_subtitle" rows="3" cols="50" class="large-text"><?php echo esc_textarea(plumberpro_get_content('hero_subtitle', 'Advanced plumbing technology meets expert craftsmanship. Smart solutions for modern homes and businesses.')); ?></textarea></td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="hero_primary_button_text">Primary Button Text</label></th>
                            <td><input type="text" id="hero_primary_button_text" name="hero_primary_button_text" value="<?php echo esc_attr(plumberpro_get_content('hero_primary_button_text', 'Get Smart Quote')); ?>" class="regular-text" /></td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="hero_primary_button_link">Primary Button Link</label></th>
                            <td>
                                <input type="text" id="hero_primary_button_link" name="hero_primary_button_link" value="<?php echo esc_attr(plumberpro_get_content('hero_primary_button_link', '#contact')); ?>" class="regular-text" />
                                <p class="description">Enter a URL (like https://example.com) or an anchor link (like #contact)</p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="hero_secondary_button_text">Secondary Button Text</label></th>
                            <td><input type="text" id="hero_secondary_button_text" name="hero_secondary_button_text" value="<?php echo esc_attr(plumberpro_get_content('hero_secondary_button_text', 'Emergency Call')); ?>" class="regular-text" /></td>
                        </tr>
                    </table>
                </div>
            </div>
            
            <!-- About Section -->
            <div class="postbox">
                <div class="postbox-header">
                    <h2 class="hndle">About Section</h2>
                </div>
                <div class="inside" style="padding: 20px;">
                    <table class="form-table">
                        <tr>
                            <th scope="row"><label for="about_title">About Title</label></th>
                            <td><input type="text" id="about_title" name="about_title" value="<?php echo esc_attr(get_theme_mod('about_title', 'The Future of Plumbing')); ?>" class="regular-text" /></td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="about_paragraph_1">First Paragraph</label></th>
                            <td><textarea id="about_paragraph_1" name="about_paragraph_1" rows="3" cols="50" class="large-text"><?php echo esc_textarea(get_theme_mod('about_paragraph_1', 'We combine traditional craftsmanship with cutting-edge technology to deliver plumbing solutions that are smarter, more efficient, and built for the future.')); ?></textarea></td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="about_paragraph_2">Second Paragraph</label></th>
                            <td><textarea id="about_paragraph_2" name="about_paragraph_2" rows="3" cols="50" class="large-text"><?php echo esc_textarea(get_theme_mod('about_paragraph_2', 'Our team of certified technicians uses advanced diagnostic tools, IoT-enabled fixtures, and sustainable practices to ensure your plumbing system operates at peak performance.')); ?></textarea></td>
                        </tr>
                        <?php for ($i = 1; $i <= 5; $i++) : ?>
                        <tr>
                            <th scope="row"><label for="about_feature_<?php echo $i; ?>">Feature <?php echo $i; ?></label></th>
                            <td><input type="text" id="about_feature_<?php echo $i; ?>" name="about_feature_<?php echo $i; ?>" value="<?php echo esc_attr(get_theme_mod("about_feature_$i", '')); ?>" class="regular-text" /></td>
                        </tr>
                        <?php endfor; ?>
                        <tr>
                            <th scope="row"><label for="about_image">About Section Image</label></th>
                            <td>
                                <div class="image-upload-wrapper">
                                    <input type="hidden" id="about_image" name="about_image" value="<?php echo esc_attr(get_theme_mod('about_image', '')); ?>" />
                                    <div class="image-preview">
                                        <?php 
                                        $about_image = get_theme_mod('about_image');
                                        if ($about_image) : ?>
                                            <img src="<?php echo esc_url($about_image); ?>" style="max-width: 200px; height: auto; display: block; margin-bottom: 10px;" />
                                        <?php else : ?>
                                            <div style="width: 200px; height: 150px; background: #f0f0f0; display: flex; align-items: center; justify-content: center; margin-bottom: 10px; border: 2px dashed #ccc;">
                                                <span style="color: #666;">No image selected</span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <button type="button" class="button upload-image-button">Choose Image</button>
                                    <button type="button" class="button remove-image-button" style="margin-left: 10px; <?php echo $about_image ? '' : 'display:none;'; ?>">Remove Image</button>
                                    <p class="description">Upload an image for the about section (recommended size: 600x400px)</p>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            
            <!-- Contact Section -->
            <div class="postbox">
                <div class="postbox-header">
                    <h2 class="hndle">Contact Section</h2>
                </div>
                <div class="inside" style="padding: 20px;">
                    <table class="form-table">
                        <tr>
                            <th scope="row"><label for="contact_section_title">Section Title</label></th>
                            <td><input type="text" id="contact_section_title" name="contact_section_title" value="<?php echo esc_attr(get_theme_mod('contact_section_title', 'Connect With Us')); ?>" class="regular-text" /></td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="contact_info_title">Contact Info Subtitle</label></th>
                            <td><input type="text" id="contact_info_title" name="contact_info_title" value="<?php echo esc_attr(get_theme_mod('contact_info_title', 'Get In Touch')); ?>" class="regular-text" /></td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="contact_form_title">Contact Form Title</label></th>
                            <td><input type="text" id="contact_form_title" name="contact_form_title" value="<?php echo esc_attr(get_theme_mod('contact_form_title', 'Request Smart Quote')); ?>" class="regular-text" /></td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="phone_number">Phone Number</label></th>
                            <td><input type="text" id="phone_number" name="phone_number" value="<?php echo esc_attr(get_theme_mod('phone_number', '(555) 123-4567')); ?>" class="regular-text" /></td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="email">Email Address</label></th>
                            <td><input type="email" id="email" name="email" value="<?php echo esc_attr(get_theme_mod('email', 'info@plumberpro.com')); ?>" class="regular-text" /></td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="address">Business Address</label></th>
                            <td><input type="text" id="address" name="address" value="<?php echo esc_attr(get_theme_mod('address', '123 Tech Boulevard, Smart City, ST 12345')); ?>" class="regular-text" /></td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="business_hours">Business Hours</label></th>
                            <td><input type="text" id="business_hours" name="business_hours" value="<?php echo esc_attr(get_theme_mod('business_hours', 'Mon-Fri: 7AM-6PM | Emergency: 24/7')); ?>" class="regular-text" /></td>
                        </tr>
                    </table>
                </div>
            </div>
            
            <?php submit_button('Update Content'); ?>
        </form>
        
        <div class="postbox">
            <div class="postbox-header">
                <h2 class="hndle">Additional Options</h2>
            </div>
            <div class="inside" style="padding: 20px;">
                <p><strong>Hero Background Image & About Image:</strong> To upload and manage images, visit the <a href="<?php echo admin_url('customize.php'); ?>">WordPress Customizer</a> where you'll find sections for "Hero Section" and "About Section" with image upload options.</p>
                <p><strong>Services:</strong> Manage your services in the <a href="<?php echo admin_url('edit.php?post_type=services'); ?>">Services</a> section.</p>
            </div>
        </div>
    </div>
    
    <style>
        .form-table th {
            width: 200px;
        }
        .postbox {
            margin-bottom: 20px;
        }
        .notice {
            margin: 5px 0 15px 0;
        }
    </style>
    <?php
}

// Function to get services for display
function plumberpro_get_services() {
    $services = get_posts(array(
        'post_type' => 'services',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'orderby' => 'menu_order',
        'order' => 'ASC'
    ));
    
    return $services;
}

// SVG Logo functionality
function plumberpro_get_svg_logo($type = 'white') {
    $logo_file = ($type === 'dark') ? 'logo-dark.svg' : 'logo-white.svg';
    $logo_path = get_template_directory() . '/assets/images/' . $logo_file;
    
    if (file_exists($logo_path)) {
        return file_get_contents($logo_path);
    }
    
    // Fallback to site name if SVG doesn't exist
    return false;
}

// Custom logo support with SVG upload
function plumberpro_custom_logo_setup() {
    add_theme_support('custom-logo', array(
        'height'      => 60,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ));
}
add_action('after_setup_theme', 'plumberpro_custom_logo_setup');

// Add SVG support to WordPress media uploader
function plumberpro_add_svg_support($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'plumberpro_add_svg_support');

// Display SVG properly in media library
function plumberpro_fix_svg_display($response, $attachment, $meta) {
    if ($response['mime'] == 'image/svg+xml') {
        $response['image'] = array(
            'src' => $response['url'],
            'width' => 200,
            'height' => 60,
        );
    }
    return $response;
}
add_filter('wp_prepare_attachment_for_js', 'plumberpro_fix_svg_display', 10, 3);

// Customizer section for logo options
function plumberpro_logo_customizer($wp_customize) {
    // Logo Section
    $wp_customize->add_section('plumberpro_logo_section', array(
        'title' => __('Logo Options', 'plumberpro'),
        'priority' => 25,
        'description' => __('Choose between built-in SVG logos or upload custom logos', 'plumberpro'),
    ));
    
    // Logo Type Choice
    $wp_customize->add_setting('logo_type', array(
        'default' => 'builtin_white',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('logo_type', array(
        'label' => __('Logo Type', 'plumberpro'),
        'section' => 'plumberpro_logo_section',
        'type' => 'select',
        'choices' => array(
            'builtin_white' => 'Built-in White SVG Logo',
            'builtin_dark' => 'Built-in Dark SVG Logo',
            'custom' => 'Use WordPress Custom Logo',
            'text' => 'Use Site Name (Text)',
        ),
    ));
    
    // Custom Logo Upload (this enhances the existing WordPress custom logo)
    $wp_customize->add_setting('custom_logo_white', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'custom_logo_white', array(
        'label' => __('White Version Logo', 'plumberpro'),
        'section' => 'plumberpro_logo_section',
        'settings' => 'custom_logo_white',
        'description' => __('Upload a white/light version of your logo for dark backgrounds', 'plumberpro'),
    )));
    
    $wp_customize->add_setting('custom_logo_dark', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'custom_logo_dark', array(
        'label' => __('Dark Version Logo', 'plumberpro'),
        'section' => 'plumberpro_logo_section',
        'settings' => 'custom_logo_dark',
        'description' => __('Upload a dark version of your logo for light backgrounds', 'plumberpro'),
    )));
}
add_action('customize_register', 'plumberpro_logo_customizer');

// Function to display the appropriate logo
function plumberpro_display_logo($context = 'header') {
    $logo_type = get_theme_mod('logo_type', 'builtin_white');
    
    // Auto-initialize to white logo if not set
    if (empty($logo_type)) {
        $logo_type = 'builtin_white';
        set_theme_mod('logo_type', 'builtin_white');
    }
    
    $site_name = get_bloginfo('name');
    $home_url = home_url();
    
    // Add context-specific classes
    $link_class = 'logo-link';
    if ($context === 'footer') {
        $link_class .= ' footer-logo-link';
    }
    
    echo '<a href="' . esc_url($home_url) . '" class="' . $link_class . '" aria-label="' . esc_attr($site_name) . ' - Home">';
    
    switch ($logo_type) {
        case 'builtin_white':
            $svg_content = plumberpro_get_svg_logo('white');
            if ($svg_content) {
                echo '<div class="logo-svg logo-white">' . $svg_content . '</div>';
            } else {
                echo '<span class="logo-text">Driftwell Contracting</span>';
            }
            break;
            
        case 'builtin_dark':
            // For footer, use white logo even if dark is selected
            if ($context === 'footer') {
                $svg_content = plumberpro_get_svg_logo('white');
            } else {
                $svg_content = plumberpro_get_svg_logo('dark');
            }
            if ($svg_content) {
                echo '<div class="logo-svg logo-' . ($context === 'footer' ? 'white' : 'dark') . '">' . $svg_content . '</div>';
            } else {
                echo '<span class="logo-text">Driftwell Contracting</span>';
            }
            break;
            
        case 'custom':
            if (has_custom_logo()) {
                $custom_logo_id = get_theme_mod('custom_logo');
                $custom_logo_url = wp_get_attachment_image_url($custom_logo_id, 'full');
                echo '<img src="' . esc_url($custom_logo_url) . '" alt="' . esc_attr($site_name) . '" class="custom-logo">';
            } else {
                echo '<span class="logo-text">Driftwell Contracting</span>';
            }
            break;
            
        case 'text':
        default:
            echo '<span class="logo-text">Driftwell Contracting</span>';
            break;
    }
    
    echo '</a>';
}

// Logo management page
function plumberpro_logo_management_page() {
    $success_message = '';
    
    // Handle form submission
    if (isset($_POST['submit_logo_settings']) && wp_verify_nonce($_POST['_wpnonce'], 'plumberpro_logo_nonce')) {
        if (isset($_POST['logo_type'])) {
            set_theme_mod('logo_type', sanitize_text_field($_POST['logo_type']));
            $success_message = 'Logo settings updated successfully!';
        }
    }
    
    $current_logo_type = get_theme_mod('logo_type', 'builtin_white');
    
    // Auto-set to white logo if not already set
    if (empty(get_theme_mod('logo_type'))) {
        set_theme_mod('logo_type', 'builtin_white');
        $current_logo_type = 'builtin_white';
        $success_message = 'Logo automatically set to display your Driftwell Contracting logo!';
    }
    ?>
    <div class="wrap">
        <h1>🎨 Logo Management</h1>
        <p>Choose how your logo appears on your website. You can use built-in SVG logos, upload custom logos, or use text.</p>
        
        <?php if ($success_message) : ?>
            <div class="notice notice-success"><p><?php echo esc_html($success_message); ?></p></div>
        <?php endif; ?>
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px; margin-top: 30px;">
            <!-- Settings Panel -->
            <div class="postbox">
                <div class="postbox-header">
                    <h2 class="hndle">Logo Settings</h2>
                </div>
                <div class="inside" style="padding: 20px;">
                    <form method="post">
                        <?php wp_nonce_field('plumberpro_logo_nonce'); ?>
                        
                        <table class="form-table">
                            <tr>
                                <th scope="row">Logo Type</th>
                                <td>
                                    <fieldset>
                                        <label>
                                            <input type="radio" name="logo_type" value="builtin_white" <?php checked($current_logo_type, 'builtin_white'); ?>>
                                            Built-in White SVG Logo
                                        </label><br><br>
                                        
                                        <label>
                                            <input type="radio" name="logo_type" value="builtin_dark" <?php checked($current_logo_type, 'builtin_dark'); ?>>
                                            Built-in Dark SVG Logo
                                        </label><br><br>
                                        
                                        <label>
                                            <input type="radio" name="logo_type" value="custom" <?php checked($current_logo_type, 'custom'); ?>>
                                            Custom Uploaded Logo
                                        </label><br><br>
                                        
                                        <label>
                                            <input type="radio" name="logo_type" value="text" <?php checked($current_logo_type, 'text'); ?>>
                                            Text Logo (Site Name)
                                        </label>
                                    </fieldset>
                                    <p class="description">Choose which type of logo to display in your site header.</p>
                                </td>
                            </tr>
                        </table>
                        
                        <?php submit_button('Update Logo Settings', 'primary', 'submit_logo_settings'); ?>
                    </form>
                    
                    <hr style="margin: 30px 0;">
                    
                    <h3>Upload Custom Logos</h3>
                    <p>To upload custom logos, go to: <strong>Appearance → Customize → Logo Options</strong></p>
                    <p>Or use: <strong>Appearance → Customize → Site Identity → Logo</strong></p>
                    
                    <h3>Replace Built-in SVG Logos</h3>
                    <p>To replace the built-in SVG logos with your own:</p>
                    <ol>
                        <li>Replace <code>/assets/images/logo-white.svg</code> with your white logo</li>
                        <li>Replace <code>/assets/images/logo-dark.svg</code> with your dark logo</li>
                        <li>Make sure your SVG files are optimized and sized appropriately</li>
                    </ol>
                </div>
            </div>
            
            <!-- Preview Panel -->
            <div class="postbox">
                <div class="postbox-header">
                    <h2 class="hndle">Logo Preview</h2>
                </div>
                <div class="inside" style="padding: 20px;">
                    <div style="margin-bottom: 30px;">
                        <h4>Current Logo (Dark Background)</h4>
                        <div style="background: #171717; padding: 20px; border-radius: 8px; text-align: center;">
                            <?php 
                            // Preview current logo on dark background
                            $preview_type = ($current_logo_type === 'builtin_dark') ? 'builtin_white' : $current_logo_type;
                            echo '<div style="display: inline-block;">';
                            plumberpro_display_logo('preview');
                            echo '</div>';
                            ?>
                        </div>
                    </div>
                    
                    <div style="margin-bottom: 30px;">
                        <h4>Current Logo (Light Background)</h4>
                        <div style="background: #f8fafc; padding: 20px; border-radius: 8px; text-align: center; border: 1px solid #e2e8f0;">
                            <?php 
                            // Preview current logo on light background
                            echo '<div style="display: inline-block;">';
                            plumberpro_display_logo('preview');
                            echo '</div>';
                            ?>
                        </div>
                    </div>
                    
                    <div>
                        <h4>Logo Files Status</h4>
                        <ul style="list-style-type: disc; margin-left: 20px;">
                            <li>White SVG: <?php echo file_exists(get_template_directory() . '/assets/images/logo-white.svg') ? '✅ Found' : '❌ Missing'; ?></li>
                            <li>Dark SVG: <?php echo file_exists(get_template_directory() . '/assets/images/logo-dark.svg') ? '✅ Found' : '❌ Missing'; ?></li>
                            <li>Custom Logo: <?php echo has_custom_logo() ? '✅ Uploaded' : '❌ Not Set'; ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="postbox" style="margin-top: 20px;">
            <div class="postbox-header">
                <h2 class="hndle">Quick Actions</h2>
            </div>
            <div class="inside" style="padding: 20px;">
                <p>
                    <a href="<?php echo admin_url('customize.php'); ?>" class="button button-secondary">
                        🎨 Open Customizer
                    </a>
                    <a href="<?php echo home_url(); ?>" class="button button-secondary" target="_blank">
                        👁️ View Site
                    </a>
                    <a href="<?php echo admin_url('admin.php?page=plumberpro-content'); ?>" class="button button-secondary">
                        📝 Edit Site Content
                    </a>
                </p>
            </div>
        </div>
    </div>
    
    <style>
        .form-table th {
            width: 150px;
        }
        fieldset label {
            display: block;
            margin-bottom: 10px;
        }
        fieldset input[type="radio"] {
            margin-right: 8px;
        }
    </style>
    <?php
}
?>
