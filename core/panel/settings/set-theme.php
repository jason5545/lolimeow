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

// 定義主題目錄 URL 路徑
$imagepath = get_template_directory_uri();

$options[] = array(
    'name' => __('主題設定', 'ui_boxmoe_com'),
    'icon' => 'dashicons-admin-users',
    'type' => 'heading');

$options[] = array(
    'name' => __('開放原始碼授權條款', 'ui_boxmoe_com'), 
    'id' => 'banquan',
    'desc' => __('
     <p>1.主題依託於開放原始碼授權條款 GPL V3.0，如果不接受本協議，請立即刪除</p>
     <p>2.請遵循開放原始碼授權條款，保留主題底部版權資訊，如果不接受本協議，請立即刪除；</p>		
    ', 'ui_boxmoe_com'),
    'type' => 'info');
$options[] = array(
    'name' => __('使用協議/注意事項', 'ui_boxmoe_com'), 
    'id' => 'shiyong',
    'desc' => __('
     <p>1.主題僅供部落格愛好者合法建站交流！禁止使用於違法用途！如主題使用者不能遵守此規定，請立即刪除；</p>
     <p>2.嚴禁利用本主題嚴重侵犯他人隱私權，如主題使用者不能遵守此規定，請立即刪除；</p>
     <p>3.使用主題請遵守網站伺服器當地相關法律和站長當地相關法律，如不能遵守請立即刪除；</p>
     <p>4.主題不支援任何作為非法違規用途網站！如不能遵守請立即刪除；</p>
     <p>5.主題開放原始碼無任何加密檔案，對於因用戶使用本主題而造成自身或他人隱私洩露，等任何不良後果，均由用戶自行承擔，主題作者不負任何責任；</p>
     <p>6.本主題共享下載，如果用戶自行下載使用，即表明用戶自願並接受本協議所有條款。 如果用戶不接受本協議，請立即刪除；</p>
    ', 'ui_boxmoe_com'),
    'type' => 'info');		
$options[] = array(
    'name' => __('主題資訊', 'ui_boxmoe_com'), 
    'id' => 'banquan',
    'desc' => __('
     <p>當前版本：'.$THEME_VERSION.'</p>
     <p>最新版本：<span id="vbox"></span></p>
     <p>檢視主題：<a href="https://www.boxmoe.com/468.html" target="_blank" rel="external nofollow" class="url">更新日誌</a></p>		
     <p>主題QQ群：<a href="http://qm.qq.com/cgi-bin/qm/qr?_wv=1027&k=YLb_jw14jGMh1q8cMwga9UZcWp6JDPsS&authKey=x8YpdYVOU%2BIyiJ8uSJ2gT9UJ%2B%2BByQjnaHTTaTjMAu9YIERV20NnM%2F7tfBB%2B39peo&noverify=0&group_code=24847519" target="_blank" rel="external nofollow" class="url">24847519</a></p>
     <p>TG群組：<a href="https://t.me/hezimeng" target="_blank" rel="external nofollow" class="url">https://t.me/hezimeng</a></p>
    ', 'ui_boxmoe_com'),
    'type' => 'info');		

$options[] = array(
    'group' => 'start',
    'group_title' => '主題風格設定',
    'name' => __('主題主色設定', 'ui_boxmoe_com'),
    'id' => 'boxmoe_main_color',
    'type' => 'color',
    'std' => '#f35ba2',
    'desc' => __('', 'ui_boxmoe_com'),
); 
$options[] = array(
    'group' => 'end',
    'name' => __('預設灰色切換', 'ui_boxmoe_com'),
    'id' => 'boxmoe_gray_switch',
    'type' => 'checkbox',
    'std' => false,
    'desc' => __('若開啟則網站顯示預設灰色', 'ui_boxmoe_com'),
);  
$options[] = array(
    'group' => 'start',
    'group_title' => '全站頂部導覽列顯示設定',
    'name' => __('全站頂部導覽列顯示&隱藏', 'ui_boxmoe_com'),
    'id' => 'boxmoe_navbar_hidden',
    'type' => 'checkbox',
    'std' => true,
    'desc' => __('若開啟則顯示頂部導覽列', 'ui_boxmoe_com'),
); 
$options[] = array(
    'name' => __('頂部導覽列向下滾動固定位置', 'ui_boxmoe_com'),
    'id' => 'boxmoe_navbar_sticky',
    'type' => 'checkbox',
    'std' => true,
    'desc' => __('如果開啟頂部導覽列，向下滾動後固定在頂部', 'ui_boxmoe_com'),
);
$options[] = array(
    'name' => __('頂部導覽列變色', 'ui_boxmoe_com'),
    'id' => 'boxmoe_navbar_color',
    'type' => 'checkbox',
    'std' => true,
    'desc' => __('如果開啟頂部導覽列，向下滾動後變色', 'ui_boxmoe_com'),
);  
$options[] = array(
    'group' => 'end',
    'name' => __('導覽列搜尋', 'ui_boxmoe_com'),
    'id' => 'boxmoe_navbar_search',
    'type' => 'checkbox',
    'std' => true,
    'desc' => __('若開啟則導覽列顯示搜尋', 'ui_boxmoe_com'),
);   
$options[] = array(
    'group' => 'start',
    'group_title' => '導覽列LOGO設定',
    'name' => __('導覽列Logo', 'ui_boxmoe_com'),
    'id' => 'boxmoe_logos',
    'type' => 'upload',
    'std' => get_template_directory_uri() . '/images/logo.png',
    'desc' => __('高度31px-40px,寬度根據圖示而定', 'ui_boxmoe_com'),
);
$options[] = array(
    'name' => __('導覽列LOGO', 'ui_boxmoe_com'),
    'id' => 'boxmoe_headlogoss',
    'type' => 'textarea',
    'std' => '<div class="lolimi">
        <i aria-hidden="true" class="fa fa-paw"></i><em>Lolimeow</em>
        </div>',
    'desc' => __('LOGO支援fontwasome 自定義導覽列LOGO格式,如預設的fa fa-paw fontwasome圖示Logo', 'ui_boxmoe_com'),
);
$options[] = array(
    'name' => __('導覽列標題', 'ui_boxmoe_com'),
    'id' => 'boxmoe_titles',
    'type' => 'text',
    'class' => 'mini',
    'std' => 'Lolimeow',
    'desc' => __('請填寫導覽列標題', 'ui_boxmoe_com'),
);
$options[] = array(
    'group' => 'end',
    'name' => __('頂部導覽列使用方式', 'ui_boxmoe_com'),
    'id' => 'boxmoe_navbar_logo',
    'type' => 'radio',
    'std' => 'titles',
    'options' => array(
        'logos' => __('Logo圖片', 'ui_boxmoe_com'),
        'headlogoss' => __('Logo文字(自定義)', 'ui_boxmoe_com'),
        'titles' => __('Logo文字', 'ui_boxmoe_com')
    ), 
);  
$options[] = array(
    'group' => 'start',
    'group_title' => '底部設定',
    'name' => __('底部版權文字', 'ui_boxmoe_com'),
    'id' => 'boxmoe_footertexts',
    'type' => 'text',
    'class' => 'mini',
    'std' => '© 2021 Content LOLIMEOW',
    'desc' => __('請填寫底部版權資訊', 'ui_boxmoe_com'),
);
$options[] = array(
    'name' => __('網站已運作時間', 'ui_boxmoe_com'),
    'id' => 'boxmoe_footer_runtime',
    'type' => 'checkbox',
    'std' => true,
    'desc' => __('若開啟則底部顯示網站已運作時間', 'ui_boxmoe_com'),
);
$options[] = array(
    'group' => 'end',
    'name' => __('建站時間', 'ui_boxmoe_com'),
    'id' => 'boxmoe_footer_runtime_code',
    'type' => 'text',
    'std' => '11/11/2018',
    'desc' => __('開啟網站已運作時間後，網站運作時間的開始時間，格式：月/日/年', 'ui_boxmoe_com'),
);
$options[] = array(
    'group' => 'start',
    'group_title' => '首頁設定',
    'name' => __('首頁文章列表風格', 'ui_boxmoe_com'),
    'id' => 'boxmoe_home_style',
    'type' => 'radio',
    'std' => 'card',
    'options' => array(
        'card' => __('卡片風格', 'ui_boxmoe_com'),
        'news' => __('新聞風格', 'ui_boxmoe_com')
    ),
);   
$options[] = array(
    'name' => __('首頁欄目頁側邊欄顯示', 'ui_boxmoe_com'),
    'id' => 'boxmoe_home_sidebar',
    'type' => 'radio',
    'std' => 'none',
    'options' => array(
        'none' => __('無側邊欄', 'ui_boxmoe_com'),
        'left' => __('左側邊欄', 'ui_boxmoe_com'),
        'right' => __('右側邊欄', 'ui_boxmoe_com')
    ),
);   
$options[] = array(
    'name' => __('首頁欄目頁側邊欄顯示1或2寬度', 'ui_boxmoe_com'),
    'id' => 'boxmoe_home_sidebarwidth',
    'type' => 'radio',
    'std' => 's1',
    'options' => array(
        's1' => __('寬度1', 'ui_boxmoe_com'),
        's2' => __('寬度2', 'ui_boxmoe_com')
    ),
);  
$options[] = array(
    'name' => __('首頁置頂文章開關', 'ui_boxmoe_com'),
    'id' => 'sticky_switch',
    'type' => 'checkbox',
    'std' => true,
    'desc' => __('若開啟則顯示置頂文章', 'ui_boxmoe_com'),
);
$options[] = array(
    'group' => 'end',
    'name' => __('卡片風格置頂文章數量', 'ui_boxmoe_com'),
    'id' => 'sticky_number',
    'type' => 'text',
    'class' => 'mini',
    'std' => '2',
    'desc' => __('填寫卡片風格置頂文章數量', 'ui_boxmoe_com'),
);
$options[] = array(
    'group' => 'start',
    'group_title' => '文章頁相關設定',
    'name' => __('文章頁側邊欄顯示', 'ui_boxmoe_com'),
    'id' => 'boxmoe_article_sidebar',
    'type' => 'radio',
    'std' => 'none',
    'options' => array(
        'none' => __('無側邊欄', 'ui_boxmoe_com'),
        'left' => __('左側邊欄', 'ui_boxmoe_com'),
        'right' => __('右側邊欄', 'ui_boxmoe_com')
    ),
);   
$options[] = array(
    'name' => __('文章頁側邊欄顯示1或2寬度', 'ui_boxmoe_com'),
    'id' => 'boxmoe_article_sidebarwidth',
    'type' => 'radio',
    'std' => 's1',
    'options' => array(
        's1' => __('寬度1', 'ui_boxmoe_com'),
        's2' => __('寬度2', 'ui_boxmoe_com')
    ),
);      
$options[] = array(
    'name' => __('文章上下導航', 'ui_boxmoe_com'),
    'id' => 'boxmoe_singlenav_switch',
    'type' => 'checkbox',
    'std' => true,
    'desc' => __('若開啟則文章頁顯示上下導航', 'ui_boxmoe_com'),
);
$options[] = array(
    'name' => __('文章目錄', 'ui_boxmoe_com'),
    'id' => 'boxmoe_post_directory',
    'type' => 'checkbox',
    'std' => true,
    'desc' => __('若開啟則文章頁顯示側邊目錄', 'ui_boxmoe_com'),
);   
$options[] = array(
    'name' => __('文章閱讀量顯示', 'ui_boxmoe_com'),
    'id' => 'boxmoe_viewed_switch',
    'type' => 'checkbox',
    'std' => true,
    'desc' => __('若開啟則文章列表及文章頁顯示閱讀量', 'ui_boxmoe_com'),
);
$options[] = array(
    'name' => __('文章最後更新時間顯示', 'ui_boxmoe_com'),
    'id' => 'boxmoe_post_modified_switch',
    'type' => 'checkbox',
    'std' => true,
    'desc' => __('若開啟則文章頁面顯示最後更新時間', 'ui_boxmoe_com'),
);
$options[] = array(
    'name' => __('文章分類標籤顯示', 'ui_boxmoe_com'),
    'id' => 'boxmoe_single_cat_tag',
    'type' => 'checkbox',
    'std' => true,
    'desc' => __('若開啟則文章頁面顯示分類標籤', 'ui_boxmoe_com'),
);