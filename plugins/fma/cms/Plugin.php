<?php

namespace Fma\Cms;

/**
 * The plugin.php file (called the plugin initialization script) defines the plugin information class.
 */

use Rainlab\Translate\Controllers\Locales;
use RainLab\Translate\Models\Locale;
use System\Classes\PluginBase;
use Backend;

class Plugin extends PluginBase
{

    public function pluginDetails()
    {
        return [
            'name' => 'Cms',
            'description' => 'Provides features cms .',
            'icon' => 'icon-leaf'
        ];
    }

    public function registerComponents()
    {
        return [
            '\Fma\Cms\Components\PagesComponent' => 'pages',
            '\Fma\Cms\Components\MenuComponent' => 'menu',
        ];
    }

    public function registerNavigation()
    {
        return [
            'page' => [
                'label' => 'Pages',
                'url' => Backend::url('fma/cms/page'),
                'icon' => 'icon-file-text-o',
                'order' => 100,
                'sideMenu' => [
                    'pagetype' => [
                        'label' => 'Typy stron',
                        'icon' => 'icon-file',
                        'url' => Backend::url('fma/cms/pagetype'),
                    ],
                    'menu' => [
                        'label' => 'Menu configurator',
                        'icon' => 'icon-list',
                        'url' => Backend::url('fma/cms/menu'),
                    ],

                ]
            ],
        ];
    }

}
