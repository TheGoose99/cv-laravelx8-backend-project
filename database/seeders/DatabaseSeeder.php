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

        // DACA nu ai un factory deja:

        // DB:table('users')->insert([
            // 'name'->...
        // ]);

        'App\Models\User'::factory()->count(10)->create()->each(function($user) {
            $user->posts()->save('App\Models\Post'::factory()->make());
        });

    }
}
