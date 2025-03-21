<?php
/**
 * @link https://www.boxmoe.com
 * @package lolimeow
 */

//boxmoe.com===安全設定=阻止直接存取主題檔案
if(!defined('ABSPATH')){
    echo'看你妹';
    exit;
}

$options[] = array(
    'name' => __('基礎設定', 'ui_boxmoe_com'),
    'icon' => 'dashicons-admin-settings',
    'type' => 'heading');

    $options[] = array(
        'group' => 'start',
		'group_title' => '網誌版面效果設定',
		'name' => __('網誌版面', 'ui_boxmoe_com'),
		'id' => 'boxmoe_blog_layout',
		'std' => "one",
		'type' => "radio",
		'options' => array(
			'one' => __('單欄版面', 'ui_boxmoe_com'),
			'two' => __('雙欄版面', 'ui_boxmoe_com')
		)); 
    $options[] = array(
		'name' => __('版面邊框', 'ui_boxmoe_com'),
		'id' => 'boxmoe_blog_border',
		'std' => "default",
		'type' => "radio",
		'options' => array(
			'default' => __('無邊框效果', 'ui_boxmoe_com'),
			'border' => __('漫畫邊框效果', 'ui_boxmoe_com'),
			'shadow' => __('陰影邊框效果', 'ui_boxmoe_com'),
			'lines' => __('線條邊框效果', 'ui_boxmoe_com')
		));
    $options[] = array(
        'name' => __('延遲載入自訂預留圖', 'ui_boxmoe_com'), 
        'id' => 'boxmoe_lazy_load_images',
        'std' => $image_path.'loading.gif',
        'class' => '',
        'type' => 'text');   

    $options[] = array(
		'name' => __('頁面過渡動畫', 'ui_boxmoe_com'),
		'id' => 'boxmoe_page_loading_switch',
		'type' => "checkbox",
		'std' => false,
		);    
    $options[] = array(
		'name' => __('網頁飄落櫻花', 'ui_boxmoe_com'),
		'id' => 'boxmoe_sakura_switch',
		'type' => "checkbox",
		'std' => false,
		);           
    $options[] = array(
        'group' => 'end',
		'name' => __('悼念模式-全站變灰', 'ui_boxmoe_com'),
		'id' => 'boxmoe_body_grey_switch',
		'type' => "checkbox",
		'std' => false,
		);
    $options[] = array(
        'group' => 'start',
        'group_title' => '節日燈籠開關設定',
		'id' => 'boxmoe_festival_lantern_switch',
		'type' => "checkbox",
		'std' => false,
		);
	$options[] = array(
		'name' => __( '燈籠文字(1)', 'ui_boxmoe_com' ),
		'id' => 'boxmoe_lanternfont1',
		'std' => '新',
		'class' => 'mini',
		'type' => 'text');
	$options[] = array(
		'name' => __( '燈籠文字(2)', 'ui_boxmoe_com' ),
		'id' => 'boxmoe_lanternfont2',
		'std' => '春',
		'class' => 'mini',
		'type' => 'text');
	$options[] = array(
		'name' => __( '燈籠文字(3)', 'ui_boxmoe_com' ),
		'id' => 'boxmoe_lanternfont3',
		'std' => '快',
		'class' => 'mini',
		'type' => 'text');
	$options[] = array(
        'group' => 'end',
		'name' => __( '燈籠文字(4)', 'ui_boxmoe_com' ),
		'id' => 'boxmoe_lanternfont4',
		'std' => '樂',
		'class' => 'mini',
		'type' => 'text');      
    $options[] = array(
		'name' => __( 'LOGO設定', 'ui_boxmoe_com' ),
		'id' => 'boxmoe_logo_src',
		'desc' => __(' ', 'ui_boxmoe_com'),
		'std' => $image_path.'logo.png',
		'type' => 'upload');      
    $options[] = array(
		'name' => __( 'Favicon位址', 'ui_boxmoe_com' ),
		'id' => 'boxmoe_favicon_src',
		'std' => $image_path.'favicon.ico',
		'type' => 'upload'); 
    $options[] = array(
		'name' => __('分類連結去除category識別', 'ui_boxmoe_com'),
		'desc' => __('（需主機偽靜態，開關都需要 後台導覽的 設定>固定連結 點選儲存一次）', 'ui_boxmoe_com'),
		'id' => 'boxmoe_no_categoty',
		'type' => "checkbox",
		'std' => false,
		);       
    $options[] = array(
        'group' => 'start',
		'group_title' => '網頁右側看板開關',
		'id' => 'boxmoe_lolijump_switch',
		'type' => "checkbox",
		'std' => false,
		); 
	$options[] = array(
        'group' => 'end',
		'name' => __('選擇前端看板形象', 'ui_boxmoe_com'),
		'id' => 'boxmoe_lolijump_img',
		'type' => "radio",
		'std' => 'lolisister1',
		'options' => array(
			'lolisister1' => __(' 看板蘿莉-姐姐 ', 'ui_boxmoe_com'),
			'lolisister2' => __(' 看板蘿莉-妹妹', 'ui_boxmoe_com'),
			'dance' => __(' 看板娘-舞娘娘', 'ui_boxmoe_com'),
			'meow' => __(' 看板娘-喵小娘', 'ui_boxmoe_com'),
			'lemon' => __(' 看板妹-檸檬妹', 'ui_boxmoe_com'),			
			'bear' => __(' 看板熊-熊寶寶', 'ui_boxmoe_com'),
		));

	$options[] = array(
        'group' => 'start',
		'group_title' => '頁尾設定',
		'name' => __('頁尾顯示頁面執行時間', 'ui_boxmoe_com'),
		'desc' => __('（預設關閉，開啟後頁尾顯示頁面執行時間）', 'ui_boxmoe_com'),
		'id' => 'boxmoe_footer_dataquery_switch',
		'type' => "checkbox",
		'std' => false,
		);	
	$options[] = array(
		'name' => __('網站頁尾導覽連結', 'ui_boxmoe_com'),
		'id' => 'boxmoe_footer_seo',
		'std' => '<li class="nav-item"><a href="'.site_url('/sitemap.xml').'" target="_blank" class="nav-link">網站地圖</a></li>'."\n",
		'desc' => __('（網站地圖可自行使用sitemap外掛自動產生）', 'ui_boxmoe_com'),
		'settings' => array('rows' => 3),
		'type' => 'textarea');
	$options[] = array(
		'name' => __('網站頁尾自訂資訊（如備案號支援HTML碼）', 'ui_boxmoe_com'),
		'id' => 'boxmoe_footer_info',
		'std' => '本站使用Wordpress創作'."\n",
		'settings' => array('rows' => 3),
		'type' => 'textarea');	
    $options[] = array(
		'name' => __('統計碼', 'ui_boxmoe_com'),
		'desc' => __('（頁尾第三方流量資料統計碼）', 'ui_boxmoe_com'),
		'id' => 'boxmoe_trackcode',
		'std' => '統計碼',
		'settings' => array('rows' => 3),
		'type' => 'textarea');
	$options[] = array(
        'group' => 'end',
		'name' => __('自訂碼', 'ui_boxmoe_com'),
		'desc' => __('（適用於自訂如css js碼置於頁尾載入）', 'ui_boxmoe_com'),
		'id' => 'boxmoe_diy_code_footer',
		'std' => '',
		'settings' => array('rows' => 3),
		'type' => 'textarea');   
		$options[] = array(
			'group' => 'start',
			'group_title' => '頁尾運作天數設定',
			'name' => __('頁尾運作天數開關', 'ui_boxmoe_com'),
			'id' => 'boxmoe_footer_running_days_switch',
			'type' => 'checkbox',
			'std' => false,
		);
		$options[] = array(
			'name' => __('建站時間', 'ui_boxmoe_com'),
			'id' => 'boxmoe_footer_running_days_time',
			'type' => 'text',
			'class' => 'mini',
			'std' => '2025-01-01',
		);
		$options[] = array(
			'name' => __('運作天數自訂文字前綴', 'ui_boxmoe_com'),
			'id' => 'boxmoe_footer_running_days_prefix',
			'type' => 'text',
			'class' => 'small',
			'std' => '本站已穩定運作了',
		);
		$options[] = array(
			'group' => 'end',
			'name' => __('運作天數自訂文字後綴', 'ui_boxmoe_com'),
			'id' => 'boxmoe_footer_running_days_suffix',
			'type' => 'text',
			'class' => 'small',
			'std' => '天',
		);
