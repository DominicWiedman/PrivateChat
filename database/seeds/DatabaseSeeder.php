<?php

use Illuminate\Database\Seeder;
use App\User;

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
        factory(User::class)->create([
            'email' => 'test1@t.t',
            'name' =>  'Dominic',
        ]);

        factory(User::class)->create([
            'email' => 'test2@t.t',
            'name' =>  'Kira',
        ]);

        factory(User::class)->create([
            'email' => 'test3@t.t',
            'name' =>  'Less',
        ]);
    }
}
