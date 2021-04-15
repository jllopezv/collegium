<?php

namespace App\Jobs;

use App\Mail\SendContact;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendContactFormJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $name;
    protected $phone;
    protected $email;
    protected $subject;
    protected $message;

    /**
     * Create a new job instance.
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
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to(appsetting('email_to'))->send(new SendContact($this->name,$this->phone,$this->email,$this->subject,$this->message));
    }
}
