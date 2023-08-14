<?php

namespace App\Models;

 
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user()
    {
        return $this->belongsTo(Userdip2::class);  ///Userdip2 is my parents table and post is my child table....child table will always belongs to parents table as i have done
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
