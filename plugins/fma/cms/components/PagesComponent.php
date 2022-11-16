<?php

namespace Fma\Cms\Components;

use Cms\Classes\ComponentBase;
use Fma\Cms\Models\Page;
use Fma\Cms\Models\PageI18n;
use Lang;
use Session;

class PagesComponent extends ComponentBase
{

    public function componentDetails()
    {
        return [
            'name' => 'PagesComponent Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function init()
    {

    }

    public function onRun()
    {

        if ($this->page->url == "/") {
            $page = Page::where([['main_page', 1], ['show_page', 1]])->first();
            if (!$page) {
                return redirect('404');
            }

            $this->page['rows'] = $page->pages;
            $this->page['metaRow'] = $page->I18n;
            $this->page['isMainPage'] = true;
        } else {
            $slug = $this->param('slug');
            $pageI18n = PageI18n::where('seo', $slug)->first();
            if (!$pageI18n || !$pageI18n->page || $pageI18n->page->show_page == 0) {
                return redirect('404');
            }


            $this->page['rows'] = $pageI18n->page->pages;
            $this->page['metaRow'] = $pageI18n;
            $this->page['pageRow'] = $pageI18n->page;
            $this->page['isMainPage'] = false;
        }
    }

}
