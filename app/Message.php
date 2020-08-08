<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['customer_id','email','subject','content','contact','comment','article_id','answer','user_id'];
}
