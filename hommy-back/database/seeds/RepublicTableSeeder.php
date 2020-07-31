<?php

use Illuminate\Database\Seeder;
use App\Republic;

class RepublicTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory (App\Republic::class, 5)->create()->each(function ($republic) {
            $comments = factory(App\Comment::class, 2)->make();
            $user = factory(App\User::class)->make();
            //1-1
            $republic->comments()->saveMany($comments);
            //1-n
            $republic->userLocatario()->save($user);
            //n-n
            $user->favoritas()->attach($republic);
            
        });
    }
}
