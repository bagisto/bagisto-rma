<?php

namespace Webkul\RMA\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CustomerConversationEmail extends Mailable
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
                ->to($this->conversation['adminEmail'])
                ->subject('New Message')
                ->view('rma::emails.conversation.customer.message')
                ->with($this->conversation);
    }
}
