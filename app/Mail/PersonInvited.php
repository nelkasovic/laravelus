<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Event;

class PersonInvited extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The event instance.
     *
     * @var Event
     */
    public $event;

    /**
     * Create a new message instance.
     */
    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.person.invited');
        //->text('emails.person.invited.plain')
                    //->attach('/path/to/file', [
                    //    'as' => 'name.pdf',
                    //    'mime' => 'application/pdf',
                    //]);
    }
}
