<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\user;

class AdminMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $link;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function     __construct(User $user, string $link)
    {
        $this->user = $user;
        $this->link = $link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
//        return $this->view('view.name');
        return $this->from('admin@mailnator.com')->markdown('admin.mail.templates.template.new-admin')->
        with([
            'user' => $this->user,
            'link'=> $this->link
        ]);
    }
}
