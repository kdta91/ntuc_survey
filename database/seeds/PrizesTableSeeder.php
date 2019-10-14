<?php

use Illuminate\Database\Seeder;

class PrizesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('prizes')->insert([
            [
                'name' => 'Pen',
                'qty' => 200
            ],
            [
                'name' => 'Notebook',
                'qty' => 100
            ],
            [
                'name' => 'Collapsible Eco-Mug',
                'qty' => 35
            ],
            [
                'name' => 'Tote Bag',
                'qty' => 37
            ],
        ]);
    }
}
