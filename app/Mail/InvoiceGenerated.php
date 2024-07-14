<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InvoiceGenerated extends Mailable
{
    use Queueable, SerializesModels;

    public $invoice;
    public $customer;
    public $application_name;
    public $payment_type;

    /**
     * Create a new message instance.
     */
    public function __construct($invoice, $customer, $application_name, $payment_type)
    {
        $this->invoice = $invoice;
        $this->customer = $customer;
        $this->application_name = $application_name;
        $this->payment_type = $payment_type;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Invoice Generated',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.invoice_generated',
            with: [
                'invoice' => $this->invoice,
                'customer' => $this->customer,
                'application_name' => $this->application_name,
                'payment_type' => $this->payment_type,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
