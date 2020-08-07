<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageServices extends Model
{
    protected $fillable = ['serviceID_FK','imageUrl'];

    public function service()
    {
        return $this->belongsTo(Service::class,'serviceID_FK');
    }
}
