<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UserImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        return new User([
            'code_id'=>$row['code_id'],
            'name' => $row['name'],
            'email' => $row['email'],
            'phone' => $row['phone'],
            'password' => Hash::make($row['password']),
            'status_id' => $row['status_id'],
            'group_id' => $row['group_id'],
            'active' => $row['active'],

        ]);
    }
}
