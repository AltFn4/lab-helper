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

    public $code;
    public $id;
    public $author_id;
    public $assignee;
    public $current;
    public $max;

    /**
     * Create a new event instance.
     */
    public function __construct(Inquiry $inquiry, $author_id=-1)
    {
        $this->id = $inquiry->id;
        $this->code = $inquiry->code;
        $this->author_id = $author_id;

        if ($inquiry->assistant_id != NULL)
        {
            $this->assignee = $inquiry->assistant->name;
        } else {
            $lab_id = $inquiry->lab->id;
            $ids = Inquiry::all()->filter(function (Inquiry $in) use ($lab_id) {
                return $in->lab_id == $lab_id && $in->assistant_id == null;
            })->sortBy('created_at')->map(function($in) {
                return $in->id;
            });

            $this->current = 1;
            foreach ($ids as $id) {
                if ($id == $inquiry->id) {
                    break;
                }
                $this->current++;
            }
            $this->max = $ids->count();
        }
    }

    public function broadcastOn()
    {
        return ['inquiry-' . $this->id];
    }

    public function broadcastAs()
    {
        return 'notify';
    }
}
