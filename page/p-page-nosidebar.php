<?php
/**
 * Template Name: 單頁-無側欄
 * @link https://www.boxmoe.com
 * @package lolimeow
 */
//boxmoe.com===安全設置=防止直接存取主題檔案
if(!defined('ABSPATH')){echo'Look your sister';exit;}
get_header(); 
get_template_part('page/template/blog-page-nosidebar');
get_footer();
?>
