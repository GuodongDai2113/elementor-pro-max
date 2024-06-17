<?php

namespace Elementor_Pro_Max\Widgets;

defined('ABSPATH') || exit;

class Widgets_Manager{

    public function __construct() {
        add_action( 'elementor/elements/categories_registered', [$this,'add_elementor_widget_categories'] );

        add_action( 'elementor/widgets/register', [$this,'register_new_widgets' ]);
    }

    function register_new_widgets( $widgets_manager ) {

        // require_once( __DIR__ . '/widgets/widget-1.php' );
        
        $widgets_manager->register( new Download_List() );
    
    }

    function add_elementor_widget_categories( $elements_manager ) {

        $elements_manager->add_category(
            'elepm',
            [
                'title' => esc_html__( 'ELEPM', 'elementor-pro-max'),
                'icon' => 'fa fa-plug',
            ]
        );
    }
}