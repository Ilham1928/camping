<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_master')->insert([
            'admin_name'        => 'Jhon Doe',
            'admin_title'       => '',
            'admin_description' => 'Super Admin',
            'admin_email'       => 'admin@email.com',
            'admin_password'    => Hash::make('123456'),
            'role_id'           => 1,
            'admin_photo'       => '',
            'admin_token'       => '',
            'status'            => '1'
        ]);
    }
}
