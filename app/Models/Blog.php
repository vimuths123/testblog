<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'user_id'];

    protected $dates = ['published_date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
