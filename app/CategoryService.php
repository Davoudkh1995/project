<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryService extends Model
{
    protected $fillable = ['slug','title','tags','status','parent_id','usersID_FK','lang'];

    public function service()
    {
        return $this->hasMany(Service::class,'categoryID_FK');
    }
}
