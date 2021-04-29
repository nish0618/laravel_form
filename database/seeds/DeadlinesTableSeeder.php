<?php

use Illuminate\Database\Seeder;

class DeadlinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('deadlines')->insert([
            'end_publication_period' => '2030-03-30 00:00',
            'end_gift_redemption' => '2030-03-31 18:31'
        ]);
    }
}
