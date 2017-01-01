<?php
namespace Grav\Theme;

use Grav\Common\Theme;

class Enigma extends Theme
{
    public static function getSubscribedEvents()
    {
        return [
            'onThemeInitialized' => ['onThemeInitialized', 0],
        ];
    }

    public function onThemeInitialized()
    {
        if ($this->isAdmin()) {
            return;
        }

        $this->enable([
            'onPagesInitialized' => ['onPagesInitialized', 0],
        ]);
    }

    public function onPagesInitialized()
    {
        $page = $this->grav['page'];

        // If a page exists merge the configs
        if ($page) {
            $this->config->set('theme', $this->mergeConfig($page));
        }
    }
}
