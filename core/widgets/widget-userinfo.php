<?php
/**
 * @link https://www.boxmoe.com
 * @package lolimeow
 */
//=======安全设置，阻止直接访问主题文件=======
if (!defined('ABSPATH')) {echo'Look your sister';exit;}
//=========================================

class widget_userinfo extends WP_Widget {

	function __construct(){
		parent::__construct( 
			'widget_userinfo', 
			'Boxmoe_用户信息', 
			array( 
				'description' => __('用户信息侧栏小工具', 'boxmoe-com'),
				'classname'   => __('widget-userinfo', 'boxmoe-com')
			) 
		);
	}
	
	// 小工具前端显示
	public function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters('widget_name', $instance['title']);
		$nickname = isset($instance['nickname']) ? $instance['nickname'] : '昵称在这里';
		$bio = isset($instance['bio']) ? $instance['bio'] : '个人简介文字';
		$avatarid = isset($instance['avatarid']) ? $instance['avatarid'] : 1;
		$avatar_url = boxmoe_get_avatar_url($avatarid, 100);
		echo $before_widget;
		echo $before_title . $title . $after_title;
		echo '<div class="widget-content">';	
		echo '
		<div class="widget-profile">
			<div class="profile-avatar">
				<img src="'.boxmoe_lazy_load_images().'"  class="lazy" data-src="'.esc_url($avatar_url).'" alt="avatar">
			</div>
			<h3 class="profile-name">'. esc_html($nickname) .'</h3>
			<p class="profile-desc">'. esc_html($bio) .'</p>
			<div class="profile-social">';
			if(!empty($instance['show_twitter'])) {
				echo '<a href="#social-links" class="social-link"><i class="fa fa-twitter"></i></a>';
			}
			if(!empty($instance['show_email'])) {
				echo '<a href="#social-links" class="social-link"><i class="fa fa-envelope"></i></a>';
			}
			echo '</div>
			<div class="profile-stats">
				<div class="stat-item">
					<div class="stat-value">'. wp_count_posts('post')->publish .'</div>
					<div class="stat-label">文章</div>
				</div>
				<div class="stat-item">
					<div class="stat-value">'. $this->get_admin_comments_count() .'</div>
					<div class="stat-label">留言</div>
				</div>
				<div class="stat-item">
					<div class="stat-value">'. $this->format_number(get_user_count()) .'</div>
					<div class="stat-label">用戶</div>
				</div>
			</div>
		</div>';
		
		echo '</div>';
		echo $after_widget;
	}

	// 后台表单
	public function form( $instance ) {
		$defaults = array(
			'title' => __('个人信息', 'boxmoe-com'),
			'nickname' => '',
			'bio' => '',
			'avatarid' => '1',
			'show_facebook' => false,
			'show_twitter' => false,
			'show_email' => false,
			'show_github' => false,
			'show_telegram' => false,
			'show_instagram' => false
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>
		<p>
			<label>
				<?php echo __('標題：', 'boxmoe-com') ?>
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" 
					name="<?php echo $this->get_field_name('title'); ?>" type="text" 
					value="<?php echo esc_attr($instance['title']); ?>" />
			</label>
		</p>
		<p>
			<label>
				<?php echo __('暱稱：', 'boxmoe-com') ?>
				<input class="widefat" id="<?php echo $this->get_field_id('nickname'); ?>" 
					name="<?php echo $this->get_field_name('nickname'); ?>" type="text" 
					value="<?php echo esc_attr($instance['nickname']); ?>" />
			</label>
		</p>
		<p>
			<label>
				<?php echo __('個人簡介：', 'boxmoe-com') ?>
				<textarea class="widefat" id="<?php echo $this->get_field_id('bio'); ?>" 
					name="<?php echo $this->get_field_name('bio'); ?>"><?php echo esc_textarea($instance['bio']); ?></textarea>
			</label>
		</p>
		<p>
			<label>
				<?php echo __('用戶ID：', 'boxmoe-com') ?>
				<input class="widefat" id="<?php echo $this->get_field_id('avatarid'); ?>" 
					name="<?php echo $this->get_field_name('avatarid'); ?>" type="number" 
					value="<?php echo esc_attr($instance['avatarid']); ?>" />
			</label>
		</p>
		<p>
			<label>
				<input type="checkbox" id="<?php echo $this->get_field_id('show_twitter'); ?>"
					name="<?php echo $this->get_field_name('show_twitter'); ?>"
					<?php checked($instance['show_twitter']); ?> />
				<?php echo __('顯示Twitter圖標', 'boxmoe-com') ?>
			</label>
		</p>
		<p>
			<label>
				<input type="checkbox" id="<?php echo $this->get_field_id('show_email'); ?>"
					name="<?php echo $this->get_field_name('show_email'); ?>"
					<?php checked($instance['show_email']); ?> />
				<?php echo __('顯示電子郵件信箱圖標', 'boxmoe-com') ?>
			</label>
		</p>
	<?php
	}

	// 更新小工具设置
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['nickname'] = sanitize_text_field( $new_instance['nickname'] );
		$instance['bio'] = sanitize_textarea_field( $new_instance['bio'] );
		$instance['avatarid'] = absint( $new_instance['avatarid'] );
		$instance['show_facebook'] = !empty($new_instance['show_facebook']);
		$instance['show_twitter'] = !empty($new_instance['show_twitter']);
		$instance['show_email'] = !empty($new_instance['show_email']);
		$instance['show_github'] = !empty($new_instance['show_github']);
		$instance['show_telegram'] = !empty($new_instance['show_telegram']);
		$instance['show_instagram'] = !empty($new_instance['show_instagram']);
		return $instance;
	}

	private function get_admin_comments_count() {
		$admin_users = get_users(array(
			'role__in' => array('administrator'),
			'fields'   => array('ID')
		));
		
		return get_comments(array(
			'status'     => 'approve',
			'author__in' => wp_list_pluck($admin_users, 'ID'),
			'count'      => true
		));
	}

	private function format_number($num) {
		if ($num >= 1000000) {
			$formatted = number_format($num / 1000000, 1);
			return rtrim(rtrim($formatted, '0'), '.') . 'M';
		} elseif ($num >= 1000) {
			$formatted = number_format($num / 1000, 1);
			return rtrim(rtrim($formatted, '0'), '.') . 'K';
		}
		return $num;
	}
}



