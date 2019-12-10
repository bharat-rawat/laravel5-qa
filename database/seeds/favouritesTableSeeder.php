<?php

use App\Question;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class favouritesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questions = Question::all();
        $user = User::all();
        foreach($questions as $quesion){
            for($i=0;$i<rand(1,$user->count());$i++){
                $quesion->favourites()->attach($user[$i]);
            } 
        }
    }
}
