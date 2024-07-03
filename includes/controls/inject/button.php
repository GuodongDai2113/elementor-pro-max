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
                'label' => esc_html__('悬停背景动画', 'elepm'),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => esc_html__('默认', 'elepm'),
                    'elepm-slide' => esc_html__('滑动', 'elepm'),
                    'elepm-zoom' => esc_html__('缩放', 'elepm'),
                    'elepm-circle-zoom' => esc_html__('圆形缩放', 'elepm'),
                ],
            ]
        );
        $element->add_control(
            'slide_animation',
            [
                'label' => esc_html__('方向', 'elepm'),
                'type' => Controls_Manager::SELECT,
                'default' => 'left',
                'options' => [
                    'left' => esc_html__('向左', 'elepm'),
                    'right' => esc_html__('向右', 'elepm'),
                    'top' => esc_html__('向上', 'elepm'),
                    'bottom' => esc_html__('向下', 'elepm'),
                ],
                'condition' => [
                    'hover_background_animation' => 'elepm-slide'
                ],
            ]
        );

        $element->add_control(
            'zoom_animation',
            [
                'label' => esc_html__('方向', 'elepm'),
                'description'=> esc_html__('注意圆形缩放是使用aspect-ratio，需要自 2021 年 9 月以后的浏览器。', 'elepm'),
                'type' => Controls_Manager::SELECT,
                'default' => 'in',
                'options' => [
                    'in' => esc_html__('放大', 'elepm'),
                    'out' => esc_html__('缩小', 'elepm'),
                ],
                'condition' => [
                    'hover_background_animation' => ['elepm-zoom','elepm-circle-zoom'],
                ],
            ]
        );

        $element->add_control(
            'animation_color',
            [
                'label' => esc_html__('背景颜色', 'elepm'),
                'type' => Controls_Manager::COLOR,
                'default' => '#42a5f5',
                'selectors' => [
                    '{{WRAPPER}} a:before' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'hover_background_animation!' => ''
                ],
            ]

        );
        $this->section_end($element, Controls_Manager::TAB_STYLE);
    }

    public function change_content($template, $widget){
        if ($this->get_name() === $widget->get_name()) {
            $settings = $widget->get_settings();
            if ($settings['hover_background_animation'] == 'elepm-slide') {
                $template = str_replace('elementor-button-wrapper', 'elementor-button-wrapper '.$settings['hover_background_animation']. ' ' . $settings['slide_animation'], $template);
            }elseif ($settings['hover_background_animation'] == 'elepm-zoom' || $settings['hover_background_animation'] == 'elepm-circle-zoom') {
                $template = str_replace('elementor-button-wrapper', 'elementor-button-wrapper '.$settings['hover_background_animation']. ' ' . $settings['zoom_animation'], $template);
            }
        }
        return $template;
    }

    public function change_template($template, $widget){
        if ($this->get_name() === $widget->get_name()) {

            $additionalCode = "
            if ( 'elepm-slide' === settings.hover_background_animation ) {
                view.addRenderAttribute( 'wrapper', 'class', settings.hover_background_animation + ' ' + settings.slide_animation );
            } else if ( 'elepm-zoom' === settings.hover_background_animation || 'elepm-circle-zoom' === settings.hover_background_animation ) {
                view.addRenderAttribute( 'wrapper', 'class', settings.hover_background_animation + ' ' + settings.zoom_animation);
            }";

            // 使用正则表达式查找并在后面插入新代码
            $pattern = "/view\.addRenderAttribute\( 'wrapper', 'class', 'elementor-button-wrapper' \);/";
            $replacement = "view.addRenderAttribute( 'wrapper', 'class', 'elementor-button-wrapper' );" . $additionalCode;
            $template = preg_replace($pattern, $replacement, $template);
        }
        return $template;
    }

}