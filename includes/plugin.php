<?php

namespace Elementor_Pro_Max;

use Elementor_Pro_Max\Controls\Inject_Controls;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

final class Plugin
{


    const VERSION = '1.0.0';

    const MINIMUM_ELEMENTOR_VERSION = '3.21.0';

    const MINIMUM_PHP_VERSION = '7.4';

    private static $_instance = null;

    public $inject_controls = null;


    /* 单例模式 */
    public static function instance()
    {

        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }
    public function __construct()
    {

        add_action('elementor/init', [$this, 'base_init']);
        // add_action('elementor_pro/init', [$this, 'pro_init']);
    }

    public function load(){
        require_once( __DIR__ . '/controls/inject.php' );
    }

    public function base_init()
    {
        $this->load();

        $this->inject_controls = new Inject_Controls();

        add_action('elementor/editor/before_enqueue_scripts', [$this,'editor_style']);
        add_action('elementor/frontend/before_enqueue_scripts', [$this,'pro_max_style']);

    }

    public function pro_init(){

    }

    public function editor_style(): void
    {
        wp_enqueue_style(
            'elementor-pro-max-editor',
            plugins_url('../assets/css/elementor-editor.min.css', __FILE__),
            self::VERSION
        );
    }
    public function pro_max_style(): void
    {
        wp_enqueue_style(
            'elementor-pro-max',
            plugins_url('../assets/css/elementor-pro-max.min.css', __FILE__),
            self::VERSION
        );
    }
}
