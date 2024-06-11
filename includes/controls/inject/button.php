<?php

namespace Elementor_Pro_Max\Controls\Inject;

use Elementor_Pro_Max\Controls\Base_Controls;
use Elementor\Controls_Manager;

defined('ABSPATH') || exit;

class Button extends Base_Controls
{
    public function get_name()
    {
        return 'button';
    }

    public function get_sections()
    {
        return [
            'section_style' => 'style_section',
        ];
    }

    public function style_section($element, $args)
    {

        $this->section_start($element, Controls_Manager::TAB_STYLE);

        $element->add_control(
            'hover_background_animation',
            [
                'label' => esc_html__('悬停背景动画', 'elementor-pro-max'),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => esc_html__('默认', 'elementor-pro-max'),
                    'slide' => esc_html__('滑动', 'elementor-pro-max'),
                ],
            ]
        );
        $element->add_control(
            'slide_animation',
            [
                'label' => esc_html__('方向', 'elementor-pro-max'),
                'type' => Controls_Manager::SELECT,
                'default' => 'to-left',
                'options' => [
                    'to-left' => esc_html__('向左', 'elementor-pro-max'),
                    'to-right' => esc_html__('向右', 'elementor-pro-max'),
                    'to-top' => esc_html__('向上', 'elementor-pro-max'),
                    'to-bottom' => esc_html__('向下', 'elementor-pro-max'),
                ],
                'condition' => [
                    'hover_background_animation' => 'slide'
                ],
            ]
        );
        $element->add_control(
            'slide_animation_color',
            [
                'label' => esc_html__('背景颜色', 'elementor-pro-max'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '.slide a:before' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'hover_background_animation' => 'slide'
                ],
            ]

        );
        $this->section_end($element, $args);
    }

    public function change_content($template, $widget){
        if ($this->get_name() === $widget->get_name()) {
            $settings = $widget->get_settings();
            if ($settings['hover_background_animation'] == 'slide') {
                $template = str_replace('elementor-button-wrapper', 'elementor-button-wrapper slide ' . $settings['slide_animation'], $template);
            }
        }
        return $template;
    }

    public function change_template($template, $widget){
        if ($this->get_name() === $widget->get_name()) {
            // 要插入的新代码
            $additionalCode = "
            if ( 'slide' === settings.hover_background_animation ) {
                view.addRenderAttribute( 'wrapper', 'class', 'slide ' + settings.slide_animation );
            }";

            // 使用正则表达式查找并在后面插入新代码
            $pattern = "/view\.addRenderAttribute\( 'wrapper', 'class', 'elementor-button-wrapper' \);/";
            $replacement = "view.addRenderAttribute( 'wrapper', 'class', 'elementor-button-wrapper' );" . $additionalCode;
            $template = preg_replace($pattern, $replacement, $template);
        }
        return $template;
    }

}