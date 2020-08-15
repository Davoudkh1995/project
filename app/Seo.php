<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Seo extends Model{
    protected $fillable = ['title','description','canonical','keywords','follow','index','seo_url'];

    public function about()
    {
        return $this->hasMany(Aboutus::class);
    }
    public function contact()
    {
        return $this->hasMany(Contactus::class);
    }
    public function page()
    {
        return $this->hasMany(Page::class);
    }
    public function article()
    {
        return $this->hasMany(Article::class);
    }
    public function service()
    {
        return $this->hasMany(Service::class);
    }
    public function portfolio()
    {
        return $this->hasMany(Portfolio::class);
    }
    public function cat_ser()
    {
        return $this->hasMany(CategoryService::class);
    }
    public function cat_art()
    {
        return $this->hasMany(CategoryArticle::class);
    }
    public function cat_por()
    {
        return $this->hasMany(CategoryPortfolio::class);
    }


}
