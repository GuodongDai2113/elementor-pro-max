<?php

namespace Elementor_Pro_Max\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;

defined('ABSPATH') || exit;

class Download_List  extends Widget_Base
{

    public function get_name()
    {
        return 'download_list';
    }

    public function get_title()
    {
        return esc_html__('下载列表', 'elepm');
    }

    public function get_icon()
    {
        return 'eicon-file-download';
    }

    public function get_categories()
    {
        return ['elepm-widget-category'];
    }


    public function get_style_depends()
    {
        return ['elepm-download-list'];
    }
    public function get_keywords()
    {
        return ['download', 'list'];
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('内容', 'elepm'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'icon',
            [
                'label' => esc_html__('图标', 'elepm'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-circle',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $this->add_control(
            'files',
            [
                'label' => esc_html__('下载文件', 'elepm'),
                'type' => Controls_Manager::GALLERY,
                'default' => [],
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'show_title',
            [
                'label' => esc_html__('显示标题', 'elepm'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('标题', 'elepm'),
                'label_off' => esc_html__('文件', 'elepm'),
                'return_value' => 'yes',
                'default' => '',
            ]
        );
        $this->add_control(
            'show_description',
            [
                'label' => esc_html__('显示描述', 'elepm'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('显示', 'elepm'),
                'label_off' => esc_html__('隐藏', 'elepm'),
                'return_value' => 'yes',
                'default' => '',
            ]
        );

        $this->add_control(
            'show_date',
            [
                'label' => esc_html__('显示日期', 'elepm'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('显示', 'elepm'),
                'label_off' => esc_html__('隐藏', 'elepm'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_extension',
            [
                'label' => esc_html__('显示拓展名', 'elepm'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('显示', 'elepm'),
                'label_off' => esc_html__('隐藏', 'elepm'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );


        $this->end_controls_section();
    }



    const MIME_TYPE_SEPARATOR = '/';

    protected function get_file_info($id)
    {
        $file_info = [];
        $file = get_post($id);
        if (!$file) {
            return $file_info; // 提前返回，避免处理无效文件
        }

        $file_info['id'] = $id;
        $file_info['date'] = substr($file->post_date, 0, 10);
        $file_info['description'] = $file->post_content;
        $file_info['title'] = $file->post_title;
        $file_info['name'] = $file->post_name;
        $file_info['size'] = '';
        $file_info['extension'] = strtoupper(substr($file->post_mime_type, strpos($file->post_mime_type, self::MIME_TYPE_SEPARATOR) + 1));

        $file_meta = wp_get_attachment_metadata($id);
        if ($file_meta) {
            $file_info['size'] = $this->formatFileSize($file_meta['filesize']);
        }

        return $file_info;
    }

    protected function formatFileSize($size)
    {
        return number_format($size / 1024, 0) . ' KB'; // 单独处理文件大小格式化
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $render = false;
        if (array_key_exists('files', $settings) && is_array($settings['files']) && !empty($settings['files'])) {
            $table = '<table class="elepm-download-list">';
            $table .= '<tbody>';
            foreach ($settings['files'] as $key => $file) {
                if (!isset($file['id']) || !is_numeric($file['id']) || $file['id'] <= 0) {
                    continue; // 验证文件ID的合法性
                }
                $file_info = $this->get_file_info($file['id']);
                if (!empty($file_info)) {
                    $table .= $this->renderTableRow($file_info, $settings);
                    $render = true;
                }
            }
            $table .= '</tbody>';
            $table .= '</table>';
            if ($render) {
                echo $table;
            }
        }
    }

    protected function renderTableRow($file_info, $settings)
    {
        $rowClass = 'elepm-download-list__row';
        $titleOrName = $settings['show_title'] === 'yes' ? $file_info['title'] : $file_info['name'];
        return '<tr class="' . esc_attr($rowClass) . '">
                    <td class="elepm-download-list__title">' . esc_html($titleOrName) . '</td>
                </tr>';
    }
    // protected function content_template()
    // {

    // }
}


