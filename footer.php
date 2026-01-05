<footer class="site-footer">
    <?php if(get_option('ad_footer')): ?>
    <div class="ad-footer"><?php echo get_option('ad_footer'); ?></div>
    <?php endif; ?>
    
    <div class="container">
        <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.</p>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
