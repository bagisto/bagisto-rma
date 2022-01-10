<?php

namespace Webkul\RMA\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AdminConversationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $conversation;

    public function __construct($conversation) {
        $this->conversation = $conversation;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(core()->getSenderEmailDetails()['email'], core()->getSenderEmailDetails()['name'])
            ->to($this->conversation['customerEmail'])
            ->subject('New Message')
            ->view('rma::emails.conversation.admin.message')
            ->with($this->conversation);       
    }
}
