<?php

namespace App\Http\Livewire\Website;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Jobs\SendContactFormJob;
use Illuminate\Support\Facades\Validator;

class ContactFormComponent extends Component
{
    public $name;
    public $phone;
    public $email;
    public $subject;
    public $message;
    public $captcha;
    public $captchagen;
    public $forceregen=2;


    public function mount()
    {
        $this->captchagen=Str::random(6);
    }

    /**
     * Rules to validate model
     *
     * @return array
     */
    public function validateRules() : array
    {
        return [
            'name'        => 'required|string|max:255',
            'phone'       => 'required|string|max:255',
            'email'       => 'required|email',
            'subject'     => 'required|string|max:255',
            'message'     => 'required|string|max:255',
        ];
    }

    /**
     * Validate only some fields
     *
     * @return void
     */
    public function validateFields()
    {
        return [
            'name'        => $this->name,
            'phone'       => $this->phone,
            'email'       => $this->email,
            'subject'     => $this->subject,
            'message'     => $this->message,
        ];
    }

    /**
     * Validation Attributes
     *
     * @return array
     */
    public function validateDefaultMessages() : array
    {
        return [
            'max'       =>
            [
                'string'    =>  'LA LONGITUD MÁXIMA ES DE :max',
                'numeric'   =>  'EL VALOR MÁXIMO ES :max',
            ],
            'min'       =>
            [
                'string'    =>  'LA LONGITUD MÍNIMA ES DE :min',
                'numeric'   =>  'EL VALOR MÍNIMO ES :min',
            ],
            'required'  =>  'EL CAMPO NO PUEDE QUEDAR VACÍO',
            'unique'    =>  'EL VALOR YA EXISTE. DEBE SER ÚNICO',
            'integer'   =>  'ESTE CAMPO DEBE SER UN NÚMERO',
            'string'    =>  'ESTE CAMPO DEBE SER UN TEXTO',
            'exists'    =>  'VALOR NO VÁLIDO',
            'array_size'=>  'DEBE SER UN ARRAY',
            'numeric'   =>  'DEBE INTRODUCIR UN NÚMERO',
            'date'      =>  'LA FECHA NO ES CORRECTA',
            'email'     =>  'EL CORREO ELECTRÓNICO NO ES VÁLIDO',
        ];
    }

    /**
     * Validation Attributes
     *
     * @return array
     */
    public function validateMessages() : array
    {
        return [];
    }


    public function sendform()
    {
        $this->resetValidation();
        $this->forceregen--;
        /* Validate captcha */
        if ($this->captchagen!=$this->captcha)
        {
            $this->addError('captcha', 'CÓDIGO INVÁLIDO');
            $this->emit('validationerror',$this->getErrorBag());
            if ($this->forceregen<1)
            {
                $this->regencaptcha();
                $this->forceregen=2;
            }
            return;
        }
        if ($this->forceregen<1)
        {
            $this->regencaptcha();
            $this->forceregen=2;
        }

        $validator=Validator::make(
            $this->validateFields(),
            $this->validateRules(),
            array_merge($this->validateMessages(), $this->validateDefaultMessages())
        );
        $validator->validate();

        dispatch(new SendContactFormJob($this->name,$this->phone,$this->email,$this->subject,$this->message));

        return redirect()->route('website.contactus.sended');
    }

    public function regencaptcha()
    {
        $this->captchagen=Str::random(6);
        $this->captcha='';
    }

    public function render()
    {
        return view('livewire.website.contact-form-component');
    }
}
