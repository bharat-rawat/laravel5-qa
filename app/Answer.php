<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use VotableTrait;
    protected $fillable=['body','user_id'];
    protected $appends=['created_date'];
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function question(){
        return $this->belongsTo(Question::class);
    }
    public function getCreatedDateAttribute(){
        return $this->created_at->diffForHumans();
    }
    public function getStatusAttribute(){
        return $this->id === $this->question->best_answer_id?'vote-accepted':'';
    }
    public static function boot(){
        parent::boot();

        static::created(function(Answer $answer){
            $answer->question()->increment('answers_count');
        });    
        static::deleted(function(Answer $answer){
            $question = $answer->question;
            $question->decrement('answers_count');
            if($question->best_answer_id == $answer->id){
                $question->best_answer_id = null;
                $question->save();
            }
        });
    }
    
}