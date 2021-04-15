<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendContact extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $phone;
    public $email;
    public $subject;
    public $message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $phone, $email, $subject, $message)
    {
        $this->name=$name;
        $this->phone=$phone;
        $this->email=$email;
        $this->subject=$subject;
        $this->message=$message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(appsetting('email_from'), appsetting('email_from_name'))
                     ->subject('FORMULARIO DE CONTACTO')
                     ->view('emails.contact', [
                         'name'     =>  $this->name,
                         'phone'    =>  $this->phone,
                         'email'    =>  $this->email,
                         'subject'  =>  $this->subject,
                         'message'  =>  $this->message,
                     ]);
    }
}
