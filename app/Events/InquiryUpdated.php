<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Inquiry;

class InquiryUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $inquiry;
    public $author_id;
    public $current_pos;
    public $max_pos;

    /**
     * Create a new event instance.
     */
    public function __construct(Inquiry $inquiry, $author_id)
    {
        $this->inquiry = $inquiry;
        $this->author_id = $author_id;

        $inq_id = $inquiry->id;
        $lab_id = $inquiry->lab->id;
        $inqs = Inquiry::all()->filter(function (Inquiry $in) use ($lab_id)
        {
            return $in->lab_id == $lab_id && $in->assistant_id == null;
        })->sortBy('created_at');

        $this->current_pos = $inqs->search(function (Inquiry $in) use ($inq_id)
        {
            return $in->id == $inq_id;
        });
        $this->max_pos = $inqs->count();
    }

    public function broadcastOn()
    {
        return ['inquiry-' . $this->inquiry->id];
    }

    public function broadcastAs()
    {
        return 'notify';
    }
}
