<?php
/**
 * @package   Options_Framework
 * @author    Devin Price <devin@wptheming.com>
 * @license   GPL-2.0+
 * @link      http://wptheming.com
 * @copyright 2010-2014 WP Theming
 */

class Options_Framework_Admin {

	/**
	 * 選項頁面的頁面掛勾
	 *
	 * @since 1.7.0
	 * @type string
	 */
	protected $options_screen = null;

	/**
	 * 載入必要的樣式與腳本
	 *
	 * @since 1.7.0
	 */
	public function init() {

		// 取得要載入的選項
		$options = & Options_Framework::_optionsframework_options();

		// 檢查是否有可用的選項
		if ( $options ) {

			// 加入選項頁面及選單項目
			add_action( 'admin_menu', array( $this, 'add_custom_options_page' ) );

			// 載入必要的樣式和腳本
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );

			// 設定必須於 admin_init 後註冊
			add_action( 'admin_init', array( $this, 'settings_init' ) );

			// 將選項選單加入工具列
			add_action( 'wp_before_admin_bar_render', array( $this, 'optionsframework_admin_bar' ) );

		}

	}

	/**
	 * 註冊設定
	 *
	 * @since 1.7.0
	 */
	function settings_init() {

		// 取得選項名稱
		$options_framework = new Options_Framework;
		$name = $options_framework->get_option_name();

		// 註冊設定欄位及回呼函式
		register_setting( 'optionsframework', $name, array ( $this, 'validate_options' ) );

		// 儲存選項後顯示提示訊息
		add_action( 'optionsframework_after_validate', array( $this, 'save_options_notice' ) );

	}

	/*
	 * 定義選單相關設定
	 *
	 * 使用範例：
	 *
	 * add_filter( 'optionsframework_menu', function( $menu ) {
	 *     $menu['page_title'] = '選項設定';
	 *     $menu['menu_title'] = '選項設定';
	 *     return $menu;
	 * });
	 *
	 * @since 1.7.0
	 *
	 */
	static function menu_settings() {

		$menu = array(

			// 模式：submenu, menu
			'mode' => 'submenu',

			// 子選單預設設定
			'page_title' => __( '盒子萌主題設定', 'textdomain' ),
			'menu_title' => __( '盒子萌主題設定', 'textdomain' ),
			'capability' => 'edit_theme_options',
			'menu_slug' => 'boxmoe_options',
			'parent_slug' => 'themes.php',

			// 選單預設設定
			'icon_url' => 'dashicons-admin-generic',
			'position' => '61'

		);

		return apply_filters( 'optionsframework_menu', $menu );
	}

	/**
	 * 將「佈景主題選項」子頁加入外觀選單
	 *
	 * @since 1.7.0
	 */
	function add_custom_options_page() {

		$menu = $this->menu_settings();

		switch ( $menu['mode'] ) {

			case 'menu':
				// 參考文件：http://codex.wordpress.org/Function_Reference/add_menu_page
				$this->options_screen = add_menu_page(
					$menu['page_title'],
					$menu['menu_title'],
					$menu['capability'],
					$menu['menu_slug'],
					array( $this, 'options_page' ),
					$menu['icon_url'],
					$menu['position']
				);
				break;
			default:
				// 參考文件：http://codex.wordpress.org/Function_Reference/add_submenu_page
				$this->options_screen = add_submenu_page(
					$menu['parent_slug'],
					$menu['page_title'],
					$menu['menu_title'],
					$menu['capability'],
					$menu['menu_slug'],
					array( $this, 'options_page' )
				);
				break;
		}

	}

	/**
	 * 載入必要的樣式表
	 *
	 * @since 1.7.0
	 */
	function enqueue_admin_styles( $hook ) {

		if ( $this->options_screen != $hook )
			return;

		wp_enqueue_style( 'optionsframework', OPTIONS_FRAMEWORK_DIRECTORY . 'css/optionsframework.css', array(), Options_Framework::VERSION );
		wp_enqueue_style( 'wp-color-picker' );
	}

	/**
	 * 載入必要的 JavaScript
	 *
	 * @since 1.7.0
	 */
	function enqueue_admin_scripts( $hook ) {

		if ( $this->options_screen != $hook )
			return;

		// 載入自訂選項面板 JS
		wp_enqueue_script( 'options-custom', OPTIONS_FRAMEWORK_DIRECTORY . 'js/options-custom.js', array( 'jquery', 'wp-color-picker' ), Options_Framework::VERSION );

		// 從 options-interface.php 引入內嵌腳本
		add_action( 'admin_head', array( $this, 'of_admin_head' ) );
	}

	function of_admin_head() {
		// 使用掛勾加入自訂腳本
		do_action( 'optionsframework_custom_scripts' );
	}

	/**
	 * 建構選項面板介面
	 *
	 * 如果當初採用 Settings API 原生方式，則會使用 do_settings_sections
	 * 包裹設定選項。但因為我們不希望設定以表格呈現，所以改用自訂的
	 * optionsframework_fields。詳細說明請參考 options-interface.php。
	 *
	 * Nonce 透過 settings_fields() 提供
	 *
	 * @since 1.7.0
	 */
	function options_page() { ?><?php $menu = $this->menu_settings(); ?>
	  
		<div id="optionsframework-wrap" class="wrap">
			<?php settings_errors( 'options-framework' ); ?>
			<div class="set-main-plane">
				<div class="set-main-menu">
					<div class="boxmoe-options-site-name">
						盒子萌主題
						<svg width="24" height="24" viewBox="0 0 24 24">
							<path d="M11.5,22C11.64,22 11.77,22 11.9,21.96C12.55,21.82 13.09,21.38 13.34,20.78C13.44,20.54 13.5,20.27 13.5,20H9.5A2,2 0 0,0 11.5,22M18,10.5C18,7.43 15.86,4.86 13,4.18V3.5A1.5,1.5 0 0,0 11.5,2A1.5,1.5 0 0,0 10,3.5V4.18C7.13,4.86 5,7.43 5,10.5V16L3,18V19H20V18L18,16M19.97,10H21.97C21.82,6.79 20.24,3.97 17.85,2.15L16.42,3.58C18.46,5 19.82,7.35 19.97,10M6.58,3.58L5.15,2.15C2.76,3.97 1.18,6.79 1,10H3C3.18,7.35 4.54,5 6.58,3.58Z"></path>
						</svg>
					</div>
					<div class="nav-tab-wrapper">
						<?php echo Options_Framework_Interface::optionsframework_tabs(); ?>
					</div>
				</div>

				<div id="optionsframework-metabox" class="metabox-holder">
					<div class="header-set-title">
						<h2 class="themes-name"><i class="navon"></i><?php echo esc_html( $menu['page_title'] ); ?></h2>
						<a href="https://www.boxmoe.com/706.html" target="_blank" rel="external nofollow" class="el-button">
							<i class="cx cx-begin"></i> 線上文件 | 最後更新：<span id="dbox"></span>
						</a>
					</div>
					<div id="optionsframework" class="postbox">
						<form action="options.php" method="post">
							<?php settings_fields( 'optionsframework' ); ?>
							<?php Options_Framework_Interface::optionsframework_fields(); /* 設定選項 */ ?>
					</div>
					<?php do_action( 'optionsframework_after' ); ?>

				</div> <!-- / .wrap -->
			</div>
			<div id="optionsframework-submit">
				<input type="submit" class="button-primary" name="update" value="<?php esc_attr_e( '儲存設定', 'textdomain' ); ?>" />
				<input type="submit" class="reset-button button-secondary" name="reset" value="<?php esc_attr_e( '重置所有設定', 'textdomain' ); ?>" onclick="return confirm( '<?php print esc_js( __( '警告：點選確定後，所有先前的設定變更將全部捨棄！', 'textdomain' ) ); ?>' );" />
				<div class="clear"></div>
			</div>
					</form>
		</div>
		<script>
		document.addEventListener('DOMContentLoaded', function() {
		  var navon = document.querySelector('.navon');
		  var setMainPlane = document.querySelector('.set-main-plane');

		  if (navon && setMainPlane) {
		    navon.addEventListener('click', function(event) {
		      event.stopPropagation(); // 阻止事件冒泡，避免點選 <i> 時觸發 document 的點擊事件
		      setMainPlane.classList.toggle('on');
		    });

		    document.addEventListener('click', function(event) {
		      if (event.target !== navon) {
		        setMainPlane.classList.remove('on');
		      }
		    });
		  }
		});
		var boxmoe_version = function () {
		    var dboxElement = document.getElementById("dbox");
		    dboxElement.innerHTML = "取得中...";

		    fetch("https://doc.boxmoe.com/api/lolimeow")
		        .then(response => response.json())
		        .then(data => {
		            dboxElement.innerHTML = data.date;
					document.getElementById("vbox").innerHTML = data.version;
		        })
		        .catch(error => {
		            console.error('Error:', error);
		            dboxElement.innerHTML = "取得失敗";
		        });
		};

		boxmoe_version();
		</script>
	<?php
	}

	/**
	 * 驗證選項
	 *
	 * 當點選儲存/重置按鈕後執行此函式以驗證所有輸入值。
	 *
	 * @uses $_POST['reset'] 來還原預設選項
	 */
	function validate_options( $input ) {

		/*
		 * 還原預設值
		 *
		 * 若使用者點選「還原預設」按鈕，
		 * 此函式將會以 options.php 中所定義的預設選項
		 * 覆蓋現有的主題設定。
		 */

		if ( isset( $_POST['reset'] ) ) {
			add_settings_error( 'options-framework', 'restore_defaults', __( '已恢復預設選項！', 'textdomain' ), 'updated fade' );
			return $this->get_default_values();
		}

		/*
		 * 更新設定
		 *
		 * 原先用來檢查 $_POST['update']，現已調整為相容於 WordPress 3.4
		 * 引入之主題客製化功能
		 */

		$clean = array();
		$options = & Options_Framework::_optionsframework_options();
		foreach ( $options as $option ) {

			if ( ! isset( $option['id'] ) ) {
				continue;
			}

			if ( ! isset( $option['type'] ) ) {
				continue;
			}

			$id = preg_replace( '/[^a-zA-Z0-9._\-]/', '', strtolower( $option['id'] ) );

			// 若未在 $_POST 中送出 checkbox，則將其值設為 false
			if ( 'checkbox' == $option['type'] && ! isset( $input[$id] ) ) {
				$input[$id] = false;
			}

			// 若未在 $_POST 中送出 multicheck 的各項值，則逐項設為 false
			if ( 'multicheck' == $option['type'] && ! isset( $input[$id] ) ) {
				foreach ( $option['options'] as $key => $value ) {
					$input[$id][$key] = false;
				}
			}

			// 為確保資料正確，所有待送入資料庫的值皆經過淨化過濾
			if ( has_filter( 'of_sanitize_' . $option['type'] ) ) {
				$clean[$id] = apply_filters( 'of_sanitize_' . $option['type'], $input[$id], $option );
			}
		}

		// 驗證後掛勾
		do_action( 'optionsframework_after_validate', $clean );

		return $clean;
	}

	/**
	 * 顯示儲存提示訊息
	 */
	function save_options_notice() {
		add_settings_error( 'options-framework', 'save_options', __( '設定已儲存成功！', 'textdomain' ), 'updated fade' );
	}

	/**
	 * 取得所有主題選項的預設值
	 *
	 * 從 options.php 中定義的設定檔，建立出一個包含所有預設值的陣列。
	 * 陣列中的每個項目皆必須定義 'id'、'std' 及 'type' 鍵值，
	 * 若任一鍵值不存在，則該選項不會納入回傳陣列中。
	 *
	 * @return array 以選項 ID 為索引的預設值陣列。
	 */
	function get_default_values() {
		$output = array();
		$config = & Options_Framework::_optionsframework_options();
		foreach ( (array) $config as $option ) {
			if ( ! isset( $option['id'] ) ) {
				continue;
			}
			if ( ! isset( $option['std'] ) ) {
				continue;
			}
			if ( ! isset( $option['type'] ) ) {
				continue;
			}
			if ( has_filter( 'of_sanitize_' . $option['type'] ) ) {
				$output[$option['id']] = apply_filters( 'of_sanitize_' . $option['type'], $option['std'], $option );
			}
		}
		return $output;
	}

	/**
	 * 將選項選單項目加入管理工具列
	 */
	function optionsframework_admin_bar() {

		$menu = $this->menu_settings();

		global $wp_admin_bar;

		if ( 'menu' == $menu['mode'] ) {
			$href = admin_url( 'admin.php?page=' . $menu['menu_slug'] );
		} else {
			$href = admin_url( 'themes.php?page=' . $menu['menu_slug'] );
		}

		$args = array(
			'parent' => 'appearance',
			'id'     => 'of_theme_options',
			'title'  => $menu['menu_title'],
			'href'   => $href
		);

		$wp_admin_bar->add_menu( apply_filters( 'optionsframework_admin_bar', $args ) );
	}

}
