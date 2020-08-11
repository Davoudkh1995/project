<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuDynamicTable extends Model
{
    protected $fillable = ['name','permission_id'];
}
