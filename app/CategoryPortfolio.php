<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryPortfolio extends Model
{
    protected $fillable = ['slug','title','tags','status','parent_id','usersID_FK'];

    public function portfolio()
    {
        return $this->hasMany(Portfolio::class,'categoryID_FK');
    }
}
