<?php

namespace Fma\Cms\Models;

use Model;

/**
 * Menu Model
 */
class Menu extends Model {

    use \October\Rain\Database\Traits\Validation;

    public $implement = ['RainLab.Translate.Behaviors.TranslatableModel'];
    public $translatable = ['name'];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'fma_cms_menus';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array Validation rules for attributes
     */
    public $rules = [];

    /**
     * @var array Attributes to be cast to native types
     */
    protected $casts = [];

    /**
     * @var array Attributes to be cast to JSON
     */
    protected $jsonable = [];

    /**
     * @var array Attributes to be appended to the API representation of the model (ex. toArray())
     */
    protected $appends = [];

    /**
     * @var array Attributes to be removed from the API representation of the model (ex. toArray())
     */
    protected $hidden = [];

    /**
     * @var array Attributes to be cast to Argon (Carbon) instances
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [
        'menus' => ['Fma\Cms\Models\Menu', 'key' => 'menu_id'],
    ];
    public $belongsTo = [
        'page'=>['Fma\Cms\Models\Page', 'key' => 'page_id'],
    ];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

    public function getMenuTypeOptions() {
        return [
            0 => '-=Wybierz typ strony=-',
            1 => 'Strona zewnętrzna',
            2 => 'Strona wewnętrzna'
        ];
    }

    public function getPageIdOptions() {
        $pages = Page::whereIn('page_type', [1, 2])->get();
        $pages_array = [];
        foreach ($pages as $page) {
            $pages_array[$page->id] = $page->I18n->name ?? '';
        }

        return $pages_array;
    }

}
