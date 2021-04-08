<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Notifications\customPasswordResetNotification;
use Log;

class CustomerResetPassword extends Model
{
    //
    use Notifiable;

    public function sendPasswordResetNotification($token) {
        $this->notify(new customPasswordResetNotification($token));
    }
}
