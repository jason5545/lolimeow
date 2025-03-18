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
    'name' => __('社群圖示', 'ui_boxmoe_com'),
    'icon' => 'dashicons-share',
    'type' => 'heading'); 

    $options[] = array(
        'group' => 'start',
        'group_title' => '社群圖示設定',
        'name' => __('Facebook', 'ui_boxmoe_com'),
        'id' => 'boxmoe_social_facebook',
        'type' => 'text',
        'std' => '',
        'class' => 'small',
        'desc' => __('Facebook連結，留空則不顯示', 'ui_boxmoe_com'),
        );
    $options[] = array(        
        'name' => __('Email', 'ui_boxmoe_com'),
        'id' => 'boxmoe_social_email',
        'type' => 'text',
        'std' => '',
        'desc' => __('Email位址，留空則不顯示', 'ui_boxmoe_com'),
        'class' => 'mini',
        );    
    $options[] = array(
        'name' => __('Twitter (X)', 'ui_boxmoe_com'),
        'id' => 'boxmoe_social_twitter',
        'type' => 'text',
        'std' => '',
        'desc' => __('Twitter (X) 連結，留空則不顯示', 'ui_boxmoe_com'),
        'class' => 'small',
        );   
    $options[] = array(
        'name' => __('Instagram', 'ui_boxmoe_com'),
        'id' => 'boxmoe_social_instagram',
        'type' => 'text',
        'std' => '',
        'desc' => __('Instagram連結，留空則不顯示', 'ui_boxmoe_com'),
        'class' => 'small',
        );
    $options[] = array(
        'name' => __('Telegram', 'ui_boxmoe_com'),
        'id' => 'boxmoe_social_telegram',
        'type' => 'text',
        'std' => '',
        'desc' => __('Telegram連結，留空則不顯示', 'ui_boxmoe_com'),
        'class' => 'small',
        );
    $options[] = array(
        'group' => 'end',
        'name' => __('GitHub', 'ui_boxmoe_com'),
        'id' => 'boxmoe_social_github',
        'type' => 'text',
        'std' => '',
        'desc' => __('GitHub連結，留空則不顯示', 'ui_boxmoe_com'),
        'class' => 'small',
        );