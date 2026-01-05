<?php get_header(); ?>
<div class="container">
    <?php if(get_option('ad_content_top')): ?>
    <div class="ad-top"><?php echo get_option('ad_content_top'); ?></div>
    <?php endif; ?>
    
    <div class="content-wrap">
        <main class="main-content">
            <?php while(have_posts()): the_post(); ?>
            <article class="single-content">
                <h1><?php the_title(); ?></h1>
                <div class="entry-meta">
                    <span>📅 <?php echo get_the_date(); ?></span>
                    <span>👁 <?php echo get_post_meta(get_the_ID(),'views',true)?:0; ?> views</span>
                    <span>📁 <?php the_category(', '); ?></span>
                </div>
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
            </article>
            <?php endwhile; ?>
            
            <?php if(get_option('ad_content_bottom')): ?>
            <div class="ad-bottom"><?php echo get_option('ad_content_bottom'); ?></div>
            <?php endif; ?>
        </main>
        
        <?php if(get_option('skin_show_sidebar',true)): ?>
        <aside class="sidebar">
            <?php if(get_option('ad_sidebar')): ?>
            <div class="ad-sidebar sticky"><?php echo get_option('ad_sidebar'); ?></div>
            <?php endif; ?>
            <div class="widget">
                <h3>🔥 인기글</h3>
                <?php echo do_shortcode('[popular]'); ?>
            </div>
        </aside>
        <?php endif; ?>
    </div>
</div>
<?php get_footer(); ?>
