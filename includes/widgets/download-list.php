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
        return esc_html__('下载列表', 'elementor-pro-max');
    }

    public function get_icon()
    {
        return 'eicon-code';
    }

    public function get_categories()
    {
        return ['elepm'];
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
                'label' => esc_html__('内容', 'elementor-pro-max'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'icon',
            [
                'label' => esc_html__('图标', 'elementor-pro-max'),
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
                'label' => esc_html__('下载文件', 'elementor-pro-max'),
                'description' => esc_html__('目前只能选择图片文件，可以通过ACF配合动态标签，选择文件', 'elementor-pro-max'),
                'type' => Controls_Manager::GALLERY,
                'default' => [],
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        if (is_array($settings['files']) && !empty($settings['files'])) {
?>
            <style>
                .elepm-download-list {}

                .elepm-download-list .elepm-download-item td {
                    width: 25%;
                    background: #fff;
                    border: none;
                    text-align: center;
                }

                .elepm-file-icon svg {
                    width: 16px;
                }
            </style>
            <table class="elepm-download-list">
                <tbody>
                    <?php foreach ($settings['files'] as $key => $file) : ?>
                        <?php
                        $path = parse_url($file['url'], PHP_URL_PATH);
                        $file_info = pathinfo($path);
                        $filename = $file_info['filename']; // 文件名（不带后缀）
                        $extension = $file_info['extension']; // 后缀
                        ?>
                        <tr class="elepm-download-item">
                            <?php if ($settings['icon']['value'] != '') : ?>
                                <td class="elepm-file-icon">
                                    <?php Icons_Manager::render_icon($settings['icon'], ['aria-hidden' => 'true']); ?>
                                </td>
                            <?php endif; ?>
                            <td class="elepm-file-title">
                                <?php echo $filename; ?>
                            </td>
                            <td class="elepm-file-type">
                                <?php echo $extension; ?>
                            </td>
                            <td class="elepm-file-button">
                                <a class='elepm-file-link' href="<?php echo $file['url']; ?>" download="">download</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
<?php
        }
    }

    // protected function content_template()
    // {

    // }
}
