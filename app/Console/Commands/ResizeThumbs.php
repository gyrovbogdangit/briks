<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;

class ResizeThumbs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'compress:resize-thumbs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected ImageManager $imageManager;

    public function __construct()
    {
        parent::__construct();
        $this->imageManager = new ImageManager(new \Intervention\Image\Drivers\Gd\Driver());
    }

    public function handle()
    {
        $this->info('Start resizing cover images...');

        $folder = 'products/thumbs';

        if (!Storage::disk('public')->exists($folder)) {
            $this->error("Folder {$folder} does not exist.");
            return 1;
        }

        $files = Storage::disk('public')->files($folder);

        foreach ($files as $file) {
            $this->info("Processing: {$file}");

            $originalData = Storage::disk('public')->get($file);
            $image = $this->imageManager->read($originalData);

            $maxWidth = 350;
            $maxHeight = 250;

            $originalWidth = $image->width();
            $originalHeight = $image->height();

            $ratio = min($maxWidth / $originalWidth, $maxHeight / $originalHeight);

            $newWidth = (int) round($originalWidth * $ratio);
            $newHeight = (int) round($originalHeight * $ratio);

            $image->resize($newWidth, $newHeight, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $encoded = $image->encode(new \Intervention\Image\Encoders\WebpEncoder(quality: 80));
            Storage::disk('public')->put($file, $encoded->toString());

            $this->info("Saved resized: {$file}");
        }

        $this->info('Done.');
        return 0;
    }
}
