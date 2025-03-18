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
    'name' => __('使用者設定', 'ui_boxmoe_com'),
    'icon' => 'dashicons-admin-users',
    'type' => 'heading'); 

    $options[] = array(
        'name' => __('開啟導覽會員註冊連結', 'ui_boxmoe_com'),
        'id' => 'boxmoe_sign_in_link_switch',
        'type' => "checkbox",
        'std' => false,
        'desc' => __('若開啟則導覽列將顯示會員註冊連結', 'ui_boxmoe_com'),
        );
    $options[] = array(
        'name' => __('使用者登入註冊頁面背景圖', 'ui_boxmoe_com'),
        'id' => 'boxmoe_user_login_bg',
        'type' => 'text',
        'std' => '',
        'desc' => __('（使用者登入註冊頁面背景圖，填寫圖片URL，支援API）', 'ui_boxmoe_com'),
        );    
    $options[] = array(
        'group' => 'start',
        'group_title' => '使用者中心連結設定',
        'name' => __('使用者中心選擇', 'ui_boxmoe_com'),
        'id' => 'boxmoe_user_center_link_page',
        'type' => "select",
        'std' => 'user_center',
        'options' => $options_pages
        );
    $options[] = array(
        'name' => __('註冊頁面選擇', 'ui_boxmoe_com'),
        'id' => 'boxmoe_sign_up_link_page',
        'type' => "select",
        'std' => 'user_center',
        'options' => $options_pages

        );
    $options[] = array(
        'name' => __('登入頁面選擇', 'ui_boxmoe_com'),
        'id' => 'boxmoe_sign_in_link_page',
        'type' => "select",
        'std' => 'user_center',
        'options' => $options_pages
        );
    $options[] = array(
        'name' => __('重設密碼頁面選擇', 'ui_boxmoe_com'),
        'id' => 'boxmoe_reset_password_link_page',
        'type' => "select",
        'std' => 'user_center',
        'options' => $options_pages
        );
    $options[] = array(
        'group' => 'end',
        'name' => __('前端儲值卡購買連結', 'ui_boxmoe_com'), 
        'id' => 'boxmoe_czcard_src',
        'std' => '',
        'desc' => __('（前端使用者儲值中心，儲值卡購買連結）', 'ui_boxmoe_com'),
        'type' => 'text'); 
