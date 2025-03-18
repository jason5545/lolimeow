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
    'name' => __('SEO最佳化', 'ui_boxmoe_com'),
    'icon' => 'dashicons-chart-line',
    'type' => 'heading');

    $options[] = array(
        'group' => 'start',
	    'group_title' => '搜尋引擎推送設定',
        'name' => __('Google推送開關', 'ui_boxmoe_com'),
        'id' => 'boxmoe_google_submit_switch',
        'desc' => __('開啟後下方填寫Google Search Console網站驗證及網站地圖提交設定', 'ui_boxmoe_com'),
        'class' => 'small',
        'type' => "checkbox",
        'std' => false,
        );
    $options[] = array(
	    'id' => 'boxmoe_google_api_key',
	    'std' => '',
        'class' => 'small',
	    'type' => 'text'
        ); 

    $options[] = array(
        'name' => __('Bing推送開關', 'ui_boxmoe_com'),
        'id' => 'boxmoe_bing_submit_switch',
        'desc' => __('開啟後下方填寫Bing Webmaster Tools API Key', 'ui_boxmoe_com'),
        'type' => "checkbox",
        'std' => false,
        );
    $options[] = array(
	    'id' => 'boxmoe_bing_api_key',
	    'std' => '',
        'class' => 'small',
	    'type' => 'text'
        );   

    $options[] = array(
        'name' => __('Yandex推送開關', 'ui_boxmoe_com'),
        'desc' => __('開啟後下方填寫Yandex Webmaster驗證ID', 'ui_boxmoe_com'),
        'id' => 'boxmoe_yandex_submit_switch',
        'type' => "checkbox",
        'std' => false,
        );
    $options[] = array(
	    'id' => 'boxmoe_yandex_api_key',
	    'std' => '',
        'class' => 'small',
	    'type' => 'text'
        );
        
    $options[] = array(
        'name' => __('百度推送開關', 'ui_boxmoe_com'),
        'id' => 'boxmoe_baidu_submit_switch',
        'desc' => __('開啟後下方填寫百度推送Token Key', 'ui_boxmoe_com'),
        'type' => "checkbox",
        'std' => false,
        );
    $options[] = array(
	    'id' => 'boxmoe_baidu_token',
	    'std' => '',
        'class' => 'small',
	    'type' => 'text'
        );

    $options[] = array(
        'name' => __('360推送開關', 'ui_boxmoe_com'),
        'id' => 'boxmoe_360_submit_switch',
        'desc' => __('開啟後下方填寫360推送API Key', 'ui_boxmoe_com'),
        'type' => "checkbox",
        'std' => false,
        'group' => 'end',
        );
    $options[] = array(
	    'id' => 'boxmoe_360_api_key',
	    'std' => '',
        'class' => 'small',
	    'group' => 'end',
	    'type' => 'text'
        );

    $options[] = array(
        'group' => 'start',
        'group_title' => '網站頁首設定',
        'name' => __('網站標題連接符', 'ui_boxmoe_com'),
        'id' => 'boxmoe_title_link',
        'type' => "text",
        'std' => '-',
        'class' => 'mini',
        'desc' => __('網站標題連接符，預設是"-"', 'ui_boxmoe_com'),
        );
    $options[] = array(
        'name' => __('網站關鍵詞', 'ui_boxmoe_com'),
        'id' => 'boxmoe_keywords',
        'type' => "textarea",
        'settings' => array('rows' => 3),
        'std' => 'wordpress,boxmoe,lolimeow',
        'desc' => __('網站關鍵詞，多個關鍵詞用英文逗號隔開', 'ui_boxmoe_com'),
        );

    $options[] = array(
        'name' => __('網站描述', 'ui_boxmoe_com'),
        'id' => 'boxmoe_description',
        'type' => "textarea",
        'settings' => array('rows' => 3),
        'std' => '這是一個wordpress網站的描述',
        'desc' => __('網站描述', 'ui_boxmoe_com'),
        );

    $options[] = array(
		'name' => __('網站自動新增關鍵字和描述', 'ui_boxmoe_com'),
		'desc' => __('（開啟後所有頁面將自動使用主題配置的關鍵字和描述）', 'ui_boxmoe_com'),
		'id' => 'boxmoe_auto_keywords_description_switch',
		'type' => "checkbox",
		'std' => true,
		);    

    $options[] = array(
        'group' => 'end',
		'name' => __('自訂文章關鍵字和描述', 'ui_boxmoe_com'),
		'desc' => __('（開啟後你需要在編輯文章的時候撰寫關鍵字和描述，如果為空，將自動使用主題配置的關鍵字和描述；開啟這個必須開啟上面的"網站自動新增關鍵字和描述"開關）', 'ui_boxmoe_com'),
		'id' => 'boxmoe_post_keywords_description_switch',
		'type' => "checkbox",
		'std' => false,
		);