<?php

use Illuminate\Database\Seeder;

class TicketCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('categories')->insert([
            'category_name' => 'Normal Ticket',
            'price' => '400 EG',
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),

        ]);
        \Illuminate\Support\Facades\DB::table('categories')->insert([
            'category_name' => 'Student Ticket',
            'price' => '200 EG',
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),

        ]);
    }
}
