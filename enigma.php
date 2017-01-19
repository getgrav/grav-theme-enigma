<?php
namespace Grav\Theme;

use Grav\Common\Theme;
use Grav\Common\Utils;

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
            if (isset($page->header()->enigma['inherit_from'])) {
                $inherit_from = $page->header()->enigma['inherit_from'];
                $inherit_page = $this->grav['pages']->dispatch($inherit_from);
                $current_header = $page->header()->enigma;
                $inherited_header = $this->mergeConfig($inherit_page)->toArray();
                $page->modifyHeader($this->name, Utils::arrayMergeRecursiveUnique($inherited_header, $current_header));
                $this->config->set('theme', $page->header()->enigma);
            } else {
                $this->config->set('theme', $this->mergeConfig($page));
            }

        }
    }
}
