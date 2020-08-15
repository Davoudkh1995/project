<?php

namespace App\Http;

use Illuminate\Database\Eloquent\Model;

class Seo extends Model{
    protected $fillable = ['title','description','canonical','keywords','follow','index','seo_url'];

    protected $casts = [
        'keywords' => 'array',
    ];
}
