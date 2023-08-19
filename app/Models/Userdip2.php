<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

/////Userdip2 is my base table and this table is under the Auth
class Userdip2 extends Model implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable; ////here i conneted my userdip2 table with Auth and i have also written 'model' => App\Models\Userdip2::class, in config/auth.php

    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id'); ////user will be able to write many comment and that's why i'm using hasMany here and everytimes i will store user_id in my post table as well what's why i have written user_id here
    }

    public function likes()
    {
        return $this->hasMany(Like::class , 'user_id');
    }
}
