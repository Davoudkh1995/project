<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = ['content','menu_id'];

    public function menu()
    {
        return $this->belongsTo('App\Menu');
    }
}
