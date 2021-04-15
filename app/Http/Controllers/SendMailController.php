<?php

namespace App\Http\Controllers;

use App\Mail\SendContact;
use App\Jobs\SendContactFormJob;
use Illuminate\Support\Facades\Mail;

class SendMailController extends Controller
{
    public function mail()
    {
        //Mail::to('jllopezvicente@gmail.com')->queue(new SendContact());
        dispatch(new SendContactFormJob('name','phone','email','subject','message'));
        return 'Email was enqueue';
    }
}
