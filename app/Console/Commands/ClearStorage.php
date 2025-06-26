<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ClearStorage extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'storage:clear';

    /**
     * The console command description.
     */
    protected $description = 'Delete all files and folders inside storage/app/public and storage/app/private directories.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $paths = [
            storage_path('app/public'),
            storage_path('app/private'),
        ];

        foreach ($paths as $path) {
            if (!File::exists($path)) {
                $this->warn("Path does not exist: {$path}");
                continue;
            }

            $files = File::allFiles($path);
            $directories = File::directories($path);

            foreach ($files as $file) {
                File::delete($file);
            }

            foreach ($directories as $directory) {
                File::deleteDirectory($directory);
            }

            $this->info("Cleared: {$path}");
        }

        $this->info('All specified storage folders cleared successfully!');
        return 0;
    }
}
