<?php

namespace Database\Seeders;

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
       // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'email'=>'nastya@gmail.com',
            'name'=>'nastya',
            'is_admin'=>true
        ]);

        \App\Models\User::factory()->create([
            'email'=>'kostya@gmail.com',
            'name'=>'nastya'
        ]);

        $this->call([ListingSeeder::class]);
    }
}
