<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class CategoryService extends Model
{
    protected $fillable = ['slug','title','tags','status','parent_id','usersID_FK','lang','seo_id','seo_id'];

    public function service()
    {
        return $this->hasMany(Service::class,'categoryID_FK');
    }
    public function seo()
    {
        return $this->belongsTo(Seo::class);
    }
}
