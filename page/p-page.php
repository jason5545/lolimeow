<?php
/**
 * Template Name: 单页-默认
 * @link https://www.boxmoe.com
 * @package lolimeow
 */
//boxmoe.com===安全设置=防止直接访问主题文件
if(!defined('ABSPATH')){echo'Look your sister';exit;}
get_header(); 
get_template_part('page/template/blog-page');
get_sidebar();
get_footer();
?>
