<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            [
                'name'     => '管理者',
                'login_id' => 'admin',
                'password' => Hash::make('12345678')
            ]
        ]);
    }
}
