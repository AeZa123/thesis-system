<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings():array{

        return[
            'id',
            'code_id',
            'name',
            'email',
            'password',
            'phone',
            'create_at',
            'status',

        ];
    }


    public function collection()
    {
       // return User::all();
       return collect(User::getUsers());
    }
}
