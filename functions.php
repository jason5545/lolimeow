<?php
/**
 * @link https://www.boxmoe.com
 * @package lolimeow
 */

//boxmoe.com===安全設置=防止直接存取主題檔案
if(!defined('ABSPATH')){
    echo'Look your sister';
    exit;
}
//時區設置
date_default_timezone_set('Asia/Shanghai');

//boxmoe.com===加载面板
define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/core/panel/' );
require_once dirname( __FILE__ ) . '/core/panel/options-framework.php';
require_once dirname( __FILE__ ) . '/options.php';
require_once dirname( __FILE__ ) . '/core/panel/options-framework-js.php';
//boxmoe.com===功能模块
require_once  get_stylesheet_directory() . '/core/module/fun-basis.php';
require_once  get_stylesheet_directory() . '/core/module/fun-admin.php';
require_once  get_stylesheet_directory() . '/core/module/fun-optimize.php';
require_once  get_stylesheet_directory() . '/core/module/fun-gravatar.php';
require_once  get_stylesheet_directory() . '/core/module/fun-navwalker.php';
require_once  get_stylesheet_directory() . '/core/module/fun-user.php';
require_once  get_stylesheet_directory() . '/core/module/fun-user-center.php';
require_once  get_stylesheet_directory() . '/core/module/fun-comments.php';
require_once  get_stylesheet_directory() . '/core/module/fun-seo.php';
require_once  get_stylesheet_directory() . '/core/module/fun-article.php';
require_once  get_stylesheet_directory() . '/core/module/fun-smtp.php';
require_once  get_stylesheet_directory() . '/core/module/fun-msg.php';
require_once  get_stylesheet_directory() . '/core/module/fun-no-category.php';
require_once  get_stylesheet_directory() . '/core/module/fun-shortcode.php';
//boxmoe.com===自定義程式碼

// 添加網站地圖生成功能
if (!function_exists('boxmoe_generate_sitemap')) {
    function boxmoe_generate_sitemap() {
        // 檢查是否請求sitemap.xml
        $sitemap_request = (isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] == '/sitemap.xml');
        
        if ($sitemap_request) {
            header('Content-Type: application/xml; charset=utf-8');
            echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
            echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
            
            // 首頁
            echo '<url>' . "\n";
            echo '<loc>' . home_url('/') . '</loc>' . "\n";
            echo '<changefreq>daily</changefreq>' . "\n";
            echo '<priority>1.0</priority>' . "\n";
            echo '</url>' . "\n";
            
            // 獲取最近發布的文章
            $posts = get_posts(array(
                'numberposts' => 1000,
                'post_type' => 'post',
                'post_status' => 'publish'
            ));
            
            foreach ($posts as $post) {
                $permalink = get_permalink($post->ID);
                $modified = $post->post_modified;
                
                echo '<url>' . "\n";
                echo '<loc>' . $permalink . '</loc>' . "\n";
                echo '<lastmod>' . date('c', strtotime($modified)) . '</lastmod>' . "\n";
                echo '<changefreq>weekly</changefreq>' . "\n";
                echo '<priority>0.8</priority>' . "\n";
                echo '</url>' . "\n";
            }
            
            // 獲取所有頁面
            $pages = get_pages();
            
            foreach ($pages as $page) {
                $permalink = get_permalink($page->ID);
                
                // 排除特定頁面，如果需要的話
                if (strpos($permalink, 'exclude-page') !== false) {
                    continue;
                }
                
                echo '<url>' . "\n";
                echo '<loc>' . $permalink . '</loc>' . "\n";
                echo '<changefreq>monthly</changefreq>' . "\n";
                echo '<priority>0.6</priority>' . "\n";
                echo '</url>' . "\n";
            }
            
            // 獲取分類目錄
            $categories = get_categories(array('taxonomy' => 'category'));
            
            foreach ($categories as $category) {
                $category_link = get_category_link($category->term_id);
                
                echo '<url>' . "\n";
                echo '<loc>' . $category_link . '</loc>' . "\n";
                echo '<changefreq>weekly</changefreq>' . "\n";
                echo '<priority>0.5</priority>' . "\n";
                echo '</url>' . "\n";
            }
            
            // 獲取標籤
            $tags = get_tags();
            
            if ($tags) {
                foreach ($tags as $tag) {
                    $tag_link = get_tag_link($tag->term_id);
                    
                    echo '<url>' . "\n";
                    echo '<loc>' . $tag_link . '</loc>' . "\n";
                    echo '<changefreq>monthly</changefreq>' . "\n";
                    echo '<priority>0.3</priority>' . "\n";
                    echo '</url>' . "\n";
                }
            }
            
            echo '</urlset>';
            exit;
        }
    }
    add_action('template_redirect', 'boxmoe_generate_sitemap');
}


