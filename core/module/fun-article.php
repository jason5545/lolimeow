<?php
/**
 * @link https://www.boxmoe.com
 * @package lolimeow
 */

// 安全設定--------------------------boxmoe.com--------------------------
if(!defined('ABSPATH')){
    echo'Look your sister';
    exit;
}

// 文章新視窗打開開關--------------------------boxmoe.com--------------------------
function boxmoe_article_new_window() {
    return get_boxmoe('boxmoe_article_new_window_switch')?'target="_blank"':'';
}

// 開啟所有文章形式支援--------------------------boxmoe.com--------------------------
if(get_boxmoe('boxmoe_article_support_switch')){
    add_theme_support('post-formats', array('image', 'video', 'audio', 'quote', 'link'));
}

//開啟特色文章縮圖
    add_theme_support('post-thumbnails');
	
// 縮圖尺寸設定--------------------------boxmoe.com--------------------------
if(get_boxmoe('boxmoe_article_thumbnail_size_switch')){
function boxmoe_article_thumbnail_size($size) {
    $width  = intval(get_boxmoe('boxmoe_article_thumbnail_width')) ?: 300; 
    $height = intval(get_boxmoe('boxmoe_article_thumbnail_height')) ?: 200;
    return array($width, $height); 
}
add_filter('post_thumbnail_size', 'boxmoe_article_thumbnail_size');
}

// 文章縮圖邏輯--------------------------boxmoe.com--------------------------
function boxmoe_article_thumbnail_src() {
    global $post;
    $src='';
    if ($thumbnail_id = get_post_thumbnail_id()) {
        $src=wp_get_attachment_image_url($thumbnail_id, 'full');
    }elseif ($thumbnail_url = get_post_meta(get_the_ID(), '_thumbnail', true)) {
        $src=$thumbnail_url;
    }elseif (preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches)) {
        $src=$matches[1][0]; 
    }else{
        if(get_boxmoe('boxmoe_article_thumbnail_random_api')){
            $src=get_boxmoe('boxmoe_article_thumbnail_random_api_url');
        }else{
            $random_images = glob(get_template_directory().'/assets/images/random/*.{jpg,jpeg,png,gif}', GLOB_BRACE);   
            if (!empty($random_images)) {
                $random_key = array_rand($random_images);
                $src = str_replace(get_template_directory(), get_template_directory_uri(), $random_images[$random_key]);
            } else {
                $src = boxmoe_theme_url().'/assets/images/default-thumbnail.jpg';
            }
        }
    }
    return $src ?: boxmoe_theme_url().'/assets/images/default-thumbnail.jpg';
}

//文章點擊數換算K--------------------------boxmoe.com--------------------------
function restyle_text($number){
    if ($number >= 1000) {
                  return round($number / 1000, 2) . 'k';
              } else {
                  return $number;
              }
  }
  //文章點擊數--------------------------boxmoe.com--------------------------
  function getPostViews($postID){
      $count_key = 'post_views_count';
      $count = get_post_meta($postID, $count_key, true);
      if($count==''){
          delete_post_meta($postID, $count_key);
          add_post_meta($postID, $count_key, '0');
          return "0 View";
      }
      return restyle_text($count);
  }
  function setPostViews($postID) {
      $count_key = 'post_views_count';
      $count = get_post_meta($postID, $count_key, true);
      if($count==''){
          $count = 0;
          delete_post_meta($postID, $count_key);
          add_post_meta($postID, $count_key, '0');
      }else{
          $count++;
          update_post_meta($postID, $count_key, $count);
      }
  }


//修剪標記--------------------------boxmoe.com--------------------------
function _str_cut($str, $start, $width, $trimmarker) {
	$output = preg_replace('/^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,' . $start . '}((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,' . $width . '}).*/s', '\1', $str);
	return $output . $trimmarker;
}

//自定義段長度--------------------------boxmoe.com--------------------------
function custom_excerpt_length( $length ){
return 200;
}
add_filter( 'excerpt_length', 'custom_excerpt_length');

