<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Question;
use App\Answer;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $appends =['url','avatar'];
    public function questions(){
        return $this->hasMany(Question::class);
    }
    public function answers(){
        return $this->hasMany(Answer::class);
    }
    public function favourites(){
        return $this->belongsToMany(Question::class,'favourites')->withTimestamps();
    }


    public function voteQuestions(){
        return $this->morphedByMany(Question::class,'votable');
    }
    public function voteAnswers(){
        return $this->morphedByMany(Answer::class,'votable');
    }

public function voteQuestion(Question $question,$vote){
    // check if user has voted or not
    $votesQuestions = $this->voteQuestions();
    $this->_vote($votesQuestions,$question,$vote);
    // if($votesQuestions->where('votable_id',$question->id)->exists()){
    //     $votesQuestions->updateExistingPivot($question,['vote'=>$vote]);
    // }else{
    //     $votesQuestions->attach($question,['vote'=>$vote]);
    // }
    // // in order to calculate the votes_count first refresh the relationship
    // $this->load('voteQuestions');

    // $voteDown = (int) $question->downVote()->sum('vote');
    // $voteUp = (int) $question->upVote()->sum('vote');

    // $voteTotal = $voteDown + $voteUp;
    // $question->votes_count = $voteTotal;
    // $question->save();
}
public function voteAnswer(Answer $answer,$vote){
    $voteAnswer = $this->voteAnswers();
    $this->_vote($voteAnswer,$answer,$vote);
    // if($voteAnswer->where('votable_id',$answer->id)->exists()){
    //     $voteAnswer->updateExistingPivot($answer,['vote'=>$vote]);
    // }else{
    //     $voteAnswer->attach($answer,['vote'=>$vote]);
    // }
    // $this->load('voteAnswers');
    // $voteDown = (int) $answer->downVote()->sum('vote');
    // $voteUp = (int) $answer->upVote()->sum('vote');
    // $answer->votes_count = $voteDown + $voteUp;
    // $answer->save();

}
private function _vote($relationship,$model,$vote){
    if($relationship->where('votable_id',$model->id)->exists()){
        $relationship->updateExistingPivot($model,['vote'=>$vote]);
    }else{
        $relationship->attach($model,['vote'=>$vote]);
    }
    $this->load('voteAnswers');
    $voteDown = (int) $model->downVote()->sum('vote');
    $voteUp = (int) $model->upVote()->sum('vote');
    $model->votes_count = $voteDown + $voteUp;
    $model->save();
}




    public function getUrlAttribute(){
        return "#";
    }
    public function getAvatarAttribute(){
        return '#';
    }

}
