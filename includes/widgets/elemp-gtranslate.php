<?php

namespace Elementor_Pro_Max\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;

defined('ABSPATH') || exit;

class Elemp_Gtranslate  extends Widget_Base
{

    public function get_name()
    {
        return 'elemp-gtranslate';
    }

    public function get_title()
    {
        return esc_html__('G翻译', 'elepm');
    }

    public function get_icon()
    {
        return 'eicon-code';
    }

    public function get_categories()
    {
        return ['elepm'];
    }

    // public function get_style_depends()
    // {
    //     return ['elepm-download-list'];
    // }


    // public function get_script_depends()
    // {
    //     return ['elepm_gt_widget_script_999999'];
    // }

    public function get_keywords()
    {
        return ['translate'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            "elepm_section_style",
            [
                'tab' => Controls_Manager::TAB_STYLE,
                'label' => esc_html__('ELEPM拓展', 'elepm'),
            ]
        );

        $this->end_controls_section();
    }


    protected function render()
    {
        ?>
        <div class="gtranslate_wrapper" id="gt-wrapper-999999"></div>123
        <?php

    }


    protected function content_template()
    {
    }
}
