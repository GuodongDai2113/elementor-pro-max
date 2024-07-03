<?php

namespace Elementor_Pro_Max\Controls\Inject;

use Elementor_Pro_Max\Controls\Base_Controls;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

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
            'section_title' => 'content_section',
        ];
    }

    public function style_section($element, $args)
    {
        $this->section_start($element, Controls_Manager::TAB_STYLE);

        $element->add_control(
            'text_hover_color',
            [
                'label' => esc_html__('悬停颜色', 'elepm'),
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
                'label' => esc_html__('过渡时长(ms)', 'elepm'),
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

        $this->section_end($element, Controls_Manager::TAB_STYLE);

        $element->start_controls_section(
            'elepm_section_description',
            [
                'label' => esc_html__( 'ELEPM 描述', 'elepm' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_description' => 'yes',
                ]
            ]

        );


		$element->add_control(
			'description_color',
			[
				'label' => esc_html__( '描述颜色', 'elepm' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_TEXT,
				],
				'selectors' => [
					'{{WRAPPER}} .elepm-heading-description' => 'color: {{VALUE}};',
				],
                'condition' => [
                    'show_description' => 'yes',
                ]
			]
		);

        $element->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
				'selector' => '{{WRAPPER}} .elepm-heading-description',
                'condition' => [
                    'show_description' => 'yes',
                ]
			]
		);

        $element->add_control(
            'description_top_margin',
            [
                'label' => esc_html__('间隔(px)', 'elepm'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elepm-heading-description' => 'margin-top: {{SIZE}}px;',
                ],
                'condition' => [
                    'show_description' => 'yes',
                ]
            ]
        );

        $element->add_responsive_control(
            'description_padding',
			[
				'label' => esc_html__( '描述内边距', 'elepm' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .elepm-heading-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
                'condition' => [
                    'show_description' => 'yes',
                ]
			]
        );

        $element->end_controls_section();

        $element->start_controls_section(
            'elepm_section_subtitle',
            [
                'label' => esc_html__( 'ELEPM 子标题', 'elepm' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_subtitle' => 'yes',
                ]
            ]
        );


        $element->add_control(
			'hr_1',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

        $element->add_control(
			'subtitle_color',
			[
				'label' => esc_html__( '子标题颜色', 'elepm' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
				'selectors' => [
					'{{WRAPPER}} .elepm-heading-subtitle' => 'color: {{VALUE}};',
				],
                'condition' => [
                    'show_subtitle' => 'yes',
                ]
			]
		);

        $element->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'subtitle_typography',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
				'selector' => '{{WRAPPER}} .elepm-heading-subtitle',
                'condition' => [
                    'show_subtitle' => 'yes',
                ]
			]
		);

        $element->add_control(
            'subtitle_bottom_padding',
            [
                'label' => esc_html__('间隔(px)', 'elepm'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elepm-heading-subtitle' => 'padding-bottom: {{SIZE}}px;',
                ],
                'condition' => [
                    'show_subtitle' => 'yes',
                ]
            ]
        );

        $element->end_controls_section();


    }
    public function content_section($element, $args)
    {
        $this->section_start($element, Controls_Manager::TAB_CONTENT);

        $element->add_control(
			'show_description',
			[
				'label' => esc_html__( '显示描述','elepm'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( '显示', 'elepm' ),
				'label_off' => esc_html__( '隐藏', 'elepm' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

        $element->add_control(
			'heading_description',
			[
				'label' => esc_html__( '描述', 'elepm' ),
				'type' => Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => esc_html__( 'Default description', 'elepm' ),
				'placeholder' => esc_html__( '输入描述', 'elepm' ),
                'condition' => [
                    'show_description' => 'yes',
                ]
			]
		);

        $element->add_control(
			'show_subtitle',
			[
				'label' => esc_html__( '显示子标题','elepm'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( '显示', 'elepm' ),
				'label_off' => esc_html__( '隐藏', 'elepm' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

        $element->add_control(
			'heading_subtitle',
			[
				'label' => esc_html__( '子标题', 'elepm' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => get_bloginfo('name'),
				'placeholder' => esc_html__( '请输入子标题', 'elepm' ),
                'condition' => [
                    'show_subtitle' => 'yes',
                ]
			]
		);


        $this->section_end($element, Controls_Manager::TAB_CONTENT);
    }

    public function change_content($template, $widget){
        if ($this->get_name() !== $widget->get_name()) {
            return $template;
        }
    
        $settings = $widget->get_settings();
        $header_tag = $settings['header_size'];
        $header_pattern = '/(<'.$header_tag.'[^>]*>.*?<\/'.$header_tag.'>)/s';
    
        if ($settings['show_subtitle'] === 'yes') {
            $span_insert = '<span class="elepm-heading-subtitle">'.$settings['heading_subtitle'].'</span>';
            $template = preg_replace($header_pattern, $span_insert . '$1', $template);
        }
    
        if ($settings['show_description'] === 'yes') {
            $p_insert = '<p class="elepm-heading-description">'.$settings['heading_description'].'</p>';
            $template = preg_replace($header_pattern, '$1' . $p_insert, $template);
        }
    
        return $template;
    }
    

    public function change_template($template, $widget){
        if ($this->get_name() !== $widget->get_name()) {
            return $template;
        }

        $insert = "
        if ('yes' === settings.show_description)
        {
            print('<p class='+'elepm-heading-description'+'>'+settings.heading_description+'</p>');
        }";
        $template = str_replace('#>',$insert.'#>',$template);

        $insert = "
        if ('yes' === settings.show_subtitle)
        {
            print('<span class='+'elepm-heading-subtitle'+'>'+settings.heading_subtitle+'</span>');
        }";
        $template = str_replace('<#','<#'.$insert,$template);


        return $template;
    }

}
