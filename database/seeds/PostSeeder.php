<?php

use Illuminate\Database\Seeder;
use App\Post;

class PostSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        foreach ( range( 1, 15 ) as $index ) {
            Post::create( [
                "name"   => "Faisal Tamim",
                "email"  => "mdf41401@gmail.com",
                "mobile" => '01875715653',
            ] );
        }
        ;
    }
}