//文章、評論內容縮短--------------------------boxmoe.com--------------------------
function _get_excerpt($limit = 60, $after = '...') { 
	$excerpt = get_the_excerpt();
	if (mb_strlen($excerpt) > $limit) {
		return _str_cut(strip_tags($excerpt), 0, $limit, $after);
	} else {
		return $excerpt;
	}
}

// 表格取代--------------------------boxmoe.com--------------------------
function boxmoe_table_replace($text){
	$replace = array( '<table>' => '<div class="table-responsive"><table class="table" >','</table>' => '</table></div>' );
	$text = str_replace(array_keys($replace), $replace, $text);
	return $text;}
add_filter('the_content', 'boxmoe_table_replace');

//防止代碼轉義--------------------------boxmoe.com--------------------------
function boxmoe_prettify_esc_html($content){
    $regex = '/(<pre\s+[^>]*?class\s*?=\s*?[",\'].*?prettyprint.*?[",\'].*?>)(.*?)(<\/pre>)/sim';
    return preg_replace_callback($regex, 'boxmoe_prettify_esc_callback', $content);}
function boxmoe_prettify_esc_callback($matches){
    $tag_open = $matches[1];
    $content = $matches[2];
    $tag_close = $matches[3];
    $content = esc_html($content);
    return $tag_open . $content . $tag_close;}
add_filter('the_content', 'boxmoe_prettify_esc_html', 2);
add_filter('comment_text', 'boxmoe_prettify_esc_html', 2);

//強制兼容--------------------------boxmoe.com--------------------------
function boxmoe_prettify_replace($text){
	$replace = array( '<pre>' => '<pre class="prettyprint linenums" >','<pre class="prettyprint">' => '<pre class="prettyprint linenums" >' );
	$text = str_replace(array_keys($replace), $replace, $text);
	return $text;}
add_filter('the_content', 'boxmoe_prettify_replace');

// 自動設定特色圖片--------------------------boxmoe.com--------------------------
function autoset_featured_image() {
    global $post;
    if (!is_object($post)) return;
    $already_has_thumb = has_post_thumbnail($post->ID);
    if (!$already_has_thumb)  {
        $attached_image = get_children( "post_parent=$post->ID&post_type=attachment&post_mime_type=image&numberposts=1" );
        if ($attached_image) {
            foreach ($attached_image as $attachment_id => $attachment) {
                set_post_thumbnail($post->ID, $attachment_id);
            }
        }
    }
}
add_action( 'the_post', 'autoset_featured_image' );
add_action( 'save_post', 'autoset_featured_image' );
add_action( 'draft_to_publish', 'autoset_featured_image' );
add_action( 'new_to_publish', 'autoset_featured_image' );
add_action( 'pending_to_publish', 'autoset_featured_image' );
add_action( 'future_to_publish', 'autoset_featured_image' );


// 自適應圖片--------------------------boxmoe.com--------------------------
function boxmoe_remove_width_height($content) {
    preg_match_all('/<[img|IMG].*?src=[\'|"](.*?(?:[\.gif|\.jpg|\.png\.bmp\.webp]))[\'|"].*?[\/]?>/', $content, $images);
    if (!empty($images)) {
        foreach ($images[0] as $index => $value) {
            $new_img = preg_replace('/(width|height)="\d*"\s/', "", $images[0][$index]);
            $content = str_replace($images[0][$index], $new_img, $content);
        }
    }
    return $content;
}
add_filter('the_content', 'boxmoe_remove_width_height', 99);


// 圖片懶加載--------------------------boxmoe.com--------------------------
function boxmoe_lazy_content_load_images($content) {
    $content = preg_replace_callback('/<img([^>]*?)src=([\'"])([^\'"]+)\2/i', 
        function($matches) {
            if (strpos($matches[0], 'data-src') !== false) {
                return $matches[0];
            }
            return '<img' . $matches[1] 
                . ' src="' . boxmoe_lazy_load_images() . '"' 
                . ' data-src="' . $matches[3] . '"'
                . ' class="lazy"'
                . ' loading="lazy"';
        },
        $content);
    return $content;
}
if(!is_admin()){
    add_filter('the_content', 'boxmoe_lazy_content_load_images', 99);
}

