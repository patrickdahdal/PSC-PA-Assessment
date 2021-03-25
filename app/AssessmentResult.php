<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssessmentResult extends Model
{
    protected $table = 'assessments_results';
    protected $fillable = ['assessment_id', 'content'];

    public $timestamps = false;

    public function assessment()
    {
        return $this->belongsTo(Assessment::class, 'assessment_id');
    }
}
