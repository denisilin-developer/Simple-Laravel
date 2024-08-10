<?php

namespace App\Listeners;

use App\Events\SubmissionSaved;
use Illuminate\Support\Facades\Log;

class LogSubmissionSaved
{
    /**
     * Handle the event.
     */
    public function handle(SubmissionSaved $event): void
    {
        Log::info(__("submission.submission_saved", ['name' => $event->submission->getAttribute('name'), 'email' => $event->submission->getAttribute('email')]));
    }
}
