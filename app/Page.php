<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = ['content','menu_id','lang','seo_id'];

    public function menu()
    {
        return $this->belongsTo('App\Menu');
    }
    public function seo()
    {
        return $this->belongsTo(Seo::class);
    }
}
