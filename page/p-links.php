<?php 
/**
 * Template Name: 友情連結
 * @link https://www.boxmoe.com
 * @package lolimeow
 */
get_header();
?>
            <div class="col-md-12 mx-auto">
            <div class="blog-single">
            <?php while (have_posts()) : the_post(); ?>
                <div class="post-single">
                      <h1 class="single-title"><?php the_title(); ?></h1>
                      <hr class="horizontal dark">
                    <div class="single-content">
                        <?php the_content(); ?>
                    </div>
                    <div class="bookmark">
                        <?php
                        // 取得所有連結分類
                        $link_cats = get_terms('link_category');
                        
                        // 記錄所有已分類連結的ID
                        $categorized_link_ids = array();

                        // 先顯示分類中的連結
                        if ($link_cats) {
                            foreach ($link_cats as $cat) {
                                // 取得每個分類下的連結
                                $links = get_bookmarks(array(
                                    'category' => $cat->term_id,
                                    'orderby' => 'rating',
                                    'order' => 'DESC'
                                ));
                                
                                if ($links) {
                                    echo '<h2 class="main-reveal">';
                                    echo '<span>' . esc_html($cat->name) . ' (' . count($links) . ')</span>';
                                    echo '<p>' . esc_html($cat->description) . '</p>';
                                    echo '</h2>';
                                    echo '<ul class="main-reveal">';
                                    
                                    foreach ($links as $link) {
                                        // 記錄已分類連結的ID
                                        $categorized_link_ids[] = $link->link_id;
                                        ?>
                                        <li class="text-reveal">
                                            <a class="on" href="<?php echo esc_url($link->link_url); ?>" target="_blank">
                                                <div class="icon">
                                                    <img src="<?php echo esc_url($link->link_image); ?>" alt="<?php echo esc_attr($link->link_name); ?>">
                                                </div>
                                                <div class="info">
                                                    <h3><?php echo esc_html($link->link_name); ?></h3>
                                                    <p title="<?php echo esc_attr($link->link_description); ?>"><?php echo esc_html($link->link_description); ?></p>
                                                </div>
                                                <div class="profile">
                                                    <div class="imgbox">
                                                        <img src="<?php echo esc_url($link->link_image); ?>" alt="<?php echo esc_attr($link->link_name); ?>">
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <?php
                                    }
                                    echo '</ul>';
                                }
                            }
                        }

                        // 取得真正未分類的連結（不在任何分類中的連結）
                        $all_links = get_bookmarks(array(
                            'orderby' => 'rating',
                            'order' => 'DESC'
                        ));

                        $truly_uncategorized = array();
                        foreach ($all_links as $link) {
                            // 如果連結ID不在已分類連結ID陣列中，則添加到真正未分類陣列
                            if (!in_array($link->link_id, $categorized_link_ids)) {
                                $truly_uncategorized[] = $link;
                            }
                        }

                        // 顯示真正未分類的連結
                        if ($truly_uncategorized) {
                            echo '<h2 class="main-reveal">';
                            echo '<span>未分類 (' . count($truly_uncategorized) . ')</span>';
                            echo '<p>未歸類的友情連結</p>';
                            echo '</h2>';
                            echo '<ul class="main-reveal">';
                            
                            foreach ($truly_uncategorized as $link) {
                            ?>
                            <li class="text-reveal">
                                <a class="on" href="<?php echo esc_url($link->link_url); ?>" target="_blank">
                                    <div class="icon">
                                        <img src="<?php echo esc_url($link->link_image); ?>" alt="<?php echo esc_attr($link->link_name); ?>">
                                    </div>
                                    <div class="info">
                                        <h3><?php echo esc_html($link->link_name); ?></h3>
                                        <p title="<?php echo esc_attr($link->link_description); ?>"><?php echo esc_html($link->link_description); ?></p>
                                    </div>
                                    <div class="profile">
                                        <div class="imgbox">
                                            <img src="<?php echo esc_url($link->link_image); ?>" alt="<?php echo esc_attr($link->link_name); ?>">
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <?php
                            }
                            echo '</ul>';
                        }

                        // 如果沒有任何連結，顯示提示資訊
                        if (empty($all_links)) {
                            echo '<p>暫無連結</p>';
                        }
                        ?>
                    </div>
                </div>
                <?php endwhile; ?>
                <?php if (comments_open()) : ?>
                    <?php comments_template('', true); ?>
                <?php endif; ?>
            </div>
        </div>
<?php
get_footer();
?>


<?php
get_footer();
