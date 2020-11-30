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
        // $this->call(UserSeeder::class);
        $this->call(BusStopsTableSeeder::class);
        $this->call(PostCodesTableSeeder::class);
        $this->call(SchoolsTableSeeder::class);
        $this->call(AddressesTableSeeder::class);
        $this->call(AppUsersTableSeeder::class);
        $this->call(ChatsTableSeeder::class);
        $this->call(HousesTableSeeder::class);
        $this->call(LikesTableSeeder::class);
        $this->call(PeopleTableSeeder::class);
    }
}
