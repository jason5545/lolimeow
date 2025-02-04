<?php 
/**
 * Template Name: Boxmoe无侧栏单页
 * @link https://www.boxmoe.com
 * @package lolimeow
 */
//=======安全设置，阻止直接访问主题文件=======
if (!defined('ABSPATH')) {echo'Look your sister';exit;}
//=========================================
 get_header(); ?>
      <section class="section-blog-breadcrumb container">
        <div class="breadcrumb-head">
          <span>
            <i class="fa fa-home"></i>Page</span>
        </div>
      </section>
      <section id="boxmoe_theme_container">
        <div class="container">
          <div class="row">
            <div class="blog-single  col-lg-12 mx-auto fadein-bottom">
              <div class="post-single <?php echo boxmoe_border()?>"><?php while (have_posts()) : the_post(); ?>
                <H1 class="single-title"><?php the_title(); echo get_the_subtitle(); ?></H1>
                <hr class="horizontal dark">
                <div class="single-content">
				        <?php the_content(); ?>
                 <?php wp_link_pages(array('before' => '<div class="fenye pagination justify-content-center">', 'after' => '</div>', 'next_or_number' => 'number','link_before' =>'<span>', 'link_after'=>'</span>')); ?>  
                </div>
                <?php endwhile; ?>
                <?php if (get_boxmoe('comments_off')): ?>
                <div class="thw-sept"></div> 
                <?php comments_template( '', true); ?>
                <?php endif; ?>	
              </div>
            </div>
            </div>
        </div>
      </section>

<?php
get_footer();