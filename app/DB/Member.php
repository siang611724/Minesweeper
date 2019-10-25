<?php

namespace App\DB;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = "users";
    protected $fillable = ['status'];

}
