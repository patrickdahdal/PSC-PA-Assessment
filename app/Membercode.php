<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Membercode extends Model
{
    use SoftDeletes;

    protected $table = 'membercodes';
    protected $fillable = ['customer_id', 'membercode'];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function respondents()
    {
        return $this->hasMany(Respondent::class, 'membercode_id');
    }
}
