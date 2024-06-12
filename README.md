# Elementor-Pro-Max（ELEPM）
对 Elementor & Elementor Pro 进行拓展

~~各种拓展插件收费太贵了~~

大部分功能都是在原有小部件上进行拓展

## 注意事项

本插件可能有很多不兼容性，目前只考虑chrome浏览器

暂时不对其他的浏览器进行测试

```
开发当前环境如下:

操作系统:Windows 11 专业版 24H2 

Apache/2.4.56 (Win64) OpenSSL/1.1.1t PHP/8.2.4

MySQL 版本 : mariadb.org binary distribution v10.4.28

PHP 版本 : 8.2.4

Wordpress 版本 : 6.5.4

Elementor 版本 : 3.21.8

Elementor Pro 版本 : 3.21.0

Chorome 版本 : 125.0.6422.142

```

## 控件注入
- 新增 : 标题(Heading) 鼠标悬停颜色控件组
- 新增 : 按钮(Button)  背景动画控件组
- 新增 : 图像(Image)   比例设定控件组

## 动画说明
- 新增 : 按钮背景滑动动画 向左、向右、向上、向下
- 新增 : 按钮背景缩放动画 放大、缩小
- 新增 : 按钮背景圆形缩放动画 放大、缩小 (使用aspect-ratio属性,为了让圆形缩放时，不会出现变形)

![按钮动画](./_temp/buttons.gif)

## 编辑器样式
- 修改 : 全局颜色&字体控件样式修改(表格形式)
- 修改 : 预览模式下隐藏顶部菜单

## 要做的

1. 增加按钮~~背景缩放~~ 倾斜滑动 旋转滑动 边框动画等
2. 修改搜索框，产品类型字段 woocommerce的
3. 图标框，图像框，整个盒子链接`<a>`

## 显示问题

当设定按钮的背景的过渡动画时，文字前方会出现`5px`的间隔，但实际不会有，可能是编辑模式下的模板认为有图标存在，则生成的图标的`div`

## 一些描述

|钩子|描述|
|---|---|
|`before_section_start`|在段开始之前|
|`after_section_start`|在段开始之后|
|`before_section_end`|在段结束之前|
|`after_section_end`|在段结束之后|