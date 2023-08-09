<?php

namespace App\Models;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Userdip2 extends Model implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable;
}
