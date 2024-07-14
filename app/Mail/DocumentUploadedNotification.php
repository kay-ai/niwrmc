<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DocumentUploadedNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $application;
    public $documents;

    /**
     * Create a new message instance.
     */
    public function __construct($application, $documents)
    {
        $this->application = $application;
        $this->documents = $documents;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Documents Uploaded',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.documents_uploaded_notification',
            with: [
                'application' => $this->application,
                'documents' => $this->documents,
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
        $attachments = [];

        foreach ($this->documents as $document) {
            $attachment = Attachment::fromPath(storage_path('app/public/' . $document->url))
                                    ->as($document->name . '.' . pathinfo($document->url, PATHINFO_EXTENSION))
                                    ->withMime('application/pdf');

            $attachments[] = $attachment;
        }

        return $attachments;
    }
}
