<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = ['name','label','status','unique_name'];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
