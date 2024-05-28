<?php

namespace Webkul\RMA\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomerRmaCreationEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The RMA data.
     *
     * @var array
     */
    public $customerRmaData;

    /**
     * Create a new message instance.
     *
     * @param  array  $customerRmaData
     * @return void
     */
    public function __construct($customerRmaData)
    {
        $this->customerRmaData = $customerRmaData;
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
            ->to($this->customerRmaData['email'])
            ->subject('New RMA Request')
            ->view('rma::emails.customers.new-rma-request')
            ->with($this->customerRmaData);
    }
}
