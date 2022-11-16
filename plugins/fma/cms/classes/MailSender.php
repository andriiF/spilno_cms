<?php

namespace Fma\Cms\Classes;

use Illuminate\Support\Facades\Mail;

class MailSender {

    public $email_from;
    public $template;
    public $title;
    public $vars;
    public $dw = [];

    public function __construct($template, $email, $title) {
        $this->template = $template;
        $this->email_from = $email;
        $this->title = $title;
    }

    public function sendMail() {

        $email = $this->email_from;
        $title = $this->title;
        $cc = $this->dw;


        Mail::send($this->template, $this->vars, function($message) use ($email, $title, $cc) {

            $message->to($email);
            $message->subject($title);
            if (!empty($cc)) {
                foreach ($cc as $cc_email) {
                    $message->cc($cc_email);
                }
            }
        });
    }

}
