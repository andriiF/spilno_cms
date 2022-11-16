<?php

namespace Fma\Cms\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Menu Back-end Controller
 */
class Menu extends Controller {

    /**
     * @var array Behaviors that are implemented by this controller.
     */
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
        'Backend.Behaviors.RelationController'
    ];

    /**
     * @var string Configuration file for the `FormController` behavior.
     */
    public $formConfig = 'config_form.yaml';

    /**
     * @var string Configuration file for the `ListController` behavior.
     */
    public $relationConfig = 'config_relation.yaml';
    public $listConfig = 'config_list.yaml';

    public function __construct() {
        parent::__construct();

        BackendMenu::setContext('Fma.Cms', 'page', 'menu');
    }
    
      public function listExtendQuery($query) {

        $query->whereNull('menu_id');
    }

}