// fancybox--------------------------boxmoe.com--------------------------
function boxmoe_fancybox_replace ($content) {
    global $post;
    $pattern = "/<a(.*?)href=('|\")([A-Za-z0-9\/_\.\~\:-]*?)(-\d+x\d+)?(\.(?:bmp|gif|jpeg|png|jpg|webp))('|\")([^\>]*?)>/i";
    $replacement = '<a$1href=$2$3$5$6$7 class="fancybox" data-fancybox="gallery" data-src="$3$5">';
    $content = preg_replace($pattern, $replacement, $content);
    return $content;
}
add_filter('the_content', 'boxmoe_fancybox_replace', 99);

// fancybox-erphpdown
//add_filter('the_content', 'erphpdownbuy_replace', 99);
function erphpdownbuy_replace ($content) {
	global $post;
	$pattern = "/<a(.*?)class=\"erphpdown-iframe erphpdown-buy\"(.*?)>/i";
	$replacement = '<a$1$2$3$4$5$6 class="fancybox" data-fancybox data-type="iframe" class="erphpdown-buy">';
	$content = preg_replace($pattern, $replacement, $content);
	return $content;
}

// 分頁導航函數--------------------------boxmoe.com--------------------------
if ( ! function_exists( 'boxmoe_pagination' ) ) :
function boxmoe_pagination($query = null) {
    $paging_type = get_boxmoe('boxmoe_article_paging_type');
    if($paging_type == 'multi'){
        $p = 1;
        if ( is_singular() ) return;
        global $wp_query, $paged;
        $max_page = $wp_query->max_num_pages;
        echo '<div class="col-lg-12 col-md-12 pagenav">';
        echo '<nav class="d-flex justify-content-center">';
        echo '<ul class="pagination">';
        if ( empty( $paged ) ) $paged = 1;
        if($paged !== 1 ) p_link(0);
        $start = max(1, $paged - $p);
        $end = min($paged + ($p * 1), $max_page);
        if ($start > 1) {
            p_link(1);
            if ($start > 1) echo "<li class=\"page-item\"><a class=\"page-link\">···</a></li>";
        }
        for( $i = $start; $i <= $end; $i++ ) { 
            if ( $i > 0 && $i <= $max_page ) {
                $i == $paged ? print "<li class=\"page-item active\"><a class=\"page-link\" href=\"#\">{$i}</a></li>" : p_link( $i );
            }
        }
        if ($end < $max_page) {
            if ($end < $max_page - 1) echo "<li class=\"page-item\"><a class=\"page-link\">···</a></li>";
            p_link($max_page, '', 1);
        }
        echo '</ul>
        </nav>
      </div>';
    }elseif($paging_type == 'next'){
        global $wp_query;
        $query = $query ?: $wp_query;
        $current = max(1, get_query_var('paged'));
        $total = $query->max_num_pages;
        
        echo '<nav class="pagination-next-prev"><ul class="pagination justify-content-center">';
        if ($current > 1) {
            echo '<li class="page-item">';
            previous_posts_link('<span class="page-link"><i class="fa fa-arrow-left"></i> '.__('上一頁', 'boxmoe').'</span>');
            echo '</li>';
        }
        if ($current < $total) {
            echo '<li class="page-item ms-2">';
            next_posts_link('<span class="page-link">'.__('下一頁', 'boxmoe').' <i class="fa fa-arrow-right"></i></span>', $total);
            echo '</li>';
        }
        echo '</ul></nav>';
    }elseif($paging_type == 'loadmore'){
    }
}
function p_link( $i, $title = '', $w='' ) {
    if ( $title == '' ) $title = __('頁', 'boxmoe-com')." {$i}";
    $itext = $i;
    if( $i == 0 ){
        $itext = __('<i class="fa fa-angle-double-left"></i>', 'boxmoe-com');
    }
    if( $w ){
        $itext = __('<i class="fa fa-angle-double-right"></i>', 'boxmoe-com');
    }
    echo "<li class=\"page-item\"><a class=\"page-link\" href='", esc_html( get_pagenum_link( $i ) ), "'>{$itext}</a></li>";
}
endif;


