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
    'name' => __('留言設定', 'ui_boxmoe_com'),
    'icon' => 'dashicons-admin-comments',
    'type' => 'heading');     

    $options[] = array(
        'group' => 'start',
        'group_title' => '留言開關設定',
        'name' => __('全站留言關閉', 'ui_boxmoe_com'),
        'id' => 'boxmoe_comment_switch',
        'type' => "checkbox",
        'std' => false,
        );
    $options[] = array(
        'name' => __('僅登入留言開關', 'ui_boxmoe_com'),
        'id' => 'boxmoe_comment_login_switch',
        'type' => "checkbox",
        'std' => false,
        );
    $options[] = array(
        'name' => __('禁止純英文留言', 'ui_boxmoe_com'),
        'id' => 'boxmoe_comment_english_switch',
        'type' => "checkbox",
        'std' => false,
        );
    $options[] = array(
        'group' => 'end',
        'name' => __('部落格主標籤自訂', 'ui_boxmoe_com'),
        'id' => 'boxmoe_comment_blogger_tag',
        'type' => "text",
        'std' => '部落格主',
        'desc' => __('部落格主標籤，留空則顯示部落格主', 'ui_boxmoe_com'),
        'class' => 'mini',
        ); 