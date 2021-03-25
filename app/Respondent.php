<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Respondent extends Model
{
    use SoftDeletes;

    protected $table = 'respondents';
    protected $fillable = ['membercode_id', 'first_name', 'last_name', 'gender', 'adult', 'email', 'phone', 'best_reached', 'remark'];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function membercode()
    {
        return $this->belongsTo(Membercode::class, 'membercode_id');
    }

    public function assessments()
    {
        return $this->hasMany(Assessment::class, 'respondent_id');
    }
}
