<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use SoftDeletes;

    protected $table = 'questions';
    protected $fillable = ['question', 'number', 'group'];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function assessments_answers()
    {
        return $this->hasMany(AssessmentAnswer::class, 'question_id');
    }
}
