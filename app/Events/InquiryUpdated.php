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

    /**
     * Create a new event instance.
     */
    public function __construct(Inquiry $inquiry)
    {
        $this->inquiry = $inquiry;
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
