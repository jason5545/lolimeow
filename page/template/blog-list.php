<?php
/**
 * @link https://www.boxmoe.com
 * @package lolimeow
 */
//boxmoe.com===安全設定=阻止直接存取主題檔案
if(!defined('ABSPATH')){echo'Look your sister';exit;}
?>
        <div class="<?php echo boxmoe_layout_setting(); ?> blog-post">
        <?php while ( have_posts() ) : the_post(); ?>
          <?php 
          // 檢查文章是否有縮圖
          $has_thumbnail = false;
          global $post;
          if (has_post_thumbnail() || get_post_meta(get_the_ID(), '_thumbnail', true) || preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches)) {
            $has_thumbnail = true;
          }
          ?>
          <article class="post-list list-one row <?php echo boxmoe_border_setting(); ?> <?php echo (!$has_thumbnail) ? 'no-thumbnail' : ''; ?>">
            <?php if ($has_thumbnail) : ?>
            <div class="post-list-img">
              <figure class="mb-4 mb-lg-0 zoom-img">
                <a <?php echo boxmoe_article_new_window(); ?> href="<?php echo get_the_permalink(); ?>" title="<?php echo get_the_title().get_the_subtitle(false).boxmoe_title_link().get_bloginfo('name')?>">
                  <img src="<?php boxmoe_lazy_load_images(); ?>" data-src="<?php echo boxmoe_article_thumbnail_src(); ?>?id<?php echo get_the_ID(); ?>" alt="<?php the_title(); ?>" class="img-fluid rounded-3 lazy"></a>
              </figure>
            </div>
            <?php endif; ?>
            <div class="post-list-content <?php echo (!$has_thumbnail) ? 'col-12 text-center' : ''; ?>">
              <div class="category">
                <div class="tags">
                  <?php 
                  $categories = get_the_category();
                  if (!empty($categories)) {
                      $first_category = $categories[0]; ?>
                      <a href="<?php echo esc_url(get_category_link($first_category->term_id)); ?>" title="檢視《<?php echo esc_attr($first_category->name); ?>》分類下的所有文章" rel="category tag">
                        <i class="tagfa fa fa-dot-circle-o"></i><?php echo esc_html($first_category->name); ?>
                      </a>
                  <?php } ?>
                </div>
              </div>
              <div class="mt-2 mb-2">
                <h3 class="post-title h4">
                  <a href="<?php echo get_the_permalink(); ?>" title="<?php echo get_the_title().get_the_subtitle(false).boxmoe_title_link().get_bloginfo('name')?>" class="text-reset"><?php echo get_the_title(); ?></a></h3>
                <p class="post-content"><?php echo _get_excerpt(); ?></p></div>
              <div class="post-meta <?php echo (!$has_thumbnail) ? 'justify-content-center' : ''; ?> align-items-center">
                <div class="post-meta-info d-flex flex-row align-items-center">
                  <span class="list-post-view">
                    <i class="fa fa-street-view"></i><?php echo getPostViews(get_the_ID()); ?></span>
                  <span class="list-post-comment">
                    <i class="fa fa-comments-o"></i><?php echo get_comments_number(); ?></span>
                  <span class="list-post-author">
                    <i class="fa fa-at"></i><?php echo get_the_author(); ?>
                    <span class="dot"></span><?php echo get_the_date(); ?></span>
                </div>
              </div>
            </div>
          </article>
        <?php endwhile; ?>
          <div class="col-lg-12 col-md-12 pagenav">
            <?php boxmoe_pagination(); ?>            
          </div>
        </div>