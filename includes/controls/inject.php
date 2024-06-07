<?php

namespace Elementor_Pro_Max\Controls;

use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}


class Inject_Controls
{

    public function __construct()
    {
        add_action('elementor/element/heading/section_title_style/after_section_start', [$this, 'heading_controls'], 10, 2);
        add_action('elementor/element/button/section_button/after_section_end', [$this, 'button_controls'], 10, 2);
        add_action('elementor/element/image/section_image/before_section_end', [$this, 'image_controls'], 10, 2);
        add_action('elementor/element/theme-post-content/section_style/before_section_end', [$this, 'post_content_controls'], 10, 2);
        add_action('elementor/element/icon-box/section_icon/before_section_end', [$this, 'icon_box_content_controls'], 10, 2);
        add_action('elementor/element/icon-box/section_style_box/before_section_end', [$this, 'icon_box_style_controls'], 10, 2);
        add_filter('elementor/widget/render_content', [$this, 'change_icon_box_widget_content'], 10, 2);
    }

    public function heading_controls($element, $args)
    {
        $element->add_control(
            'text_hover_color',
            [
                'label' => esc_html__('Hover Color', 'elementor-pro-max'),
                'description' => esc_html__('By Elementor Pro Max', 'elementor-pro-max'),
                'type' => Controls_Manager::COLOR,
                'global' => [
                    'default' => Global_Colors::COLOR_PRIMARY,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-heading-title:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $element->add_control(
            'text_transition_duration',
            [
                'label' => esc_html__('Transition Duration(ms)', 'elementor-pro-max'),
                'description' => esc_html__('By Elementor Pro Max', 'elementor-pro-max'),
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
    }
    public function button_controls($element, $args)
    {
        $element->remove_control('button_type');
    }

    public function image_controls($element, $args)
    {
        $element->add_control(
            'image_overflow',
            [
                'label' => esc_html__('Overflow', 'elementor-pro-max'),
                'description' => esc_html__('By Elementor Pro Max 用于解决动画超出问题', 'elementor-pro-max'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => esc_html__('Default', 'elementor-pro-max'),
                    'hidden' => esc_html__('hidden', 'elementor-pro-max'),
                ],
                'selectors' => [
                    '{{WRAPPER}}' => 'overflow: {{VALUE}};',
                    '{{WRAPPER}} .elementor-image-box-img' => 'overflow: {{VALUE}};',
                ]
            ],
        );
    }

    public function post_content_controls($element, $args)
    {
        $element->start_controls_tabs('post_content_styles', []);
        for ($i = 1; $i < 7; $i++) {
            $element->start_controls_tab(
                'post_content_h' . $i,
                [
                    'label' => 'H' . $i,
                ]
            );
            $element->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'typography_h' . $i,
                    'selector' => '{{WRAPPER}} h' . $i,
                ]
            );
            $element->add_control(
                'post_content_h' . $i . '_color',
                [
                    'label' => esc_html__('文本颜色', 'elementor-pro-max'),
                    'type' => Controls_Manager::COLOR,
                    'description' => esc_html__('By Elementor Pro Max', 'elementor-pro-max'),
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} h' . $i => 'color: {{VALUE}};',
                    ],
                ]
            );
            $element->end_controls_tab();
        }
        $element->end_controls_tabs();
    }

    public function icon_box_content_controls($element, $args)
    {
        $element->add_control(
            'box_link',
            [
                'label' => esc_html__('盒子链接', 'elementor-pro-max'),
                'description' => esc_html__('By Elementor Pro Max', 'elementor-pro-max'),
                'type' => Controls_Manager::URL,
                'options' => ['url'],
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => '',
                ],
                'label_block' => true,
            ]
        );
    }
    public function icon_box_style_controls($element, $args)
    {
        $element->add_control(
			'icon_box_panel_alert',
			[
				'type' => Controls_Manager::ALERT,
				'alert_type' => 'info',
				'heading' => esc_html__( '温馨提示', 'elementor-pro-max' ),
				'content' => esc_html__( '这里是控制整个盒子悬停的效果','elementor-pro-max'),
			]
		);
        $element->start_controls_tabs('icon_item_colors', []);
        $element->start_controls_tab(
            'icon_item_color_tab',
            [
                'label' => '图标',
            ]
        );
        $element->add_control(
            'icon_item_hover_color',
            [
                'label' => esc_html__('图标颜色', 'elementor-pro-max'),
                'type' => Controls_Manager::COLOR,
                'description' => esc_html__('By Elementor Pro Max', 'elementor-pro-max'),
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}}:hover .elementor-icon' => 'color: {{VALUE}};fill: {{VALUE}}',
                ],
            ]
        );
        $element->end_controls_tab();
        $element->start_controls_tab(
            'heading_item_color_tab',
            [
                'label' => '标题',
            ]
        );
        $element->add_control(
            'heading_item_hover_color',
            [
                'label' => esc_html__('标题颜色', 'elementor-pro-max'),
                'type' => Controls_Manager::COLOR,
                'description' => esc_html__('By Elementor Pro Max', 'elementor-pro-max'),
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}}:hover .elementor-icon-box-title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $element->end_controls_tab();
        $element->start_controls_tab(
            'text_item_color_tab',
            [
                'label' => '文本',
            ]
        );
        $element->add_control(
            'text_item_hover_color',
            [
                'label' => esc_html__('文本颜色', 'elementor-pro-max'),
                'type' => Controls_Manager::COLOR,
                'description' => esc_html__('By Elementor Pro Max', 'elementor-pro-max'),
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}}:hover .elementor-icon-box-description' => 'color: {{VALUE}};',
                ],
            ]
        );
        $element->end_controls_tab();
        $element->end_controls_tabs();

    }

    public function change_icon_box_widget_content($widget_content, $widget)
    {
        if ('icon-box' === $widget->get_name()) {
            $settings = $widget->get_settings();
            if (!empty($settings['box_link']['url'])) {
                $widget_content = '<a href=' . $settings['box_link']['url'] . '>' . $widget_content . '</a>';
            }
        }
        return $widget_content;
    }
}
