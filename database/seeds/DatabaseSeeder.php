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
	    // Role data creation must first execute 
	    $this->call(RoleTableSeeder::class);
	    // Users will need the previously generated roles 
	    $this->call(UserTableSeeder::class);
    }
}
