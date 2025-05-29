<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="site-header">
    <div class="container">
        <div class="header-content">
            <div class="logo">
                <?php plumberpro_display_logo('header'); ?>
            </div>
            
            <nav class="main-nav">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_class' => 'nav-menu',
                    'fallback_cb' => false,
                ));
                ?>
            </nav>
            
            <a href="tel:<?php echo get_theme_mod('phone_number', '(555) 123-4567'); ?>" class="cta-button">
                Call Now: <?php echo get_theme_mod('phone_number', '(555) 123-4567'); ?>
            </a>
        </div>
    </div>
</header>
