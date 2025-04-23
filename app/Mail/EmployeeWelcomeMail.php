<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EmployeeWelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $employee;
    public $password;

    /**
     * Create a new message instance.
     */
    public function __construct($employee, $password)
    {
        $this->employee = $employee;
        $this->password = $password;
    }


        /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Bienvenue sur StaffHub - Vos informations de connexion',
        );
    }
} 