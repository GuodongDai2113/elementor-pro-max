<?php

namespace Elementor_Pro_Max;

defined('ABSPATH') || exit;

/**
 * 自动加载类
 * 
 * 该类负责根据类名自动加载对应的PHP文件。
 * 它使用了PSR-4规范来转换类名到文件路径，并利用spl_autoload_register函数注册自动加载器。
 */
class Autoloader
{

    /* 默认的类路径 */
    private static $default_path;

    /* 默认的命名空间 */
    private static $default_namespace;

    /**
     * 运行自动加载器
     * 
     * @param string $default_path 默认的类路径，如果不提供，则使用ELEMENTOR_PRO_MAX_PATH。
     * @param string $default_namespace 默认的命名空间，如果不提供，则使用当前命名空间。
     */
    public static function run($default_path = '', $default_namespace = '')
    {
        /* 如果未提供默认路径，则使用ELEMENTOR_PRO_MAX_PATH */
        if ('' === $default_path) {
            $default_path = ELEMENTOR_PRO_MAX_PATH;
        }

        /* 如果未提供默认命名空间，则使用当前命名空间 */
        if ('' === $default_namespace) {
            $default_namespace = __NAMESPACE__;
        }

        /* 注册自动加载方法 */
        self::$default_path = $default_path . '/includes/';
        self::$default_namespace = $default_namespace;

        spl_autoload_register([__CLASS__, 'autoload']);
    }

    /**
     * 加载类文件
     * 
     * 根据类名计算文件路径，并尝试加载文件。如果类名在类映射中，直接使用映射的路径；
     * 否则，根据PSR-4规范转换类名到文件路径。
     * 
     * @param string $relative_class_name 相对命名空间的类名。
     */
    private static function load_class($relative_class_name)
    {
        $classes_map = [];

        /* 如果类名在类映射中，直接加载对应的文件 */
        if (isset($classes_map[$relative_class_name])) {
            $filename = self::$default_path . '/' . $classes_map[$relative_class_name];
        } else {
            /* 根据PSR-4规范转换类名到文件路径 */
            $filename = strtolower(
                preg_replace(
                    ['/([a-z])([A-Z])/', '/_/', '/\\\/'],
                    ['$1-$2', '-', DIRECTORY_SEPARATOR],
                    $relative_class_name
                )
            );

            $filename = self::$default_path . $filename . '.php';
        }

        /* 如果文件可读，则加载文件 */
        if (is_readable($filename)) {
            require $filename;
        }
    }

    /**
     * 自动加载方法
     * 
     * 该方法被spl_autoload_register注册为自动加载器。它检查当前类名是否属于默认命名空间，
     * 如果是，则转换类名到文件路径并尝试加载文件。
     * 
     * @param string $class 完全限定类名。
     */
    private static function autoload($class)
    {
        /* 检查类名是否属于默认命名空间 */
        if (0 !== strpos($class, self::$default_namespace . '\\')) {
            return;
        }

        /* 移除默认命名空间，得到相对命名空间的类名 */
        $relative_class_name = preg_replace('/^' . self::$default_namespace . '\\\/', '', $class);

        /* 构建最终的类名（用于检查类是否已存在） */
        $final_class_name = self::$default_namespace . '\\' . $relative_class_name;

        /* 如果类不存在，则尝试加载类文件 */
        if (!class_exists($final_class_name)) {
            self::load_class($relative_class_name);
        }
    }
}
