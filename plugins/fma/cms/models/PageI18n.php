<?php

namespace Fma\Cms\Models;

use Model;
use Fma\Cms\Models\Page;
use RainLab\Translate\Models\Locale;
use Cookie;
use RainLab\Translate\Classes\Translator;

/**
 * PageI18n Model
 */
class PageI18n extends Model {

    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\Sluggable;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'fma_cms_page_i18ns';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];
    protected $slugs = ['seo' => 'name'];

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
    public $hasOne = [
        'language' => Locale::class
    ];
    public $hasMany = [];
    public $belongsTo = [
        'page' => [
            Page::class,
            'key' => 'pages_id'
        ]
    ];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];
    //lang
    protected $translator;

    public function getLangIdOptions() {
        return Locale::pluck('name', 'id');
    }

    public function beforeSave() {

        $lang = Locale::pluck('code', 'id')->toArray();
        $this->lang_code = $lang[$this->lang_id];
    }

    public function scopeIsCorrectLang($query) {
        $this->translator = Translator::instance();
        $lang_id = $this->translator->getLocale();
        return $query->where('lang_code', $lang_id);
    }

}
