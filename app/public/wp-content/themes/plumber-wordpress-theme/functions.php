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
    
    // Contact Information
    $wp_customize->add_section('contact_info', array(
        'title' => __('Contact Information', 'plumberpro'),
        'priority' => 35,
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
?>
