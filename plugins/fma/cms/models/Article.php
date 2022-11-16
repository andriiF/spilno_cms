<?php

namespace Fma\Cms\Models;

use Model;
use Fma\Cms\Models\ArticleI18n;
use System\Models\File;

/**
 * Article Model
 */
class Article extends Model {

    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'fma_cms_articles';

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
    public $article_types = [
        0 => 'Wideo',
        1 => 'Text',
    ];

    /**
     * @var array Relations
     */
    public $hasOne = [
        'I18n' => ['Fma\Cms\Models\ArticleI18n',
            'key' => 'article_id',
            'scope' => 'isCorrectLang'
        ],
    ];
    public $hasMany = [
        'I18ns' => ['Fma\Cms\Models\ArticleI18n', 'key' => 'article_id'],
    ];
    public $belongsTo = [];
    public $belongsToMany = [];
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

    public function getI18nNameAttribute() {
        return $this->I18n->name ?? '';
    }

    public function getI18nSeoAttribute() {
        return $this->I18n->seo ?? '';
    }

    public function getTypeOptions() {
        return $this->article_types;
    }

}
