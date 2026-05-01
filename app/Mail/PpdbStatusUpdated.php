<?php

namespace App\Mail;

use App\Models\Registration;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PpdbStatusUpdated extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public Registration $registration;
    public string $previousStatus;

    public function __construct(Registration $registration, string $previousStatus)
    {
        $this->registration = $registration;
        $this->previousStatus = $previousStatus;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Status PPDB Anda Telah Diperbarui - ' . $this->registration->registration_number,
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.ppdb.status-updated',
            with: [
                'registration' => $this->registration,
                'previousStatus' => $this->previousStatus,
                'url' => url('/ppdb/cek-status'),
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
