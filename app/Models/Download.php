<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Download extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'theses_id',
        'ip_address',
        'browser',
        'device',
        'os',
        'country',
        'province',
        'city',
        'latitude',
        'longitude',
    ];



    public function users(){

        return $this->hasMany(\App\Models\User::class);
    }

    public function theses(){

        return $this->hasMany(\App\Models\Thesis::class);

    }
}
