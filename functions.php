<?php
// 지원in - 수익화 최적화 시스템
function theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    register_nav_menus(array('primary'=>'메인 메뉴'));
}
add_action('after_setup_theme','theme_setup');

function theme_scripts() {
    wp_enqueue_style('theme-style',get_stylesheet_uri());
    wp_enqueue_script('theme-script',get_template_directory_uri().'/js/main.js',array(),null,true);
}
add_action('wp_enqueue_scripts','theme_scripts');

// 광고 관리 시스템
add_action('admin_menu',function(){
    add_menu_page('광고관리','광고관리','manage_options','ad-manager','ad_manager_page','dashicons-money-alt');
    add_submenu_page('ad-manager','스킨설정','스킨설정','manage_options','skin-settings','skin_settings_page');
});

function ad_manager_page() {
    if(!current_user_can('manage_options')) return;
    if(isset($_POST['save_ads']) && check_admin_referer('save_ads')) {
        update_option('ad_header',wp_kses_post($_POST['ad_header']));
        update_option('ad_sidebar',wp_kses_post($_POST['ad_sidebar']));
        update_option('ad_content_top',wp_kses_post($_POST['ad_content_top']));
        update_option('ad_content_mid',wp_kses_post($_POST['ad_content_mid']));
        update_option('ad_content_bottom',wp_kses_post($_POST['ad_content_bottom']));
        update_option('ad_footer',wp_kses_post($_POST['ad_footer']));
        echo '<div class="notice notice-success"><p>저장완료!</p></div>';
    }
    $ads = array('header'=>get_option('ad_header',''),'sidebar'=>get_option('ad_sidebar',''),'content_top'=>get_option('ad_content_top',''),'content_mid'=>get_option('ad_content_mid',''),'content_bottom'=>get_option('ad_content_bottom',''),'footer'=>get_option('ad_footer',''));
    ?>
    <div class="wrap"><h1>💰 광고 관리</h1>
    <form method="post" style="max-width:800px;">
        <?php wp_nonce_field('save_ads'); ?>
        <div style="background:#fff;padding:20px;margin:20px 0;border-radius:8px;">
            <h2>📌 헤더 광고 (상단 고정)</h2>
            <textarea name="ad_header" rows="5" style="width:100%;font-family:monospace;"><?php echo esc_textarea($ads['header']); ?></textarea>
        </div>
        <div style="background:#fff;padding:20px;margin:20px 0;border-radius:8px;">
            <h2>📌 사이드바 광고 (우측 고정)</h2>
            <textarea name="ad_sidebar" rows="5" style="width:100%;font-family:monospace;"><?php echo esc_textarea($ads['sidebar']); ?></textarea>
        </div>
        <div style="background:#fff;padding:20px;margin:20px 0;border-radius:8px;">
            <h2>📌 콘텐츠 상단 광고</h2>
            <textarea name="ad_content_top" rows="5" style="width:100%;font-family:monospace;"><?php echo esc_textarea($ads['content_top']); ?></textarea>
        </div>
        <div style="background:#fff;padding:20px;margin:20px 0;border-radius:8px;">
            <h2>📌 콘텐츠 중간 광고 (자동삽입)</h2>
            <textarea name="ad_content_mid" rows="5" style="width:100%;font-family:monospace;"><?php echo esc_textarea($ads['content_mid']); ?></textarea>
        </div>
        <div style="background:#fff;padding:20px;margin:20px 0;border-radius:8px;">
            <h2>📌 콘텐츠 하단 광고</h2>
            <textarea name="ad_content_bottom" rows="5" style="width:100%;font-family:monospace;"><?php echo esc_textarea($ads['content_bottom']); ?></textarea>
        </div>
        <div style="background:#fff;padding:20px;margin:20px 0;border-radius:8px;">
            <h2>📌 푸터 광고</h2>
            <textarea name="ad_footer" rows="5" style="width:100%;font-family:monospace;"><?php echo esc_textarea($ads['footer']); ?></textarea>
        </div>
        <p><input type="submit" name="save_ads" class="button button-primary button-large" value="💾 저장하기"></p>
    </form>
    <div style="background:#E8F5E9;padding:20px;border-radius:8px;margin-top:30px;">
        <h3>💡 수익화 최적화 팁</h3>
        <ul style="line-height:2;">
            <li><strong>헤더:</strong> 앵커/전면광고 (고정노출)</li>
            <li><strong>사이드바:</strong> 디스플레이 광고 (스크롤 추적)</li>
            <li><strong>콘텐츠 중간:</strong> 자동삽입 (자연스러운 노출)</li>
            <li><strong>콘텐츠 하단:</strong> 관련광고 (높은 CTR)</li>
            <li><strong>푸터:</strong> 추가 수익 기회</li>
        </ul>
    </div>
    </div>
    <?php
}

