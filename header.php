<?php
/**
 * @package lolimeow@boxmoe themes
 * @link https://www.boxmoe.com
 */
// 安全設定，禁止直接存取佈景主題檔案
if (!defined('ABSPATH')) {
    echo '請勿直接存取。';
    exit;
}
//=========================================
?>
<!--
                   _ooOoo_
                  o8888888o
                  88" . "88
                  (| -_- |)
                  O\  =  /O
               ____/`---'\____
             .'  \\|     |//  `.
            /  \\|||  :  |||//  \
           /  _||||| -:- |||||-  \
           |   | \\\  -  /// |   |
           | \_|  ''\---/''  |   |
           \  .-\__  `-`  ___/-. /
         ___`. .'  /--.--\  `. . __
      ."" '<  `.___\_<|>_/___.'  >'"".
     | | :  `- \`.;`\ _ /`;.`/ - ` : | |
     \  \ `-.   \_ __\ /__ _/   .-` /  /
======`-.____`-.___\_____/___.-`____.-'======
                   `=---='
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
    祈禱順利運作，避免錯誤發生
-->
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title><?php echo boxmoe_title(); ?></title>
    <?php echo boxmoe_keywords(); ?>
    <?php echo boxmoe_description(); ?>
    <?php echo boxmoe_favicon(); ?>
    <!-- 預載字型，提升 LCP -->
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@100;300;400;500;700;900&display=swap" as="style">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@100;300;400;500;700;900&display=swap">
    <!-- 預載關鍵圖片 -->
    <link rel="preload" href="<?php echo get_template_directory_uri(); ?>/images/banner.jpg" as="image">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <?php wp_head(); ?>
    <?php if (get_boxmoe('banner_height')) { ?>
        <style>
            .section-blog-cover {
                height: <?php echo get_boxmoe('banner_height'); ?>px;
            }
        </style>
    <?php } ?>
    <?php if (get_boxmoe('m_banner_height')) { ?>
        <style>
            @media (max-width: 767px) {
                .section-blog-cover {
                    height: <?php echo get_boxmoe('m_banner_height'); ?>px;
                }
            }
        </style>
    <?php } ?>
</head>
<body style="font-family: 'Noto Sans TC', sans-serif;">
<?php if (get_boxmoe('boxmoe_preloader')) { ?>
    <div class="preloader">
        <!-- 動畫代碼 -->
    </div>
<?php } ?>
<?php echo boxmoe_load_lantern(); ?>
<div id="boxmoe_theme_global">
    <section id="boxmoe_theme_header" class="fadein-top">
        <nav class="navbar navbar-expand-lg navbar-bg-box">
            <div class="container">
                <a class="navbar-brand" href="<?php echo home_url(); ?>" title="<?php echo get_bloginfo('name'); ?>">
                    <?php echo boxmoe_logo(); ?></a>
                <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false"
                        aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">
                        <span class="navbar-toggler-bar bar1"></span>
                        <span class="navbar-toggler-bar bar2"></span>
                        <span class="navbar-toggler-bar bar3"></span>
                    </span>
                </button>
                <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="navigation"
                     aria-labelledby="offcanvasWithBothOptionsLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">
                            <?php echo boxmoe_logo(); ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav mx-auto">
                            <?php boxmoe_nav_menu(); ?>
                        </ul>
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a href="#search" class="nav-link search btn">
                                    <i class="fa fa-search"></i>
                                </a>
                            </li>
                            <?php if (get_boxmoe('sign_f')) { ?>
                                <?php if (!is_user_logged_in()) { ?>
                                    <li class="nav-item">
                                        <div class="user-wrapper">
                                            <div class="user-no-login">
                                                <span class="user-login">
                                                    <a href="<?php echo wp_login_url('?r=' . home_url()); ?>"
                                                       class="signin-loader z-bor">登入</a>
                                                    <b class="middle-text">
                                                        <span class="middle-inner">或</span></b>
                                                </span>
                                                <span class="user-reg">
                                                    <a href="<?php echo wp_registration_url(); ?>"
                                                       class="signup-loader l-bor">註冊</a></span>
                                            </div>
                                            <i class="up-new"></i>
                                        </div>
                                    </li>
                                <?php } else { ?>
                                    <li class="nav-item dropdown dropdown-hover nav-item">
                                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
                                           aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-user-circle-o"></i>您好！, <?php $current_user = wp_get_current_user();
                                            echo esc_html($current_user->user_login); ?></a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="<?php echo get_edit_user_link(); ?>" class="dropdown-item">
                                                    <i class="fa fa-address-card-o"></i>會員中心</a>
                                            </li>
                                            <li>
                                                <a href="<?php echo wp_logout_url(home_url()); ?>" class="dropdown-item">
                                                    <i class="fa fa-sign-out"></i>登出</a>
                                            </li>
                                        </ul>
                                    </li>
                                <?php } ?>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </section>
    <section class="section-blog-cover fadein-top" <?php echo boxmoe_banner(); ?>>
        <div class="site-main">
            <h2 class="text-gradient"><?php if (get_boxmoe('banner_font')) {
                    echo get_boxmoe('banner_font');
                } ?></h2>
            <?php if (get_boxmoe('hitokoto_on')) { ?>
                <h1 class="main-title">
                    <i class="fa fa-star spinner"></i>
                    <span id="hitokoto" class="text-gradient"></span>
                </h1>
            <?php } ?>
        </div>
        <div class="separator separator-bottom separator-skew">
            <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                 viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
                <defs>
                    <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z"></path>
                </defs>
                <g class="parallax">
                    <use xlink:href="#gentle-wave" x="48" y="0"></use>
                    <use xlink:href="#gentle-wave" x="48" y="3"></use>
                    <use xlink:href="#gentle-wave" x="48" y="5"></use>
                    <use xlink:href="#gentle-wave" x="48" y="7"></use>
                </g>
            </svg>
        </div>
    </section>
</div>
