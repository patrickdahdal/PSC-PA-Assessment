<?php

namespace App;

use Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Notifications\CustomPasswordResetNotification;

class CustomerResetPassword extends Model
{
    //
    use Notifiable;

    public function sendPasswordResetNotification($token) {
        $this->notify(new CustomPasswordResetNotification($token));
    }
}
