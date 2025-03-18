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
    'name' => __('通知設定', 'ui_boxmoe_com'),
    'icon' => 'dashicons-admin-users',
    'type' => 'heading'); 
    $options[] = array(
        'name' => __('訊息設定說明', 'ui_boxmoe_com'), 
        'id' => 'boxmoe_msg_notice_info',
        'desc' => __('
         <p>1.SMTP發件系統開啟需要在SMTP設定中配置SMTP發件資訊<span style="color: #0073aa;cursor: pointer;" onclick="window.open(\'admin.php?page=boxmoe-smtp-settings\')">SMTP設定</span></p>
         <p>2.新留言新會員註冊通知部落格主訊息，郵件和機器人建議2選1，降低伺服器壓力，沒必要雙開雙通知</p>			
        ', 'ui_boxmoe_com'),
        'type' => 'info');

    $options[] = array(
        'group' => 'start',
        'group_title' => 'SMTP發件訊息通知設定開關',
        'name' => __('SMTP發件系統開關', 'ui_boxmoe_com'),
        'id' => 'boxmoe_smtp_mail_switch',
        'type' => "checkbox",
        'std' => false,
        'desc' => __('開啟後檢查smtp設定', 'ui_boxmoe_com'),
        );
        $options[] = array(
            'name' => __('新留言通知部落格主', 'ui_boxmoe_com'),
            'id' => 'boxmoe_new_comment_notice_switch',
            'type' => 'checkbox',
            'std' => false,
            'desc' => __('若開啟則新留言通知將使用SMTP發件系統', 'ui_boxmoe_com'),
        );
        $options[] = array(
            'group' => 'end',
            'name' => __('新會員註冊通知部落格主', 'ui_boxmoe_com'),
            'id' => 'boxmoe_new_user_register_notice_switch',
            'type' => 'checkbox',
            'std' => false,
            'desc' => __('若開啟則新會員註冊通知將使用SMTP發件系統', 'ui_boxmoe_com'),
        );      
        //機器人訊息通知
        $options[] = array(
            'group' => 'start',
            'group_title' => '機器人訊息通知設定開關',
            'name' => __('機器人訊息通知', 'ui_boxmoe_com'),
            'id' => 'boxmoe_robot_notice_switch',
            'type' => 'checkbox',
            'std' => false,
            'desc' => __('若開啟則機器人訊息通知將使用機器人系統', 'ui_boxmoe_com'),
        );
        //新留言通知
        $options[] = array(
            'name' => __('新留言通知部落格主', 'ui_boxmoe_com'),
            'id' => 'boxmoe_new_comment_notice_robot_switch',
            'type' => 'checkbox',
            'std' => false,
            'desc' => __('若開啟則新留言通知將使用機器人訊息通知', 'ui_boxmoe_com'),
        );
        //新會員註冊通知
        $options[] = array(
            'group' => 'end',
            'name' => __('新會員註冊通知部落格主', 'ui_boxmoe_com'),
            'id' => 'boxmoe_new_user_register_notice_robot_switch',
            'type' => 'checkbox',
            'std' => false,
            'desc' => __('若開啟則新會員註冊通知將使用機器人訊息通知', 'ui_boxmoe_com'),
        );
        $options[] = array(
            'name' => __('QQ機器人說明', 'ui_boxmoe_com'), 
            'id' => 'boxmoe_robot_notice_info',
            'desc' => __('
             <p>機器人介面基於NapCatQQ開發，需要先安裝NapCatQQ，然後獲取機器人介面URL</p>		
            ', 'ui_boxmoe_com'),
            'type' => 'info');
        $options[] = array(
            'group' => 'start',
            'group_title' => '機器人介面配置',
            'name' => __('機器人管道選擇', 'ui_boxmoe_com'),
            'id' => 'boxmoe_robot_channel',
            'type' => 'radio',
            'std' => 'qq_user',
            'options' => array(
                'qq_group' => __('QQ群', 'ui_boxmoe_com'),
                'qq_user' => __('個人QQ', 'ui_boxmoe_com'),
                'dingtalk' => __('釘釘', 'ui_boxmoe_com'),
                'telegram' => __('TG', 'ui_boxmoe_com'),
            ), 
        );
        $options[] = array(   
            'name' => __('機器人介面URL', 'ui_boxmoe_com'),
            'id' => 'boxmoe_robot_api_url',
            'type' => 'text',
            'std' => '',
            'desc' => __('請輸入機器人介面URL', 'ui_boxmoe_com'),
        );
        $options[] = array(
            'name' => __('機器人介面金鑰', 'ui_boxmoe_com'),
            'id' => 'boxmoe_robot_api_key',
            'type' => 'text',
            'class' => 'small',
            'std' => '',
            'desc' => __('請輸入機器人介面金鑰/TOKEN,留空則不使用', 'ui_boxmoe_com'),
        );
        $options[] = array(
            'group' => 'end',
            'name' => __('訊息接收人', 'ui_boxmoe_com'),
            'id' => 'boxmoe_robot_msg_user',
            'class' => 'mini',
            'type' => 'text',
            'std' => '',
            'desc' => __('QQ號碼\群號、TG用戶\群組\頻道ID,留空則不使用', 'ui_boxmoe_com'),
        );


