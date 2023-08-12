<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Userdip2 extends Model implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable;

    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id'); ////user will be able to write many comment and that's why i'm using hasMany here and everytimes i will store user_id in my post table as well what's why i have written user_id here
    }
}
