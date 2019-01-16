<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
       	$this->call(RoleTableSeeder::class);
	   	// User seeder RoleTableSeederwill use the roles above created.
	   	 $this->call(UserTableSeeder::class);
    }
}
