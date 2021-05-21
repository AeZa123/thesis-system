<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code_id',
        'name',
        'email',
        'password',
        'phone',
        'img',
        'status_id',
        'group_id',
        'active',
    ];


    public function status(){

        return $this->belongsTo(\App\Models\Status::class);

    }

    public function users_theses(){

        return $this->belongsTo(\App\Models\UsersThesis::class, 'id', 'users_id');

    }

    public function download(){

        return $this->belongsTo(\App\Models\Download::class);

    }

    //about export file csv excel
    public static function getUsers(){

        $datas = DB::table('users')
            ->join('statuses','users.status_id', '=', 'statuses.id')
            ->select('users.id', 'users.code_id', 'users.name',
                     'users.email','users.password','users.phone',
                     'users.created_at', 'statuses.name_status', 'users.active')
            ->get()->toArray();

        return $datas;
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



}


