<?php

namespace Elementor_Pro_Max;

use Elementor_Pro_Max\Controls\Controls_Manager;
use Elementor_Pro_Max\Widgets\Widgets_Manager;
use Elementor_Pro_Max\Tags\Tags_Manager;

defined('ABSPATH') || exit;

final class Plugin
{

    /**
     * 单例类的实例变量。
     * 
     * 该变量用于存储单例类的唯一实例。单例模式是一种设计模式，
     * 它确保一个类只有一个实例，并提供一个全局访问点来获取这个实例。
     * 在这个类中，$instance 变量是静态的，
     * 它与类本身相关联，而不是与类的实例相关联。
     * 无论创建了多少个类的实例，这个变量都只存在一个副本。
     * 
     * @var Plugin
     */
    public static $instance = null;

    public $controls_manager = null;

    public $widgets_manager = null;

    public $tags_manager = null;

    /**
     * 静态方法用于获取类的单例实例。
     * 
     * 如果实例尚未创建，则此方法将创建并返回一个新的实例。如果实例已经存在，
     * 则直接返回现有的实例。这种方法确保了无论多少次调用，都只会返回一个类的单个实例，
     * 符合单例设计模式的要求。
     * 
     * @return static 返回类的单例实例。
     */
    public static function instance()
    {
        // 检查实例是否已经存在，如果不存在则创建
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        // 返回现有的或新创建的实例
        return self::$instance;
    }

    /**
     * 类构造函数。
     * 
     * 初始化插件通过注册自动加载器并为插件的不同初始化阶段设置动作。
     * 
     * - 注册自动加载器以高效加载类文件。
     * - 向'elementor/init'事件添加动作钩子，在Elementor初始化时初始化基本功能。
     * - 向'elementor_pro/init'事件添加动作钩子，在Elementor Pro初始化时初始化专业功能。
     */
    public function __construct()
    {
        $this->register_autoloader();

        // 在Elementor初始化时，挂钩到'elementor/init'动作以初始化基础特性。
        add_action('elementor/init', [$this, 'base_init']);
        // 在Elementor Pro初始化时，挂钩到'elementor_pro/init'动作以初始化专业特性。
        add_action('elementor_pro/init', [$this, 'pro_init']);
    }

    public function base_init()
    {
        $this->init_components();

        add_action( 'elementor/editor/after_enqueue_styles', [$this,'editor_style'] );
        add_action( 'elementor/frontend/after_enqueue_styles', [$this,'frontend_style'] );
    }
    public function pro_init()
    {
    }

    private function init_components()
    {
        $this->controls_manager = new Controls_Manager();

        $this->widgets_manager = new Widgets_Manager();

        $this->tags_manager = new Tags_Manager();
    }

    /**
     * 注册自动加载器。
     * 
     * 本函数负责引入Elementor Pro插件的自动加载器脚本并启动自动加载过程。
     * 它确保了插件的类和接口可以在需要时自动加载，而不需要显式地包含每个文件。
     * 这样做可以简化代码结构，减少文件包含的冗余，提高代码的可维护性。
     * 
     * 注： 只加载 includes中的文件
     * 
     * @access private
     */
    private function register_autoloader()
    {
        // 引入Elementor Pro自动加载器脚本
        require_once ELEMENTOR_PRO_MAX_PATH . '/includes/autoloader.php';

        // 启动自动加载器
        Autoloader::run();
    }

    public function editor_style() : void {
        wp_enqueue_style('elepm-editor-style', ELEMENTOR_PRO_MAX_ASSETS_URL . 'css/elementor-editor.min.css');
    }

    public function frontend_style() : void {
        wp_enqueue_style('elepm-frontend-style', ELEMENTOR_PRO_MAX_ASSETS_URL . 'css/elementor-pro-max.min.css');
    }


}
