<?php get_header(); ?>
<div class="container">
    <div class="hero">
        <h1>지원in에 오신 것을 환영합니다</h1>
        <p>2026년 정부지원금 관련 최신 정보와 전문 지식을 제공합니다</p>
    </div>
    
    <?php if(get_option('ad_content_top')): ?>
    <div class="ad-top"><?php echo get_option('ad_content_top'); ?></div>
    <?php endif; ?>
    
    <div class="content-wrap">
        <main class="main-content">
            <div class="posts-grid">
                <?php 
                $ppp = get_option('skin_posts_per_page',10);
                $posts = new WP_Query(array('posts_per_page'=>$ppp));
                if($posts->have_posts()): 
                    while($posts->have_posts()): $posts->the_post(); ?>
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
                <?php endwhile; wp_reset_postdata(); endif; ?>
            </div>
            
            <?php if(get_option('ad_content_bottom')): ?>
            <div class="ad-bottom"><?php echo get_option('ad_content_bottom'); ?></div>
            <?php endif; ?>
            
            <div class="pagination"><?php echo paginate_links(); ?></div>
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
            
            <div class="widget">
                <h3>📁 카테고리</h3>
                <ul><?php wp_list_categories(array('title_li'=>'')); ?></ul>
            </div>
        </aside>
        <?php endif; ?>
    </div>
</div>
<?php get_footer(); ?>
