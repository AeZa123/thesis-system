<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thesis extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'words_search',
        'file_thesis',
        'img',
        'status',
        'created_at',
    ];

    public function users_theses(){

        return $this->belongsTo(\App\Models\UsersThesis::class, 'id', 'theses_id');

    }

    public function download(){

        return $this->belongsTo(\App\Models\Download::class);

    }
}
