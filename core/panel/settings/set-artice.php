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
    'name' => __('文章設定', 'ui_boxmoe_com'),
    'icon' => 'dashicons-admin-post',
    'type' => 'heading');

    $options[] = array(
        'name' => __('文章新視窗開啟選項', 'ui_boxmoe_com'),
        'id' => 'boxmoe_article_new_window_switch',
        'type' => "checkbox",
        'std' => false,
        'desc' => __('若開啟則文章新視窗開啟', 'ui_boxmoe_com'),
        );
    $options[] = array(
        'name' => __('開啟所有文章形式支援', 'ui_boxmoe_com'),
        'id' => 'boxmoe_article_support_switch',
        'type' => "checkbox",
        'std' => false,
        'desc' => __('若開啟則開啟所有文章形式支援', 'ui_boxmoe_com'),
        );
    $options[] = array(
        'group' => 'start',
        'group_title' => '縮圖尺寸自訂設定',
        'name' => __('縮圖尺寸自訂開關', 'ui_boxmoe_com'),
        'id' => 'boxmoe_article_thumbnail_size_switch',
        'type' => "checkbox",
        'std' => false,
        );
    $options[] = array(
        'name' => __('縮圖寬度', 'ui_boxmoe_com'),
        'id' => 'boxmoe_article_thumbnail_width',
        'type' => "text",
        'std' => '300',
        'class' => 'mini',
        );
    $options[] = array(
        'group' => 'end',
        'name' => __('縮圖高度', 'ui_boxmoe_com'),
        'id' => 'boxmoe_article_thumbnail_height',
        'type' => "text",
        'std' => '200',
        'class' => 'mini',
        );
    $options[] = array(
        'group' => 'start',
        'group_title' => '文章縮圖隨機API',
        'name' => __('文章縮圖隨機API', 'ui_boxmoe_com'),
        'id' => 'boxmoe_article_thumbnail_random_api',
        'type' => "checkbox",
        'std' => false,
        'desc' => __('文章縮圖隨機API僅在文章沒有設定縮圖時生效', 'ui_boxmoe_com'),
        );  
    $options[] = array(
        'group' => 'end',
        'name' => __('文章縮圖隨機API URL', 'ui_boxmoe_com'),
        'id' => 'boxmoe_article_thumbnail_random_api_url',
        'type' => "text",
        'class' => '',
        'std' => 'https://api.boxmoe.com/random.php?size=small',
        'desc' => __('文章縮圖隨機API URL', 'ui_boxmoe_com'),
        );  
    $options[] = array(
	    'name' => __('文章列表分頁模式', 'ui_boxmoe_com'),
	    'id' => 'boxmoe_article_paging_type',
	    'std' => "multi",
	    'type' => "radio",
	    'options' => array(
		    'next' => __('上一頁 和 下一頁', 'ui_boxmoe_com'),
		    'multi' => __('頁碼  1 2 3 ', 'ui_boxmoe_com'),
            //'loadmore' => __('點選載入更多(未使用)', 'ui_boxmoe_com'),
	    ));
    $options[] = array(    
        'group' => 'start',
        'group_title' => '文章打賞&點讚設定',
        'name' => __('點讚開關', 'ui_boxmoe_com'),
        'id' => 'boxmoe_like_switch',
        'type' => "checkbox",
        'std' => false,
        );        
    $options[] = array(
        'name' => __('文章打賞開關', 'ui_boxmoe_com'),
        'id' => 'boxmoe_reward_switch',
        'type' => "checkbox",
        'std' => false,
        'desc' => __('若開啟則顯示打賞按鈕', 'ui_boxmoe_com'),
        );

    $options[] = array(
        'name' => __('打賞QR碼-微信', 'ui_boxmoe_com'),
        'id' => 'boxmoe_reward_qrcode_weixin',
        'type' => "text",
        'std' => '',
        'desc' => __('打賞QR碼-微信QR碼位址', 'ui_boxmoe_com'),
        );
    $options[] = array(    
        'group' => 'end',
        'name' => __('打賞QR碼-支付寶', 'ui_boxmoe_com'),
        'id' => 'boxmoe_reward_qrcode_alipay',
        'type' => "text",
        'std' => '',
        'desc' => __('打賞QR碼-支付寶QR碼位址', 'ui_boxmoe_com'),
        );

