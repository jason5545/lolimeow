<?php
/**
 * @link https://www.boxmoe.com
 * @package lolimeow
 */

//安全設定=阻止直接存取主題文件
if(!defined('ABSPATH')){
    echo'看你妹';
    exit;
}
function optionsframework_option_name() {
	return 'options-framework-theme';
}
function optionsframework_options() {
    //獲取分類
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}
	//獲取標籤
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}
	//獲取頁面
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = '請選擇頁面';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}
	//定義圖片路徑
	$image_path =  get_template_directory_uri() . '/assets/images/';
	$web_home = 'https://www.boxmoe.com';
	$THEME_VERSION = THEME_VERSION;
	$options = array();
//基礎設定-----------------------------------------------------------
require_once get_template_directory() . '/core/panel/settings/set-basis.php';
//Banner設定-----------------------------------------------------------
require_once get_template_directory() . '/core/panel/settings/set-banner.php';
//SEO最佳化-----------------------------------------------------------
require_once get_template_directory() . '/core/panel/settings/set-seo.php';
//文章設定-----------------------------------------------------------
require_once get_template_directory() . '/core/panel/settings/set-artice.php';
//留言設定-----------------------------------------------------------
require_once get_template_directory() . '/core/panel/settings/set-comment.php';  
//用戶設定-----------------------------------------------------------
require_once get_template_directory() . '/core/panel/settings/set-user.php';
//社交圖示-----------------------------------------------------------
require_once get_template_directory() . '/core/panel/settings/set-social.php';
//靜態加速-----------------------------------------------------------
require_once get_template_directory() . '/core/panel/settings/set-assets.php';
//系統最佳化-----------------------------------------------------------
require_once get_template_directory() . '/core/panel/settings/set-optimize.php';
//訊息通知-----------------------------------------------------------
require_once get_template_directory() . '/core/panel/settings/set-msg.php';
//主題信息-----------------------------------------------------------
require_once get_template_directory() . '/core/panel/settings/set-theme.php';






  
//-----------------------------------------------------------
	return $options;
}
