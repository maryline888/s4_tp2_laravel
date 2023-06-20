<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Documents extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'titre_fr',
        'titre_en',
        'date',
        'file',
        'user_id',
    ];

    /**
     * Get the student that owns the document.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
