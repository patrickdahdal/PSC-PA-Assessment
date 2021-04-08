<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;

    protected $table = 'customers';
    protected $fillable = ['company_name', 'first_name', 'last_name', 'title', 'email', 'phone', 'password', 'active'];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function membercode()
    {
        return $this->hasOne(Membercode::class, 'customer_id');
    }
}
