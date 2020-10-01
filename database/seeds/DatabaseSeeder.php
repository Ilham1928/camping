<?php
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            IconTableSeeder::class,
            MenuParentTableSeeder::class,
            MenuChildTableSeeder::class,
            UserTableSeeder::class,
            RoleTableSeeder::class
        ]);
    }
}
