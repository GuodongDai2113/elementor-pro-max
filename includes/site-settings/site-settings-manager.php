<?php
namespace Elementor_Pro_Max\Site_Settings;
defined('ABSPATH') || exit;

class Site_Settings_Manager{

    public function __construct() {
        // add_action('elementor/kit/register_tabs',[$this,'register_tabs']);
    }


    public function register_tabs($kit) {
        // $kit->register_tab('settings-editor-style',Settings_Editor_Style::class);
    }
}