// 文章點讚數獲取
function getPostLikes($postID) {
    $count_key = 'post_likes_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count == ''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count;
}

function boxmoe_post_like() {
    $post_id = isset($_POST['post_id']) ? absint($_POST['post_id']) : 0;
    
    if (!$post_id) {
        wp_send_json_error(['message' => 'Invalid post ID']);
        return;
    }

    if (!get_post($post_id)) {
        wp_send_json_error(['message' => '文章不存在']);
        return;
    }

    $user_ip = $_SERVER['REMOTE_ADDR'];
    $transient_key = 'post_like_' . $post_id . '_' . md5($user_ip);

    if (false === get_transient($transient_key)) {
        $count = (int)get_post_meta($post_id, 'post_likes_count', true);
        $count++;
        update_post_meta($post_id, 'post_likes_count', $count);
        set_transient($transient_key, '1', DAY_IN_SECONDS);
        
        wp_send_json_success([
            'count' => $count,
            'message' => '點讚成功'
        ]);
    } else {
        wp_send_json_error(['message' => '您已經點過讚了']);
    }
}

add_action('wp_ajax_post_like', 'boxmoe_post_like');
add_action('wp_ajax_nopriv_post_like', 'boxmoe_post_like');

// 檢查文章是否被收藏
function isPostFavorited($post_id) {
    if (!is_user_logged_in()) return false;
    
    $user_id = get_current_user_id();
    $favorites = get_user_meta($user_id, 'user_favorites', true);
    
    if (!is_array($favorites)) {
        $favorites = array();
    }
    
    return in_array($post_id, $favorites);
}

// 處理文章收藏
function boxmoe_post_favorite() {
    if (!is_user_logged_in()) {
        wp_send_json_error(['message' => '請先登入']);
        return;
    }

    $post_id = isset($_POST['post_id']) ? absint($_POST['post_id']) : 0;
    
    if (!$post_id) {
        wp_send_json_error(['message' => '無效的文章ID']);
        return;
    }

    if (!get_post($post_id)) {
        wp_send_json_error(['message' => '文章不存在']);
        return;
    }

    $user_id = get_current_user_id();
    $favorites = get_user_meta($user_id, 'user_favorites', true);
    
    if (!is_array($favorites)) {
        $favorites = array();
    }

    $is_favorited = in_array($post_id, $favorites);
    
    if ($is_favorited) {
        $favorites = array_diff($favorites, array($post_id));
        $message = '取消收藏成功';
        $status = false;
    } else {
        $favorites[] = $post_id;
        $message = '收藏成功';
        $status = true;
    }
    update_user_meta($user_id, 'user_favorites', array_values($favorites));
    wp_send_json_success([
        'message' => $message,
        'status' => $status
    ]);
}

add_action('wp_ajax_post_favorite', 'boxmoe_post_favorite');

// 處理刪除收藏
function boxmoe_delete_favorite() {
    if (!is_user_logged_in()) {
        wp_send_json_error(['message' => '請先登入']);
        return;
    }

    $post_id = isset($_POST['post_id']) ? absint($_POST['post_id']) : 0;
    
    if (!$post_id) {
        wp_send_json_error(['message' => '無效的文章ID']);
        return;
    }

    $user_id = get_current_user_id();
    $favorites = get_user_meta($user_id, 'user_favorites', true);
    
    if (!is_array($favorites)) {
        wp_send_json_error(['message' => '沒有找到收藏記錄']);
        return;
    }
    $favorites = array_diff($favorites, array($post_id));
        update_user_meta($user_id, 'user_favorites', array_values($favorites));
    wp_send_json_success([
        'message' => '刪除收藏成功'
    ]);
}

add_action('wp_ajax_delete_favorite', 'boxmoe_delete_favorite');
