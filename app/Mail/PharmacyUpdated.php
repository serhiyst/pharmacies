<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PharmacyUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public $pharmacy;
    public $changes;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pharmacy, $changes)
    {
        $this->pharmacy = $pharmacy;
        $this->changes = $changes;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.pharmacy-updated')->subject('Внесены изменения в данные аптеки');
    }
}