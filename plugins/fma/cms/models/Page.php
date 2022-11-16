<?php

namespace Fma\Cms\Models;

use Model;
use Fma\Cms\Models\PageI18n;
use System\Models\File;

/**
 * Page Model
 */
class Page extends Model {

    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'fma_cms_pages';

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
    protected $jsonable = ['parameters'];

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
    public $hasOne = [
        'I18n' => ['Fma\Cms\Models\PageI18n',
            'key' => 'pages_id',
            'scope' => 'isCorrectLang'
        ],
    ];
    public $hasMany = [
        'I18ns' => ['Fma\Cms\Models\PageI18n', 'key' => 'pages_id'],
        'pages' => ['Fma\Cms\Models\Page', 'key' => 'pages_id', 'scope' => 'sort'],
    ];
    public $belongsTo = [
        'pagetype' => [
            'Fma\Cms\Models\PageType',
            'key' => 'page_type_id',
        ],
        'parent_page' => [
            'Fma\Cms\Models\Page',
            'key' => 'pages_id',
        ]
    ];
    public $belongsToMany = [
    ];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [
        'background_image' => [
            File::class,
        ]
    ];
    public $attachMany = [
        'multimedia' => [
            File::class,
        ]
    ];

    public function scopeSort($query) {
        return $query->orderBy('position', 'desc');
    }

    public function getPageTypeOptions() {
        return [
            1 => "Opakowanie Strony",
            2 => "Sekcja Strony",
            3 => "Element Strony"
        ];
    }

    public function getPageTypeIdOptions() {
        return PageType::pluck('name', 'id')->toArray();
    }

    public function getMainPageMenuUrl() {
        if ($this->main_page == 1) {
            return '/';
        } else {
            if ($this->I18n) {
                return '/' . $this->I18n->seo;
            } else {
                return '/';
            }
        }
    }

    public function getI18nNameAttribute() {
        return $this->I18n->name ?? '';
    }

    public function getI18nSeoAttribute() {
        return $this->I18n->seo ?? '';
    }

}
