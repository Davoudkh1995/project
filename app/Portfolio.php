<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $fillable = ['title','picture','slug','tags','content','priority','status','categoryID_FK','usersID_FK'];
    protected $casts = [
        'picture'=> 'array'
    ];

    public function category_portfolio()
    {
        return $this->belongsTo(CategoryPortfolio::class,'categoryID_FK');
    }
    /*public function images()
    {
        return $this->hasMany(ImageServices::class,'portfolioID_FK');
    }*/
}
