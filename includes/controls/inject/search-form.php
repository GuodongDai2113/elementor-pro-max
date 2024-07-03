<?php

namespace Elementor_Pro_Max\Controls\Inject;

use Elementor_Pro_Max\Controls\Base_Controls;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;

defined('ABSPATH') || exit;

class Search_Form extends Base_Controls
{
    public function get_name()
    {
        return 'search-form';
    }

    public function get_sections()
    {
        return [
            'search_content' => 'content_section',
            'section_button_style' => 'button_style_section',
        ];
    }

    public function content_section($element, $args)
    {

        $this->section_start($element, Controls_Manager::TAB_CONTENT);

        $post_types = get_post_types(['public' => true], 'objects');
        $options = ['' => esc_html__('默认', 'elepm')];
        
        foreach ($post_types as $post_type) {
            $options[$post_type->name] = esc_html__($post_type->label, 'elepm');
        }
        
        $element->add_control(
            'post_type',
            [
                'label' => esc_html__('搜索类型', 'elepm'),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => $options,
            ]
        );
        
        $this->section_end($element, Controls_Manager::TAB_CONTENT);
    }

    public function button_style_section($element, $args)
    {

        $this->section_start($element, Controls_Manager::TAB_STYLE);

        $element->add_control(
			'elepm_note_button_border',
			[
				'label' => '',
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'raw' => esc_html__('按钮边框','elepm'),
				'content_classes' => 'elepm-note',
                'show_label'=> false,
			]
		);
        
		$element->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'selector' => '{{WRAPPER}} .elementor-search-form__submit',
			]
		);
        
        $this->section_end($element, Controls_Manager::TAB_STYLE);
    }

    public function change_content($template, $widget){
        if ($this->get_name() === $widget->get_name()) {
            $settings = $widget->get_settings();
            if ($settings['post_type'] !== ''){
                $insert = '<input type="hidden" name="post_type" value="'.esc_attr($settings['post_type']).'" />';
                $pattern = '/(<input[^>]*>)/';
                $replacement = '$1' . $insert;
                $template = preg_replace($pattern, $replacement, $template);
            }
        }
        return $template;
    }

    // public function change_template($template, $widget){
    //     if ($this->get_name() === $widget->get_name()) {

    //     }
    //     return $template;
    // }

}