<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;

    //les données qu'on veut travailler avec..... 
    protected $fillable = [
        'title',
        'body',
        'user_id'
    ];

    public function blogHasUser()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
}
