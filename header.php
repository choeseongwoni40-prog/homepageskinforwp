<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php if(get_option('ad_header')): ?>
<div class="ad-header"><?php echo get_option('ad_header'); ?></div>
<?php endif; ?>

<header class="site-header">
    <div class="container">
        <div class="header-inner">
            <div class="site-branding">
                <h1><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
            </div>
            <nav class="main-nav">
                <?php wp_nav_menu(array('theme_location'=>'primary','container'=>false)); ?>
            </nav>
        </div>
    </div>
</header>
