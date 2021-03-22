<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TraitModel extends Model
{
    protected $table = 'traits';
    protected $fillable = ['key', 'trait', 'number'];
    protected $dates = ['created_at', 'updated_at'];

    public function assessments_score()
    {
        return $this->hasMany(AssessmentScore::class, 'trait_id');
    }
}
