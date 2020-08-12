<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = ['slider_type','picture','title','description','link','priority','status','usersID_FK','lang'];
}
