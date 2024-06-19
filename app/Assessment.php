<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assessment extends Model
{
    use SoftDeletes;

    protected $table = 'assessments';
    protected $fillable = ['respondent_id'];
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
        try {
            $num_questions = config('assessment.questions_number', 210);
            if(is_null($this->assessments_answers)) {
                return true;
            } 
            if (count($this->assessments_answers) >= $num_questions) {
                return false;
            } else {
                return true;
            }
        } catch (\Throwable $e) {
            // Log::info('Error case');
        }
        return false;
    }

    public function getIncompleteAttribute($id)
    {
        try {
            $num_questions = config('assessment.questions_number', 210);
            $count = AssessmentAnswer::where('assessment_id', $id)->get()->count();

            if ($count >= $num_questions)
                return false;
            else return true;
        } catch (\Throwable $e) {
            // Log::info('Error case');
        }
        return false;   
    }

}
