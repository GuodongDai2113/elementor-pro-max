<?php

namespace Elementor_Pro_Max\Tags;

defined('ABSPATH') || exit;

class Tags_Manager{

    public function __construct() {
        add_action( 'elementor/dynamic_tags/register', [$this,'register_new_dynamic_tags'] );
    }

    function register_new_dynamic_tags( $dynamic_tags_manager ) {

    
    }


}