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
        add_action('elementor/element/button/section_style/after_section_start', [$this, 'button_style_controls'], 10, 2);
        add_action('elementor/element/image/section_image/before_section_end', [$this, 'image_controls'], 10, 2);
        add_action('elementor/element/theme-post-content/section_style/before_section_end', [$this, 'post_content_controls'], 10, 2);
        add_action('elementor/element/icon-box/section_icon/before_section_end', [$this, 'icon_box_content_controls'], 10, 2);
        add_action('elementor/element/icon-box/section_style_box/before_section_end', [$this, 'icon_box_style_controls'], 10, 2);

        add_filter('elementor/widget/render_content', [$this, 'change_widget_content'], 10, 2);
        // add_filter('elementor/widget/print_template', [$this, 'change_widget_template'], 10, 2);
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

    public function button_style_controls($element, $args)
    {
        $element->add_control(
            'hover_background_animation',
            [
                'label' => esc_html__('悬停背景动画', 'elementor-pro-max'),
                'description' => esc_html__('By Elementor Pro Max', 'elementor-pro-max'),
                'type' => \Elementor\Controls_Manager::SELECT,
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
                'description' => esc_html__('By Elementor Pro Max', 'elementor-pro-max'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'to-left',
                'options' => [
                    'to-right' => esc_html__('向左', 'elementor-pro-max'),
                    'to-left' => esc_html__('向右', 'elementor-pro-max'),
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
                'description' => esc_html__('By Elementor Pro Max', 'elementor-pro-max'),
                'default' => '',
                'selectors' => [
                    '.slide a:before' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'hover_background_animation' => 'slide'
                ],
            ]

        );
    }


    public function image_controls($element, $args)
    {
        $element->add_control(
            'image_overflow',
            [
                'label' => esc_html__('溢出', 'elementor-pro-max'),
                'description' => esc_html__('By Elementor Pro Max 用于解决动画超出问题, 设定下方比例也可实现。', 'elementor-pro-max'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => esc_html__('默认', 'elementor-pro-max'),
                    'hidden' => esc_html__('隐藏', 'elementor-pro-max'),
                ],
                'selectors' => [
                    '{{WRAPPER}}' => 'overflow: {{VALUE}};',
                    '{{WRAPPER}} .elementor-image-box-img' => 'overflow: {{VALUE}};',
                ]
            ],
        );

        $element->add_control(
            'ratio',
            [
                'label' => esc_html__('比例', 'elementor-pro-max'),
                'description' => esc_html__('By Elementor Pro Max 设定后最好不要调节图片大小有关参数，可以修改高级设置里的宽度。', 'elementor-pro-max'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => esc_html__('默认', 'elementor-pro-max'),
                    '16 / 9' => esc_html__('16:9', 'elementor-pro-max'),
                    '9 / 16' => esc_html__('9:16', 'elementor-pro-max'),
                    '3 / 4'  => esc_html__('3:4', 'elementor-pro-max'),
                    '4 / 3'  => esc_html__('4:3', 'elementor-pro-max'),
                    '1 / 1' => esc_html__('1:1', 'elementor-pro-max'),
                ],
                'selectors' => [
                    '{{WRAPPER}}' => 'width:100%;aspect-ratio:{{VALUE}};overflow:hidden;',
                    '{{WRAPPER}} img' => 'width:100%;height:100%;object-fit: cover;',
                ],
            ]
        );

        $element->add_control(
            'ratio_object-position',
            [
                'label' => esc_html__('对象位置', 'elementor-pro-max'),
                'description' => esc_html__('By Elementor Pro Max', 'elementor-pro-max'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'center center' => esc_html__('中心居中', 'elementor-pro-max'),
                    'center left' => esc_html__('中间左侧', 'elementor-pro-max'),
                    'center right' => esc_html__('中间右侧', 'elementor-pro-max'),
                    'top center' => esc_html__('顶部居中', 'elementor-pro-max'),
                    'top left' => esc_html__('顶部左侧', 'elementor-pro-max'),
                    'top right' => esc_html__('顶部右侧', 'elementor-pro-max'),
                    'bottom center' => esc_html__('底部居中', 'elementor-pro-max'),
                    'bottom left' => esc_html__('底部左侧', 'elementor-pro-max'),
                    'bottom right' => esc_html__('底部右侧', 'elementor-pro-max'),
                ],
                'default' => 'center center',
                'selectors' => [
                    '{{WRAPPER}} img' => 'object-position: {{VALUE}};',
                ],
                'condition' => [
                    'ratio!' => ''
                ],

            ]
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
                'heading' => esc_html__('温馨提示', 'elementor-pro-max'),
                'content' => esc_html__('这里是控制整个盒子悬停的效果', 'elementor-pro-max'),
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

    public function change_widget_content($widget_content, $widget)
    {
        $settings = $widget->get_settings();
        if ('icon-box' === $widget->get_name()) {
            if (!empty($settings['box_link']['url'])) {
                $widget_content = '<a href=' . $settings['box_link']['url'] . '>' . $widget_content . '</a>';
            }
        }
        if ('button' === $widget->get_name()) {
            if ($settings['hover_background_animation'] == 'slide') {
                $widget_content = str_replace('elementor-button-wrapper', 'elementor-button-wrapper slide ' . $settings['slide_animation'], $widget_content);
            }
        }
        return $widget_content;
    }

    // public function change_widget_template($template, $widget )
    // {
    //     $settings = $widget->get_settings();
    //     if ('icon-box' === $widget->get_name()) {
            
    //         if (!empty($settings['box_link']['url'])) {
    //             $template = '<a href=' . $settings['box_link']['url'] . '>' . $template . '</a>';
    //         }
    //     }
    //     if ('button' === $widget->get_name()) {
    //         if ($settings['hover_background_animation'] == 'slide') {
    //             $template = str_replace('elementor-button-wrapper', 'elementor-button-wrapper slide ' . $settings['slide_animation'], $template);
    //         }
    //     }
    //     return $template;
    // }
}

