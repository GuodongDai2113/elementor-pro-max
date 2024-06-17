<?php

namespace Elementor_Pro_Max\Tags;

use ElementorPro\Modules\DynamicTags\Tags\Base\Data_Tag;
use ElementorPro\Modules\DynamicTags\Module;

defined('ABSPATH') || exit;

class Download_File_Tag extends Data_Tag {
    
	public function get_name() {
		return 'download-file-tag';
	}

	public function get_title() {
		return esc_html__( '下载文件', 'elementor-pro-max' );
	}

	public function get_group() {
		return [ 'post' ];
	}

	public function get_categories() {
		return [ Module::GALLERY_CATEGORY ];
	}

    public function get_value( array $options = [] ) {

        // 确保ACF已安装并激活
		if ( ! function_exists( 'get_field' ) ) {
			return [];
		}

        $field = get_field('download_file');

        return [$field];
    }

}