<?php

namespace App\Controllers;

use Sober\Controller\Controller;

use function App\switch_to_main_blog;

class App extends Controller
{
    protected $acf = true;

    public function siteName()
    {
        return get_bloginfo('name');
    }

    public static function title()
    {
        if (is_front_page()) {
            if (is_main_site()) {
                return get_the_title();
            } else {
                return bloginfo('sitename');
            }
        }
        if (is_archive()) {
            return get_post_type_object(get_post_type())->labels->name;
        }
        if (is_search()) {
            return sprintf(__('Search Results for %s', 'sage'), get_search_query());
        }
        if (is_404()) {
            return __('Not Found', 'sage');
        }
        if (is_single()) {
            return get_post_type_object(get_post_type())->labels->singular_name;
        }
        return get_the_title();
    }

    public static function breadcrumbs()
    {
        global $post;

        if (is_front_page()) {
            return 'Welcome to';
        } else {
            if (is_archive()) {
                $ancestors = [get_field('media_center_page', 'option')->ID];
            } else {
                $ancestors = array_reverse(get_post_ancestors($post));
            }

            $parts = array_map(function($ancestor_id) {
                return '<a class="breadcrumb-link hover-underline" href="' . get_the_permalink($ancestor_id) . '">' . get_the_title($ancestor_id) . '</a>';
            }, $ancestors);

            array_unshift($parts, ('<a class="breadcrumb-link hover-underline" href="' . get_bloginfo('url') . '">' . get_bloginfo('sitename') . '</a>'));

            return implode(' / ', $parts);
        }
    }

    public static function getThumbnailInfo($post, $size='thumbnail') {
        $image_id = get_post_thumbnail_id($post);
        return (object) [
            'url' => wp_get_attachment_url($image_id, $size),
            'alt' => get_post_meta($image_id, '_wp_attachment_image_alt', true)
        ];
    }

    public function headerType() {
        return get_field('header_type');
    }

    public function header($subfield = '') {
        $field = 'header';
        $format = true;

        if (!empty($subfield)) {
            $field = 'header_' . $subfield;
            $format = false;
        }

        if (is_single()) {
            \App\switch_to_main_blog();
            $header = json_decode(json_encode(get_field(get_post_type() . '_' . $field, 'option', $format)));
            restore_current_blog();
        } else if (is_archive()) {
            \App\switch_to_main_blog();
            $header = json_decode(json_encode(get_field($field, get_field('media_center_page', 'option', $format))));
            restore_current_blog();
        }
        else {
            $header = json_decode(json_encode(get_field($field, false, $format)));
        }

        return $header;
    }

    public function headerImage() {
        if (!empty($this->header())) {
            return $this->header()->image;
        }
    }

    public function headerVideo() {
        if (!empty($this->header())) {
            $html = wp_oembed_get($this->header('video'), ['background' => 1, 'autoplay' => 1, 'controls' => 0, 'showinfo' => 0]);
            $video_id = str_replace('https://www.youtube.com/watch?v=', '', $this->header('video'));
            return str_replace("?feature=oembed", "?feature=oembed&autoplay=1&mute=1&loop=1&controls=0&showinfo=0&modestbranding=0&playlist=".$video_id."", $html);
        }
    }

    public function headerMediaUrl() {
        if ($this->headerType() === 'video') {
            return $this->header('video');
        } else {
            $header_image = $this->headerImage();
            return isset($header_image->sizes->full_width) ? $header_image->sizes->full_width : '';
        }
    }

    public function headerMediaPadding() {
        if (!empty($this->headerMediaUrl())) {
            if ($this->headerType() === 'video') {
                return \App\video_padding_from_iframe($this->headerVideo());
            } else {
                $header_image = $this->headerImage();
                return ($header_image->height / $header_image->width * 100) . '%';
            }
        } else {
            return 0;
        }
    }

    public function headerMediaAlt() {
        if ($this->headerType() === 'video') {
            return '';
        } else {
            $header_image = $this->headerImage();
            if (!empty($header_image)) {
                return $header_image->alt;
            }
        }
    }

    public function thumbnailPadding() {
        $image_data = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
        if (!empty($image_data)) {
            return ($image_data[2] / $image_data[1] * 100) . '%';
        }
    }

    public function brand() {
        // return get_field('brand', 'option');
        return 'movement';
    }

    public function logo() {
        switch_to_main_blog();
        $logo = get_field('logo_horizontal', 'option');
        restore_current_blog();

        return $logo;
    }

    public function logo_symbol() {
        switch_to_main_blog();
        $logo = get_field('logo_symbol', 'option');
        restore_current_blog();

        return $logo;
    }

    public function footer_logo() {
        switch_to_main_blog();
        $logo = get_field('logo_vertical', 'option');
        restore_current_blog();

        return $logo;
    }

    public function show_rebrand_message() {
        switch_to_main_blog();
        $show = get_field('rebrand_message_show', 'option');
        restore_current_blog();

        return !!$show;
    }

    public function user_blog_id() {
        global $user_blog_id;

        return $user_blog_id;
    }

    public function user_location() {
        global $user_location;

        return $user_location;
    }

    public function top_accent_color() {
        $color = 'gray-medium';
        $content_blocks = get_field('content_blocks');

        if (!empty($content_blocks) && !empty($content_blocks[0]['background_color'])) {
            $color = $content_blocks[0]['background_color'];
        }

        if (empty($color) || $color === 'transparent' || $color === 'none') {
            $color = 'gray-medium';
        }

        return $color;
    }
}
