<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class RespondentScore extends Notification
{
    use Queueable;
    public $respondent, $email, $name, $results, $chart;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($respondent, $results)
    {
        $this->respondent = $respondent;
        $this->email = $this->respondent->email;
        $this->name = $this->respondent->first_name.' '.$this->respondent->last_name;
        $this->results = $results;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {   
        return (new MailMessage)
            ->subject("Your Test Results")
            ->markdown('email.respondent', ['results' => $this->results]);
    }
}
