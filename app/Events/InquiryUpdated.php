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

    /**
     * Create a new event instance.
     */
    public function __construct(Inquiry $inquiry, $author_id)
    {
        $this->inquiry = $inquiry;
        $this->author_id = $author_id;
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
