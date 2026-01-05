<?php get_header(); ?>
<div class="container">
    <div class="archive-header">
        <h1><?php the_archive_title(); ?></h1>
        <?php the_archive_description('<p>','</p>'); ?>
    </div>
    
    <?php if(get_option('ad_content_top')): ?>
    <div class="ad-top"><?php echo get_option('ad_content_top'); ?></div>
    <?php endif; ?>
    
    <div class="content-wrap">
        <main class="main-content">
            <div class="posts-grid">
                <?php if(have_posts()): while(have_posts()): the_post(); ?>
                <article class="post-card">
                    <?php if(has_post_thumbnail()): ?>
                    <div class="post-thumb"><?php the_post_thumbnail('medium'); ?></div>
                    <?php endif; ?>
                    <div class="post-content">
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <div class="post-meta">
                            <span><?php echo get_the_date(); ?></span>
                            <span><?php echo get_post_meta(get_the_ID(),'views',true)?:0; ?> views</span>
                        </div>
                        <p><?php echo wp_trim_words(get_the_excerpt(),20); ?></p>
                        <a href="<?php the_permalink(); ?>" class="read-more">자세히 보기 →</a>
                    </div>
                </article>
                <?php endwhile; endif; ?>
            </div>
            <div class="pagination"><?php echo paginate_links(); ?></div>
        </main>
        
        <?php if(get_option('skin_show_sidebar',true)): ?>
        <aside class="sidebar">
            <?php if(get_option('ad_sidebar')): ?>
            <div class="ad-sidebar sticky"><?php echo get_option('ad_sidebar'); ?></div>
            <?php endif; ?>
        </aside>
        <?php endif; ?>
    </div>
</div>
<?php get_footer(); ?>
