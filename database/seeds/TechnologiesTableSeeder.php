<?php

use Illuminate\Database\Seeder;

class TechnologiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('technologies')->insert([
            'name' => 'HTML CSS',
            'name' => 'JavaScript',
            'name' => 'jQuery',
            'name' => 'Ruby',
            'name' => 'PHP',
            'name' => 'Python',
        ]);
    }
}
