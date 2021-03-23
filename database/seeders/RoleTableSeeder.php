<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // if used \DB no need to import else need to import
        DB::table('roles')->insert(
            array(
                [
                    'name' => 'Admin',
                    'created_at' => '2020-05-29 12:46:45',
                    'updated_at' => '2020-05-29 12:46:45',
                ],
                [
                    'name' => 'Channel',
                    'created_at' => '2020-05-29 12:46:45',
                    'updated_at' => '2020-05-29 12:46:45',
                ],
                [
                    'name' => 'User',
                    'created_at' => '2020-05-29 12:46:45',
                    'updated_at' => '2020-05-29 12:46:45',
                ],
            )
        );
    }
}
