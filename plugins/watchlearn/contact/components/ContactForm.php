<?php namespace Watchlearn\Contact\Components;

use Cms\Classes\ComponentBase;
use Input;
use Mail;
use Validator;
use Redirect;

class ContactForm extends ComponentBase
{
    public  function componentDetails()
    {
        return [
            'name'=>'Contact Form',
            'description'=>'Simple contact form'
        ];
    }

    public function onSend(){


        $validator=Validator::make(
            [
                'name'=>Input::get('name'),
                'email' => Input::get('email')
            ],
            [
                'name'=>'required|min:5',
                'email'=>'required|email'
            ]
        );


        if($validator->fails()){

             return ['#result'=>$this->renderPartial('contactform::messages',[
                 'errorMsgs'=>$validator->messages()->all(),
                 'fieldMsgs'=>$validator->messages()
             ])];
        }else {
            $vars = ['name' => Input::get('name'), 'email' => Input::get('email'), 'content' => Input::get('content')];

            Mail::send('watchlearn.contact::mail.message', $vars, function ($message) {
                $message->to('admin@domain.tld', 'Admin Person');
                $message->subject('New message from contact form');
            });
        }
    }

    private function messages()
    {
    }


}
