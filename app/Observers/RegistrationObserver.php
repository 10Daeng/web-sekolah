<?php

namespace App\Observers;

use App\Models\Registration;
use App\Mail\PpdbStatusUpdated;
use Illuminate\Support\Facades\Mail;

class RegistrationObserver
{
    private string $previousStatus = '';

    public function updating(Registration $registration): void
    {
        $this->previousStatus = $registration->getOriginal('status') ?? 'Pending';
    }

    public function updated(Registration $registration): void
    {
        if ($registration->wasChanged('status') && $registration->email) {
            Mail::to($registration->email)->send(
                new PpdbStatusUpdated($registration, $this->previousStatus)
            );
        }
    }
}
