<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CustomerScore extends Notification
{
    use Queueable;
    public $customer;
    public $results;
    public $respondent;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($customer, $results, $respondent)
    {
        $this->customer = $customer;
        $this->results = $results;
        $this->respondent = $respondent;
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
            ->subject("New Test Results")
            ->markdown('email.customer', [
                'results' => $this->results, 
                'customer' => $this->customer, 
                'respondent' => $this->respondent
            ]);
    }
}
