<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function question(){
        return $this->belongsTo(Question::class);
    }
    public static function boot(){
        parent::boot();

        static::created(function(Answer $answer){
            $answer->question()->increment('answers_count');
        });
            
    }
    
}