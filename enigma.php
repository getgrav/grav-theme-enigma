<?php
namespace Grav\Theme;

use Grav\Common\Theme;

class Enigma extends Theme
{
    public static function getSubscribedEvents()
    {
        return [
            'onThemeInitialized' => ['onThemeInitialized', 0],
            'onPageInitialized' => ['onPageInitialized', 0],
        ];
    }

    public function onThemeInitialized()
    {

    }

    public function onPageInitialized()
    {
        $page = $this->grav['page'];

        $header = $page->header();
        $new_config = $this->config->get('theme');

        $options = [
            'theme_class',
            'hero_header' => ['size', 'color', 'image', 'date', 'taxonomy'],
        ];

        foreach ($options as $key => $option) {
            if (is_int($key)) {
                $key = $option;
            }
            if (isset($header->$key)) {
                $element = $header->$key;
                if (is_array($option)) {
                    foreach ($option as $item) {
                        if (isset($element[$item])) {
                            $new_config[$key][$item] = $element[$item];
                        }
                    }
                } else {
                    $new_config[$key] = $element;
                }
            }
        }

        // If a page exists merge the configs
        if ($page) {
            $this->config->set('theme', $new_config);
        }
    }
}
