<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersThesis extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'theses_id',
    ];


    public function users(){

        return $this->hasMany(\App\Models\User::class, 'id', 'users_id');
    }

    public function theses(){

        return $this->hasMany(\App\Models\Thesis::class, 'id', 'theses_id');

    }

}
