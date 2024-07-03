<?php

namespace Elementor_Pro_Max\Controls;

defined('ABSPATH') || exit;

abstract class Base_Controls
{
    /**
     * 获取控件名称的抽象方法。
     *
     * 子类必须实现此方法来提供特定控件的名称。
     *
     * @return string 控件的名称。
     */
    abstract public function get_name();

    /**
     * 获取控件部分的抽象方法。
     *
     * 此方法应返回一个包含控件所属各个部分的数组。
     * 每个部分应是一个关联数组，键为部分ID，要执行的函数。
     *
     * @return array 控件的部分信息，格式为：['段落id' => '要执行的函数']。
     */
    abstract public function get_sections();

    /**
     * 根据给定的模板和小部件，修改内容。
     * 
     * 此函数旨在根据提供的模板和小部件来更改内容。然而，当前的实现并没有进行任何实际的修改，
     * 而是直接返回了原始的模板。这可能是由于后续开发的需要，或者是一个占位函数。
     * 
     * @param string $template 原始模板字符串。
     * @param  $widget 小部件对象。
     * @return string 返回修改后的模板字符串。
     */
    public function change_content($template, $widget){
        return $template;
    }
    public function change_template($template, $widget){
        return $template;
    }

    public function section_start($element,$section_type='style'){
        $element->start_controls_section(
            "elepm_".$section_type,
            [
                'tab' => $section_type,
                'label' => esc_html__('ELEPM 拓展', 'elepm' ),
            ]
        );
    }

    public function section_end($element,$section_type='style'){
        $this->note($element,$section_type);
        $element->end_controls_section();
    }

    public function note($element,$section_type){
        $element->add_control(
			'elepm_note_'.$section_type,
			[
				'label' => '',
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'raw' => '<a href="https://github.com/GuodongDai2113/Elementor-Pro-Max" target="_blank">Elementor Pro Max</a> 提供支持',
				'content_classes' => 'elepm-note',
                'show_label'=> false,
			]
		);
    }

}