<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Customer extends Model
{
    use SoftDeletes, Notifiable;

    protected $table = 'customers';
    protected $fillable = ['company_name', 'first_name', 'last_name', 'title', 'email', 'phone', 'password', 'active'];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function membercode()
    {
        return $this->hasOne(Membercode::class, 'customer_id');
    }
}
