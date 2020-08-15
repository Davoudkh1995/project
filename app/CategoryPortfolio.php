<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryPortfolio extends Model
{
    protected $fillable = ['slug','title','tags','status','parent_id','usersID_FK','lang','seo_id'];

    public function portfolio()
    {
        return $this->hasMany(Portfolio::class,'categoryID_FK');
    }
    public function seo()
    {
        return $this->belongsTo(Seo::class);
    }
}
