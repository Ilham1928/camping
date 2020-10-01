<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_role')->insert([
            'role_name'        => 'Super Admin',
            'role_description' => 'Access All Module',
            'status'           => '1'
        ]);

        $param = [
            [
                'role_id' => 1,
                'menu_id' => 1,
                'menu_view' => '1',
                'menu_add' => '1',
                'menu_edit' => '1',
                'menu_delete' => '1',
                'menu_other' => '1'
            ],
            [
                'role_id' => 1,
                'menu_id' => 2,
                'menu_view' => '1',
                'menu_add' => '1',
                'menu_edit' => '1',
                'menu_delete' => '1',
                'menu_other' => '1'
            ],
            [
                'role_id' => 1,
                'menu_id' => 3,
                'menu_view' => '1',
                'menu_add' => '1',
                'menu_edit' => '1',
                'menu_delete' => '1',
                'menu_other' => '1'
            ]
        ];
        DB::table('admin_role_permission')->insert($param);
    }
}
