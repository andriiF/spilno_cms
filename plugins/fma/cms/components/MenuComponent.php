<?php

namespace Fma\Cms\Components;

use Cms\Classes\ComponentBase;
use Fma\Cms\Models\Menu;
use RainLab\Translate\Models\Locale;
use RainLab\Translate\Classes\Translator;

class MenuComponent extends ComponentBase {

    protected $translator;

    public function componentDetails() {
        return [
            'name' => 'MenuComponent Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties() {
        return [];
    }

    public function onRun() {
        $header_menu = Menu::find(1);
        $footer_menu = Menu::find(6);
        $locales = Locale::where('is_enabled', 1)->get();
        

        $this->translator = Translator::instance();
        $this->page['footer_menu'] = $this->getMenuArray($footer_menu);
        $this->page['header_menu'] = $this->getMenuArray($header_menu);
        $this->page['locale'] = $this->translator->getLocale();
        $this->page['languages'] = $locales;
    }

    private function getMenuArray($items) {
        $tree_menu = [];

        if (isset($items->menus)) {
            foreach ($items->menus as $item) {
                if (isset($item->page) && $item->menu_type == 2) {
                    if (isset($item->page->pages_id)) {
                        $tree_menu [] = [
                            'link' => $item->page->parent_page->getMainPageMenuUrl() . '#' . $item->page->pagetype->frontend_path,
                            'name' => $item->name
                        ];
                    } else {
                        if (isset($item->page->parent_page)) {

                            $tree_menu [] = [
                                'link' => $item->page->parent_page->getMainPageMenuUrl(),
                                'name' => $item->name
                            ];
                        } else {
                            $tree_menu [] = [
                                'link' => $item->page->getMainPageMenuUrl(),
                                'name' => $item->name
                            ];
                        }
                    }
                } else {
                    $tree_menu [] = [
                        'link' => $item->path,
                        'name' => $item->name
                    ];
                }
            }
        }
        return $tree_menu;
    }

}
