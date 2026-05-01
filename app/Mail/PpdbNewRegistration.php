<?php

namespace App\Mail;

use App\Models\Registration;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PpdbNewRegistration extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public Registration $registration;

    public function __construct(Registration $registration)
    {
        $this->registration = $registration;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pendaftar PPDB Baru - ' . $this->registration->registration_number,
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.ppdb.new-registration',
            with: [
                'registration' => $this->registration,
                'url' => url('/admin/registrations/' . $this->registration->id . '/edit'),
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
