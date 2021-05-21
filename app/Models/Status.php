<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Status extends Model
{
    use HasFactory;




    public function users(){

        return $this->hasMany(\App\Models\User::class);
    }
}
