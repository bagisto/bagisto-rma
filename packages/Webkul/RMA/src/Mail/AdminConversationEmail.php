<?php

namespace Webkul\RMA\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminConversationEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The conversation data.
     *
     * @var array
     */
    public $conversation;

    /**
     * Create a new message instance.
     *
     * @param  array  $conversation
     * @return void
     */
    public function __construct($conversation)
    {
        $this->conversation = $conversation;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // Set the email sender details
        return $this->from(core()->getSenderEmailDetails()['email'], core()->getSenderEmailDetails()['name'])
            ->to($this->conversation['customerEmail'])
            ->subject('New Message')
            ->view('rma::emails.conversation.admin.message')
            ->with($this->conversation);
    }
}
