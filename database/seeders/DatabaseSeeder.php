<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\User;
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
        User::factory(5)->create()->each(function(User $user){
            for($i = 1; $i < rand(5,10); $i++) {
                $user->questions()->create(Question::factory()->make()->toArray());
            }
        });
    }
}
