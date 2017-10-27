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
        // $this->call(UsersTableSeeder::class);
        
        \DB::transaction( function() {
            $faker = \Faker\Factory::create();
            $users = factory(\App\Models\User::class,10)->create();
            $tags = factory(\App\Models\Tag::class, 50)->create();
            $posts = factory(\App\Models\Post::class, 50)->make();

            foreach ($posts as $post)  {
                $post->user()->associate( $faker->numberBetween( 1, $users->count() ) );
                $post->save();
                $post->tags()->attach( $faker->randomElements( $tags->pluck('id')->toArray(), $faker->numberBetween(1,5) ) );
            }
        });
    }
}
