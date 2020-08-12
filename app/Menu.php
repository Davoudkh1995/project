<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = ['title','slug','status','parent_id','url','usersID_FK','page_id','lang'];

    public function page()
    {
        return $this->hasOne('App\Page');
    }
}
