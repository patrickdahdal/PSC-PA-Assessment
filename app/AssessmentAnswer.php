<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssessmentAnswer extends Model
{
    protected $table = 'assessments_answers';
    protected $fillable = ['assessment_id', 'question_id', 'answer_id'];

    public $timestamps = false;

    public function assessment()
    {
        return $this->belongsTo(Assessment::class, 'assessment_id');
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }

    public function answer()
    {
        return $this->belongsTo(Answer::class, 'answer_id');
    }
}
