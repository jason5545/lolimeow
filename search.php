<?php
/**
 * @link https://www.boxmoe.com
 * @package lolimeow
 */
//boxmoe.com===安全設置=防止直接存取主題檔案
if(!defined('ABSPATH')){echo'Look your sister';exit;}
get_header(); ?>
		<div class="container fadein-bottom">
					<div class="site-search">
						<h1 class="search-title">
						<i class="fa fa-search"></i>
						<span>搜尋:<strong>[<?php echo htmlspecialchars($s); ?>]</strong>關鍵詞<?php global $wp_query;echo ' 共' . $wp_query->found_posts . ' 篇文章';?></span></h1>
                </div>
		</div>
<?php get_template_part('page/template/blog-list');
get_sidebar();
get_footer();
?>