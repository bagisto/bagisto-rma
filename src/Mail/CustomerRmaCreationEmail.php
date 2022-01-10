<?php

namespace Webkul\RMA\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CustomerRmaCreationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $customerRmaData;

    public function __construct($customerRmaData) {
        $this->customerRmaData = $customerRmaData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(core()->getSenderEmailDetails()['email'], core()->getSenderEmailDetails()['name'])
            ->to($this->customerRmaData['email'])
            ->subject('New RMA Request')
            ->view('rma::emails.customers.new-rma-request')
            ->with($this->customerRmaData);      
    }
}
