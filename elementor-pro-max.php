<?php
/**
 * Plugin Name: Elementor Pro Max
 * Description: 超大桶 Elementor
 * Plugin URI:  
 * Version:     1.0.0
 * Author:      JellyDai
 * Author URI:  
 * Text Domain: elementor-pro-max
 *
 */

// 检查是否定义了ABSPATH，如果没有定义则退出脚本执行
defined('ABSPATH') || exit;

/**
 * 定义Elementor Pro Max 版本号。
 */
define( 'ELEMENTOR_PRO_MAX_VERSION', '1.0.0' );

/**
 * 定义Elementor Pro Max 主文件的路径。
 */
define( 'ELEMENTOR_PRO_MAX__FILE__', __FILE__ );

/**
 * 定义Elementor Pro Max 插件的基础名称。
 */
define( 'ELEMENTOR_PRO_MAX_PLUGIN_BASE', plugin_basename( ELEMENTOR_PRO_MAX__FILE__ ) );

/**
 * 定义Elementor Pro Max 插件的目录路径。
 */
define( 'ELEMENTOR_PRO_MAX_PATH', plugin_dir_path( ELEMENTOR_PRO_MAX__FILE__ ) );

/**
 * 定义Elementor Pro Max 插件的URL。
 */
define( 'ELEMENTOR_PRO_MAX_URL', plugins_url( '/', ELEMENTOR_PRO_MAX__FILE__ ));

/**
 * 定义Elementor Pro Max 插件资产目录的路径。
 */
define( 'ELEMENTOR_PRO_MAX_ASSETS_PATH', ELEMENTOR_PRO_MAX_PATH . 'assets/' );

/**
 * 定义Elementor Pro Max 插件资产目录的URL。
 */
define( 'ELEMENTOR_PRO_MAX_ASSETS_URL', ELEMENTOR_PRO_MAX_URL . 'assets/' );

/**
 * 初始化Elementor Pro Max插件的函数。
 *
 * 此函数在WordPress的'plugins_loaded'钩子触发时，
 * 负责加载插件的核心文件并实例化插件类。
 *
 * @since 1.0.0
 */
function elementor_pro_max_run() {
    // 加载插件的主要文件以启动插件。
    require_once( __DIR__ . '/includes/plugin.php' );
    \Elementor_Pro_Max\Plugin::instance();
}

// 将'elementor_pro_max_run'函数绑定到'plugins_loaded'动作钩子。
add_action( 'plugins_loaded', 'elementor_pro_max_run' );