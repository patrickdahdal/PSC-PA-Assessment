<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssessmentScore extends Model
{
    protected $table = 'assessments_score';
    protected $fillable = ['assessment_id', 'trait_id', 'score'];

    public $timestamps = false;

    public function assessment()
    {
        return $this->belongsTo(Assessment::class, 'assessment_id');
    }

    public function trait()
    {
        return $this->belongsTo(TraitModel::class, 'trait_id');
    }
}
