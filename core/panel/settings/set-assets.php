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
    'name' => __('靜態加速', 'ui_boxmoe_com'),
    'icon' => 'dashicons-performance',
    'type' => 'heading'); 
    $options[] = array(
        'group' => 'start',
        'group_title' => '靜態資源加速設定項目',
        'name' => __('靜態資源加速開關', 'ui_boxmoe_com'),
        'id' => 'boxmoe_cdn_assets_switch',
        'type' => "checkbox",
        'std' => false,
        );
    $options[] = array(
        'group' => 'end',
        'name' => __('靜態資源加速url', 'ui_boxmoe_com'),
        'id' => 'boxmoe_cdn_assets_url',
        'type' => "text",
        'std' => '',
        'desc' => __('(如https://domain.com/lolimeow/assets)，連結結尾不要帶"/"', 'ui_boxmoe_com'),
        );
	$gravatar_array = array(
		'cravatar' => __('cravatar源', 'ui_boxmoe_com'),
        'weavatar' => __('cravatar備用源', 'ui_boxmoe_com'),
		'qiniu' => __('七牛源', 'ui_boxmoe_com'),
		'geekzu' => __('極客源', 'ui_boxmoe_com'),
		'v2excom' => __('v2ex源', 'ui_boxmoe_com'),
		'cn' => __('預設CN源', 'ui_boxmoe_com'),
		'ssl' => __('預設SSL源', 'ui_boxmoe_com'),
	);
    $options[] = array(
        'group' => 'start',
        'group_title' => '前端頭像加速伺服器',
        'name' => __('Gravatar頭像', 'ui_boxmoe_com'),
        'desc' => __('（透過鏡像伺服器可對gravatar頭像進行加速）', 'ui_boxmoe_com'),
        'id' => 'boxmoe_gravatar_url',       
        'std' => 'lolinet',
        'type' => 'select',
        'class' => 'mini', //mini, tiny, small
        'options' => $gravatar_array);
    
    $qqravatar_array = array(
		'Q1' => __('QQ官方伺服器1', 'ui_boxmoe_com'),
		'Q2' => __('QQ官方伺服器2', 'ui_boxmoe_com'),
		'Q3' => __('QQ官方伺服器3', 'ui_boxmoe_com'),
		'Q4' => __('QQ官方伺服器4', 'ui_boxmoe_com'),	
	);    
    $options[] = array(
        'name' => __('QQ頭像', 'ui_boxmoe_com'),
        'desc' => __('（如果使用者是QQ信箱則調用QQ頭像）', 'ui_boxmoe_com'),
        'id' => 'boxmoe_qqavatar_url',
        'group' => 'end',
        'std' => 'Q2',
        'type' => 'select',
        'class' => 'mini', //mini, tiny, small
        'options' => $qqravatar_array);	