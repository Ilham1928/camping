<?php

use Illuminate\Database\Seeder;

class MenuParentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menu_parent')->insert([
            [
                'menu_parent_name' => 'Kelola Admin',
                'menu_icon_id'  => 1
            ],
            [
                'menu_parent_name' => 'Kelola Barang',
                'menu_icon_id' => 94
            ],
            [
                'menu_parent_name' => 'Kelola Pemandu',
                'menu_icon_id' => 44
            ],
            [
                'menu_parent_name' => 'Kelola Pesanan',
                'menu_icon_id' => 100
            ]
        ]);
    }
}
