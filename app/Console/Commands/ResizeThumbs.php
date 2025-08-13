<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ImageCompressor;
use Illuminate\Support\Facades\Storage;

class ResizeThumbs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:resize-thumbs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected ImageCompressor $compressor;

    protected int $maxWidth = 350;
    protected int $maxHeight = 250;

    public function __construct(ImageCompressor $compressor)
    {
        parent::__construct();
        $this->compressor = $compressor;
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

            $compressedPath = $this->compressor->compress($file, 200, $this->maxWidth, $this->maxHeight);

            if ($compressedPath) {
                $this->info("Saved compressed: {$compressedPath}");
            } else {
                $this->error("Failed to compress: {$file}");
            }
        }

        $this->info('Done.');
        return 0;
    }
}
