<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Answer;
use Carbon\Carbon;

class Question extends Model
{
    protected $fillable = ['title','body'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function answers(){
        return $this->hasMany(Answer::class);
    }

    public function favourites(){
        return $this->belongsToMany(User::class,'favourites')->withTimestamps();
    }
    
    public function isFavourited(){
        return $this->favourites()->where('user_id',auth()->id())->count()>0;
    }
    public function getIsFavouritedAttribute(){
        return $this->isFavourited();
    }
    public function getFavouriteCountAttribute(){
        return $this->favourites()->count();
    }

    public function setTitleAttribute($value){
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = str_slug($value);
    }

    public function getUrlAttribute(){
        return route('question.show',$this->id);
    }

    public function getCreatedDateAttribute(){
        return $this->created_at->diffForHumans();
    }

    public function getStatusAttribute(){
        if($this->answers_count>0){
            if($this->best_answer_id){
                return 'answer-accepted';
            }
            return 'answered';
        }
        return 'unanswered';
    }
}
