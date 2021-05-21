<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Status;

class StatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //คำสั่งรัน php artisan db:seed --class=StatusesSeeder

        $data1 = new Status;
        $data1->name_status = 'admin';
        $data1->save();

        $data2 = new Status;
        $data2->name_status = 'teacher';
        $data2->save();

        $data3 = new Status;
        $data3->name_status = 'student';
        $data3->save();

        $data4 = new Status;
        $data4->name_status = 'user';
        $data4->save();

    }
}
