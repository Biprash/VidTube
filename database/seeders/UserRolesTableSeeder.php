<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Role;

class UserRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users_roles')->insert(array(
            [
                'user_id' => User::first()->id,
                'role_id' => Role::where('name','admin')->first()->id,
                'created_at' => '2020-05-29 12:46:45',
                'updated_at' => '2020-05-29 12:46:45',
            ]
        ));
    }
}
