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
    'name' => __('系統最佳化', 'ui_boxmoe_com'),
    'icon' => 'dashicons-performance',
    'type' => 'heading');
    
    $options[] = array(
        'group' => 'start',
	    'group_title' => '寫作類相關開關最佳化',
        'name' => __('關閉古騰堡編輯器', 'ui_boxmoe_com'),
        'id' => 'boxmoe_gutenberg_switch',
        'type' => "checkbox",
        'std' => false,
        'desc' => __('若開啟則關閉古騰堡編輯器', 'ui_boxmoe_com'),
        );
    $options[] = array(
        'name' => __('停用文章自動儲存', 'ui_boxmoe_com'),
        'id' => 'boxmoe_autosave_switch',
        'type' => "checkbox",
        'std' => false,
        'desc' => __('若開啟則停用文章自動儲存', 'ui_boxmoe_com'),
        );
    $options[] = array(
        'name' => __('停用文章修訂版本', 'ui_boxmoe_com'),
        'id' => 'boxmoe_revision_switch',
        'type' => "checkbox",
        'std' => false,
        'desc' => __('若開啟則停用文章修訂版本', 'ui_boxmoe_com'),
        );
    $options[] = array(
        'group' => 'end',
        'name' => __('停用XMLRPC介面', 'ui_boxmoe_com'),
        'id' => 'boxmoe_xmlrpc_switch',
        'type' => "checkbox",
        'std' => false,
        'desc' => __('建議開啟，若需要使用介面發文章就關閉', 'ui_boxmoe_com'),
        );    
    $options[] = array(
        'group' => 'start',
        'group_title' => 'WP頁首頁尾多餘程式碼移除停用設定',
        'name' => __('頁首程式碼最佳化', 'ui_boxmoe_com'),
        'id' => 'boxmoe_wphead_switch',
        'type' => "checkbox",
        'std' => false,
        'desc' => __('建議開啟，如果外掛前端不能正常使用，請不要開啟', 'ui_boxmoe_com'),
        );
    $options[] = array(
        'name' => __('jQuery相容開關', 'ui_boxmoe_com'),
        'id' => 'boxmoe_jquery_switch',
        'type' => "checkbox",
        'std' => true,
        'desc' => __('預設開啟，如果不使用jquery的程式碼外掛可關閉', 'ui_boxmoe_com'),
        );
    $options[] = array(
        'name' => __('移除dns-prefetch', 'ui_boxmoe_com'),
        'id' => 'boxmoe_dns_prefetch_switch',
        'type' => "checkbox",
        'std' => false,
        'desc' => __('建議開啟', 'ui_boxmoe_com'),
        );
    $options[] = array(
        'name' => __('移除feed', 'ui_boxmoe_com'),
        'id' => 'boxmoe_feed_switch',
        'type' => "checkbox",
        'std' => false,
        'desc' => __('建議開啟', 'ui_boxmoe_com'),
        );
    $options[] = array(
        'name' => __('移除 Emojis', 'ui_boxmoe_com'),
        'id' => 'boxmoe_emojis_switch',
        'type' => "checkbox",
        'std' => false,
        'desc' => __('建議開啟', 'ui_boxmoe_com'),
        );
    $options[] = array(
        'group' => 'end',
        'name' => __('移除 embeds', 'ui_boxmoe_com'),
        'id' => 'boxmoe_embeds_switch',
        'type' => "checkbox",
        'std' => false,
        'desc' => __('建議開啟', 'ui_boxmoe_com'),
        );
    $options[] = array(
        'group' => 'start',
        'group_title' => '安全項最佳化設定',
        'name' => __('禁止非管理員存取後台', 'ui_boxmoe_com'),
        'id' => 'boxmoe_no_admin_switch',
        'type' => "checkbox",
        'std' => true,
        'desc' => __('預設開啟，則禁止非管理員存取後台', 'ui_boxmoe_com'),
        );
    $options[] = array(     
        'name' => __('最佳化資料庫-自動清理', 'ui_boxmoe_com'),
        'id' => 'boxmoe_optimize_database_switch',
        'type' => "checkbox",
        'std' => false,
        'desc' => __('若開啟，則每日0點自動最佳化資料表', 'ui_boxmoe_com'),
        );
    $options[] = array(
        'name' => __('移除WordPress版本號', 'ui_boxmoe_com'),
        'desc' => __('若開啟，則移除WordPress版本號', 'ui_boxmoe_com'),
        'id' => 'boxmoe_remove_wp_version_switch',
        'type' => "checkbox",
        'std' => false,
        );
    $options[] = array(
        'name' => __('停用REST API', 'ui_boxmoe_com'),
        'desc' => __('若開啟，則停用REST API', 'ui_boxmoe_com'),
        'id' => 'boxmoe_disable_rest_api_switch',
        'type' => "checkbox",
        'std' => false,
        );
    $options[] = array(
        'name' => __('禁止Trackbacks', 'ui_boxmoe_com'),
        'desc' => __('建議開啟', 'ui_boxmoe_com'),
        'id' => 'boxmoe_trackbacks_switch',
        'type' => "checkbox",
        'std' => false,
        );
    $options[] = array(
        'group' => 'end',
        'name' => __('禁止Pingback', 'ui_boxmoe_com'),
        'desc' => __('建議開啟', 'ui_boxmoe_com'),
        'id' => 'boxmoe_pingbacks_switch',
        'type' => "checkbox",
        'std' => false,
        );