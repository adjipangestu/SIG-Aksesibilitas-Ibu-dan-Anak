<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    public $table = "role_user";
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'role_id'
    ];
}
