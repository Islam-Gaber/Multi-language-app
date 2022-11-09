<?php

namespace App\Models;
use Cviebrock\EloquentSluggable\Sluggable;
use Nicolaslopezj\Searchable\SearchableTrait;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory, HasTranslations, Sluggable, SearchableTrait;

    protected $guarded = [];
    public $translatable = ['title', 'slug', 'body'];

    public function sluggable()
    {
        return [
            'slug->en' => [
                'source' => 'titleen',
            ],
            'slug->ar' => [
                'source' => 'titlear',
            ],
            'slug->ca' => [
                'source' => 'titleca',
            ]
        ];
    }

    // تجعل الترجمة تتعرف علي كود اللغة العربية
    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }

}
