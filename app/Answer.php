<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table = 'answers';
    protected $fillable = ['answer', 'number'];
    protected $dates = ['created_at', 'updated_at'];

    public function assessments_answers()
    {
        return $this->hasMany(AssessmentAnswer::class, 'answer_id');
    }
}
