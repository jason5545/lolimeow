<?php
/**
 * @link https://www.boxmoe.com
 * @package lolimeow
 */

//boxmoe.com===安全設定=防止直接存取主題檔案
if(!defined('ABSPATH')){
    echo'看你妹';
    exit;
}

$options[] = array(
    'name' => __( 'Banner設定', 'ui_boxmoe_com' ),
    'icon' => 'dashicons-format-gallery',
    'desc' => __( '（導覽下的圖片設定）', 'ui_boxmoe_com' ),
    'type' => 'heading'
);
    $options[] = array(
        'group' => 'start',
		'group_title' => 'Banner歡迎語一言設定',
		'name' => __( 'Banner歡迎語', 'ui_boxmoe_com' ),
		'desc' => __('（留空則不顯示）', 'ui_boxmoe_com'),
		'id' => 'boxmoe_banner_font',
		'std' => 'Hello! 歡迎來到盒子萌！',
		'type' => 'text');
    $options[] = array(
		'name' => __('banner一言開關', 'ui_boxmoe_com'),
		'id' => 'boxmoe_banner_hitokoto_switch',
		'type' => "checkbox",
		'std' => false,
		);
        $hitokoto_array = array(
			'a' => __('動畫', 'ui_boxmoe_com'),
			'b' => __('漫畫', 'ui_boxmoe_com'),
			'c' => __('遊戲', 'ui_boxmoe_com'),
			'd' => __('文學', 'ui_boxmoe_com'),
			'e' => __('原創', 'ui_boxmoe_com'),
			'f' => __('來自網路', 'ui_boxmoe_com'),	
			'g' => __('其他', 'ui_boxmoe_com'),
			'h' => __('影視', 'ui_boxmoe_com'),
			'i' => __('詩詞', 'ui_boxmoe_com'),
			'j' => __('網易雲', 'ui_boxmoe_com'),
			'k' => __('哲學', 'ui_boxmoe_com'),
		);
    $options[] = array(
        'group' => 'end',
		'name' => __('選擇一言句子類型', 'ui_boxmoe_com'),
		'id' => 'boxmoe_banner_hitokoto_text',
		'type' => 'select',
		'options' => $hitokoto_array);
    $options[] = array(
        'group' => 'start',
		'group_title' => '自訂banner高度開關',
		'id' => 'boxmoe_banner_height_switch',
		'type' => "checkbox",
		'std' => false,
		);
    $options[] = array(
		'name' => __( '[電腦端]Banner高度 留空則預設580', 'ui_boxmoe_com' ),
		'id' => 'boxmoe_banner_height',
		'std' => '580',
		'class' => 'mini',
		'type' => 'text');
	$options[] = array(
		'name' => __( '[手機端]Banner高度 留空預設480', 'ui_boxmoe_com' ),
		'id' => 'boxmoe_banner_height_m',
		'std' => '480',
		'class' => 'mini',
		'group' => 'end',
		'type' => 'text');	
    $options[] = array(
		'name' => __('自訂Banner背景圖', 'ui_boxmoe_com'),
		'id' => 'boxmoe_banner_url',
		'std' => $image_path.'/banner/assets/images/banner.jpg',
		'type' => 'upload');
    $options[] = array(
		'group' => 'start',
		'group_title' => 'Banner隨機圖片',
		'name' => __('Banner開啟本地隨機圖片', 'ui_boxmoe_com'),
		'desc' => __('（自動檢索本地assets/images/banner/資料夾的jpg\jpeg\png\gif\webp圖片）', 'ui_boxmoe_com'),
		'id' => 'boxmoe_banner_rand_switch',
		'class' => 'mini',
        'std' => false,
		'type' => 'checkbox');
    $options[] = array(
		'name' => __('使用外部APi-Banner圖片', 'ui_boxmoe_com'),
		'desc' => __('（開啟後上方本地設定圖片功能全失效）', 'ui_boxmoe_com'),		
		'id' => 'boxmoe_banner_api_switch',
		'type' => "checkbox",
		'std' => false,
		);
	$options[] = array(
        'group' => 'end',
		'name' => __('圖片外部APi連結', 'ui_boxmoe_com'),
		'id' => 'boxmoe_banner_api_url',
		'std' => 'https://api.boxmoe.com/random.php?size=mw1024',
		'type' => 'text');     