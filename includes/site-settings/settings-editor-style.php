<?php
namespace Elementor_Pro_Max\Site_Settings;

use Elementor\Core\Kits\Documents\Tabs\Tab_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Settings_Editor_Style extends Tab_Base
{

    const TAB_ID = 'settings-editor-style';

    public function get_id()
    {
        return self::TAB_ID;
    }

    public function get_title()
    {
        return esc_html__('编辑器样式', 'elepm');
    }

    public function get_group()
    {
        return 'settings';
    }

    public function get_icon()
    {
        return 'eicon-custom-css';
    }

    protected function register_tab_controls()
    {
        $this->parent->start_controls_section(
            'section_editor_style',
            [
                'label' => esc_html('编辑器样式', 'elepm'),
                'tab' => $this->get_id(),
            ]
        );

        $this->parent->add_control(
            'elepm_button_color',
            [
                'label' => esc_html__('按钮颜色', 'elepm'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    ':root' => '--e-a-btn-bg-primary: {{VALUE}}',
                ],
            ]
        );

        $this->parent->end_controls_section();
    }
}
