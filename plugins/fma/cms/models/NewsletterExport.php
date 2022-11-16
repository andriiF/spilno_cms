<?php

namespace Fma\Cms\Models;
use Fma\Cms\Models\Newsletter;

class NewsletterExport extends \Backend\Models\ExportModel {

    public function exportData($columns, $sessionKey = null) {
        $subscribers = Newsletter::all();
        $subscribers->each(function($subscriber) use ($columns) {
            $subscriber->addVisible($columns);
        });
        return $subscribers->toArray();
    }

}
