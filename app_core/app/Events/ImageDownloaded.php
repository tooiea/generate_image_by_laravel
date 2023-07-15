<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ImageDownloaded
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $path;

    /**
     * Create a new event instance.
     */
    public function __construct($path)
    {
        $this->path = $path;
    }

    /**
     * 取得したパスをリスナーへ
     *
     * @return string
     */
    public function getPathToImage()
    {
        return $this->path;
    }
}