function skin_settings_page() {
    if(!current_user_can('manage_options')) return;
    if(isset($_POST['save_skin']) && check_admin_referer('save_skin')) {
        update_option('skin_primary_color',sanitize_hex_color($_POST['primary_color']));
        update_option('skin_show_sidebar',isset($_POST['show_sidebar']));
        update_option('skin_posts_per_page',intval($_POST['posts_per_page']));
        update_option('skin_ad_position',sanitize_text_field($_POST['ad_position']));
        echo '<div class="notice notice-success"><p>저장완료!</p></div>';
    }
    $color = get_option('skin_primary_color','#2563EB');
    $sidebar = get_option('skin_show_sidebar',true);
    $ppp = get_option('skin_posts_per_page',10);
    $adpos = get_option('skin_ad_position','after-3');
    ?>
    <div class="wrap"><h1>🎨 스킨 설정</h1>
    <form method="post" style="max-width:600px;">
        <?php wp_nonce_field('save_skin'); ?>
        <table class="form-table">
            <tr><th>메인 컬러</th>
                <td><input type="color" name="primary_color" value="<?php echo esc_attr($color); ?>"></td></tr>
            <tr><th>사이드바 표시</th>
                <td><input type="checkbox" name="show_sidebar" <?php checked($sidebar); ?>></td></tr>
            <tr><th>페이지당 글 수</th>
                <td><input type="number" name="posts_per_page" value="<?php echo $ppp; ?>" min="5" max="50"></td></tr>
            <tr><th>콘텐츠 광고 위치</th>
                <td><select name="ad_position">
                    <option value="after-1" <?php selected($adpos,'after-1'); ?>>1번째 문단 후</option>
                    <option value="after-2" <?php selected($adpos,'after-2'); ?>>2번째 문단 후</option>
                    <option value="after-3" <?php selected($adpos,'after-3'); ?>>3번째 문단 후</option>
                    <option value="middle" <?php selected($adpos,'middle'); ?>>중간 위치</option>
                </select></td></tr>
        </table>
        <p><input type="submit" name="save_skin" class="button button-primary" value="저장"></p>
    </form></div>
    <?php
}

// 콘텐츠 광고 자동삽입
add_filter('the_content',function($content){
    if(!is_single()) return $content;
    $ad = get_option('ad_content_mid','');
    if(empty($ad)) return $content;
    $pos = get_option('skin_ad_position','after-3');
    $paras = explode('</p>',$content);
    $insert_at = ($pos=='after-1')?1:(($pos=='after-2')?2:(($pos=='after-3')?3:floor(count($paras)/2)));
    if(count($paras)>$insert_at) {
        array_splice($paras,$insert_at,0,'<div class="ad-inject">'.$ad.'</div>');
    }
    return implode('</p>',$paras);
});

// 조회수 트래킹
add_action('wp_head',function(){
    if(is_single()) {
        global $post;
        $views = get_post_meta($post->ID,'views',true)?:0;
        update_post_meta($post->ID,'views',$views+1);
    }
});

// 인기글 숏코드
add_shortcode('popular',function(){
    $q = new WP_Query(array('posts_per_page'=>5,'meta_key'=>'views','orderby'=>'meta_value_num','order'=>'DESC'));
    $out = '<div class="popular-posts">';
    while($q->have_posts()) {
        $q->the_post();
        $out .= '<div class="pop-item"><a href="'.get_permalink().'">'.get_the_title().'</a><span>'.get_post_meta(get_the_ID(),'views',true).' views</span></div>';
    }
    wp_reset_postdata();
    return $out.'</div>';
});
?>
