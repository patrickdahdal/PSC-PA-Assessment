<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assessment extends Model
{
    use SoftDeletes;

    protected $table = 'assessments';
    protected $fillable = ['respondent_id'];
    protected $appends = ['is_incomplete'];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function respondent()
    {
        return $this->belongsTo(Respondent::class, 'respondent_id');
    }

    public function assessments_answers()
    {
        return $this->hasMany(AssessmentAnswer::class, 'assessment_id');
    }

    public function getIsIncompleteAttribute()
    {
        $num_questions = config('assessment.questions_number', 210);
        if ($this->assessments_answers && count($this->assessments_answers) >= $num_questions) {
            return false;
        } else {
            return true;
        }
    }
}
