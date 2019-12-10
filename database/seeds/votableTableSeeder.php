<?php

use App\Question;
use App\User;
use Illuminate\Database\Seeder;

class votableTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $numOfUsers = $users->count();
        $votes =[-1,1];
        foreach(Question::all() as $question){
            for($i=0;$i<rand(1,$numOfUsers);$i++){
                $user = $users[$i];
                $user->voteQuestions()->attach($question,['vote'=>$votes[rand(0,1)]]);
            }
        }
    }
}
