<?php

namespace Elementor_Pro_Max\Controls\Inject;

use Elementor_Pro_Max\Controls\Base_Controls;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Controls_Manager;

defined('ABSPATH') || exit;

class Heading extends Base_Controls
{
    public function get_name(): string
    {
        return 'heading';
    }

    public function get_sections(): array
    {
        return [
            'section_title_style' => 'style_section',
        ];
    }

    public function style_section($element, $args)
    {
        $this->section_start($element, Controls_Manager::TAB_STYLE);
        $element->add_control(
            'text_hover_color',
            [
                'label' => esc_html__('悬停颜色', 'elementor-pro-max'),
                'type' => Controls_Manager::COLOR,
                'global' => [
                    'default' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-heading-title:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $element->add_control(
            'text_transition_duration',
            [
                'label' => esc_html__('过渡时长(ms)', 'elementor-pro-max'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 3000,
                        'step' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-heading-title' => 'transition-duration: {{SIZE}}ms;',
                ],
            ]
        );
        $this->section_end($element, $args);
    }

}
