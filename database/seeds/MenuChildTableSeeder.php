<?php

use Illuminate\Database\Seeder;

class MenuChildTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $child = [
            [
                'menu_child_name' => 'Master Admin',
                'menu_child_url' => 'admin-master',
                'menu_parent_id' => 1
            ],
            [
                'menu_child_name' => 'Hak Akses Admin',
                'menu_child_url' => 'admin-roles',
                'menu_parent_id' => 1
            ],
            [
                'menu_child_name' => 'Master Barang',
                'menu_child_url' => 'item-master',
                'menu_parent_id' => 2
            ],
            [
                'menu_child_name' => 'Kategori Barang',
                'menu_child_url' => 'item-category',
                'menu_parent_id' => 2
            ],
            [
                'menu_child_name' => 'Master Pemandu',
                'menu_child_url' => 'guide-master',
                'menu_parent_id' => 3
            ],
            [
                'menu_child_name' => 'Master Pesanan',
                'menu_child_url' => 'order-master',
                'menu_parent_id' => 4
            ],
            [
                'menu_child_name' => 'Kelola Keuangan',
                'menu_child_url' => 'price-master',
                'menu_parent_id' => 5
            ]
        ];

        DB::table('menu_child')->insert($child);
    }
}
