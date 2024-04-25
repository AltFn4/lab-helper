<?php

namespace App\Observers;

use App\Models\Inquiry;
use App\Events\InquiryUpdated;

class InquiryObserver
{
    private function updateEvent(Inquiry $inquiry): void
    {
        $lab_id = $inquiry->lab->id;
        Inquiry::all()->filter(function (Inquiry $in) use ($lab_id) {
            return $in->lab_id == $lab_id;
        })->each(function ($inq) {
            event(new InquiryUpdated($inq));
        });
    }
    /**
     * Handle the Inquiry "created" event.
     */
    public function created(Inquiry $inquiry): void
    {
        $this->updateEvent($inquiry);
    }

    /**
     * Handle the Inquiry "updated" event.
     */
    public function updated(Inquiry $inquiry): void
    {
        $this->updateEvent($inquiry);
    }

    /**
     * Handle the Inquiry "deleted" event.
     */
    public function deleted(Inquiry $inquiry): void
    {
        $this->updateEvent($inquiry);
    }

    /**
     * Handle the Inquiry "restored" event.
     */
    public function restored(Inquiry $inquiry): void
    {
        $this->updateEvent($inquiry);
    }

    /**
     * Handle the Inquiry "force deleted" event.
     */
    public function forceDeleted(Inquiry $inquiry): void
    {
        $this->updateEvent($inquiry);
    }

    /**
     * Handle the Inquiry "creating" event.
     */
    public function creating(Inquiry $inquiry): void
    {
        $this->updateEvent($inquiry);
    }

    /**
     * Handle the Inquiry "updating" event.
     */
    public function updating(Inquiry $inquiry): void
    {
        $this->updateEvent($inquiry);
    }

    /**
     * Handle the Inquiry "deleting" event.
     */
    public function deleting(Inquiry $inquiry): void
    {
        $this->updateEvent($inquiry);
    }

    /**
     * Handle the Inquiry "restoring" event.
     */
    public function restoring(Inquiry $inquiry): void
    {
        $this->updateEvent($inquiry);
    }

    /**
     * Handle the Inquiry "force deleting" event.
     */
    public function forceDeleting(Inquiry $inquiry): void
    {
        $this->updateEvent($inquiry);
    }
}
