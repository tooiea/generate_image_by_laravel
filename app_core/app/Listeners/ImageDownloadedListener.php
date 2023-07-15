<?php

namespace App\Listeners;

use App\Events\ImageDownloaded;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Storage;

class ImageDownloadedListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ImageDownloaded $event): void
    {
        $path = $event->getPathToImage();
        // 画像の削除処理を実装する
        Storage::delete($path);
    }
}
