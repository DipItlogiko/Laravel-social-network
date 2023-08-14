<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public function user()
    {
        return $this->belongsTo(Userdip2::class); /// like is my child table and userdip2 is my parents table...and child table always belongs parents table
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

}
