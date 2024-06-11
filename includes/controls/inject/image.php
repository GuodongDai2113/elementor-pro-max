<?php

namespace Elementor_Pro_Max\Controls\Inject;

use Elementor_Pro_Max\Controls\Base_Controls;
use Elementor\Controls_Manager;

defined('ABSPATH') || exit;

class Image extends Base_Controls
{
    public function get_name(): string
    {
        return 'image';
    }

    public function get_sections(): array
    {
        return [
            'section_image' => 'style_section',
        ];
    }

    public function style_section($element, $args)
    {

        $this->section_start($element, Controls_Manager::TAB_STYLE);

        $element->add_control(
            'image_overflow',
            [
                'label' => esc_html__('溢出', 'elementor-pro-max'),
                'description' => esc_html__('用于解决动画超出问题, 设定下方比例也可实现。', 'elementor-pro-max'),
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
                'description' => esc_html__('设定后最好不要调节图片大小有关参数，可以修改高级设置里的宽度。', 'elementor-pro-max'),
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

        $this->section_end($element, $args);
    }

}
