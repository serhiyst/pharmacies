<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PharmacyDeleted extends Mailable
{
    use Queueable, SerializesModels;

    public $pharmacy;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pharmacy)
    {
        $this->pharmacy = $pharmacy;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.pharmacy-deleted')->subject('Аптека удалена');
    }
}
