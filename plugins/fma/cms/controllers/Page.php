<?php

namespace Fma\Cms\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Page Back-end Controller
 */
class Page extends Controller {

    /**
     * @var array Behaviors that are implemented by this controller.
     */
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
        'Backend.Behaviors.RelationController',
    ];

    /**
     * @var string Configuration file for the `FormController` behavior.
     */
    public $formConfig = 'config_form.yaml';

    /**
     * @var string Configuration file for the `ListController` behavior.
     */
    public $listConfig = 'config_list.yaml';
    public $relationConfig = 'config_relation.yaml';

    public function __construct() {

        parent::__construct();
        BackendMenu::setContext('Fma.Cms', 'page');
    }

    public function listExtendQuery($query) {

        $query->whereNull('pages_id')->orderby('position', 'desc');
    }
    
        public function getParentPageUrl() {
        $model = $this->asExtension('FormController')->formGetModel();
        if ($model->pages_id) {
            return '/backend/fma/cms/page/update/'.$model->pages_id;
        } else {
            return null;
        }
    }

    public function getParentPageName() {
        $model = $this->asExtension('FormController')->formGetModel();
        if ($model->pages_id) {
            $parent = \Fma\Cms\Models\Page::find($model->pages_id);
            return $parent->I18n->name ?? 'prev page';
        } else {
            return null;
        }
    }


}
