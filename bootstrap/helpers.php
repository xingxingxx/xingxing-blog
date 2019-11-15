<?php
/**
 * 自定义全局辅助函数库
 * User: xiaoxingping
 * Date: 2018/6/21
 * Time: 10:56
 */
if (!function_exists('get_cover')) {
    /**
     * 获取封面图片
     * @param $content
     * @return string
     */
    function get_cover($content)
    {
        $firstPic = '';
        if (preg_match('/!\[[^\]]*]\((https|http):\/\/[^\)]*\.(png|jpg|jpeg)(.*)\)/i', $content, $img_match)) {
            if (preg_match('/(https|http:\/\/)[^>]*?\.(png|jpg|jpeg)/i', $img_match[0], $img_match_result)) {
                $firstPic = $img_match_result[0];
            }
        }
        if ($firstPic) {
            $path = (parse_url($firstPic))['path'];
            return $path . '?x-oss-process=style/resize';
        }
        return '';
    }
}

if (!function_exists('get_abstract')) {
    /**
     * * 获取文章摘要
     * @param $content
     * @param int $limit
     * @return string
     */
    function get_abstract($content, $limit = 220)
    {
        $patterns = [];
        $replacements = [];

        /**
         * 替换大标题成小标题
         */
        $patterns[] = '/#+/';
        $replacements[] = '';

        /**
         * 替换图片地址
         */
        $patterns[] = '/!\[[^\]]*]\((https|http):\/\/[^\)]*\.(png|jpg|jpeg|gif)(.*)\)/i';
        $replacements[] = '[图片]';


        /**
         * 代码片段替换
         */
        $patterns[] = '/```((.|\n)*?)```/';
        $replacements[] = '[代码片段]';

        /**
         * 引用替换
         */
        $patterns[] = '/>\s/';
        $replacements[] = '';

        /**
         * 序列替换
         */
        $patterns[] = '/-\s/';
        $replacements[] = '';

        /**
         * 序列替换
         */
        $patterns[] = '/(\d)*\.\s/';
        $replacements[] = '';

        $content = preg_replace($patterns, $replacements, $content);

        return str_limit($content, $limit);
    }
}