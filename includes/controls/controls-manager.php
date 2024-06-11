<?php

namespace Elementor_Pro_Max\Controls;

use Elementor_Pro_Max\Controls\Inject\Button;
use Elementor_Pro_Max\Controls\Inject\Heading;
use Elementor_Pro_Max\Controls\Inject\Image;

defined('ABSPATH') || exit;

class Controls_Manager
{
    /**
     * 定义一个静态属性，用于指定注入内容的位置。
     * 
     * @var string
     */
    public static $inject_position = 'after_section_end';

    public $need_change_content_controls = [];

    public function __construct()
    {
        $button = new Button();
        $this->inject_controls($button);
        $this->inject_controls(new Heading());
        $this->inject_controls(new Image());

        add_filter('elementor/widget/render_content', [$this, 'change_widget_content'], 10, 2);
        add_filter('elementor/widget/print_template', [$this, 'change_widget_template'], 10, 2);
    }


    public function inject_controls($control)
    {
        $sections = $control->get_sections();
        $widget_name  = $control->get_name();

        foreach ($sections as $section_id => $callback_name) {
            $hook_name = 'elementor/element/' . $widget_name . '/' . $section_id . '/' . self::$inject_position;
            add_action($hook_name, [$control, $callback_name], 10, 2);
        }

        array_push($this->need_change_content_controls, $control);
    }

    public function change_widget_content($template, $widget)
    {
        foreach ($this->need_change_content_controls as $index => $obj) {
            $template = $obj->change_content($template, $widget);
        }
        return $template;
    }
    public function change_widget_template($template, $widget)
    {
        foreach ($this->need_change_content_controls as $index => $obj) {
            $template = $obj->change_template($template, $widget);
        }
        return $template;
    }
}
