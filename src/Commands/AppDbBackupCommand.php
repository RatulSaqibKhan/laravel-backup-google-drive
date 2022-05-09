<?php

namespace Ratulsaqibkhan\LaravelBackupGoogleDrive\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class AppDbBackupCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laravel-db:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Taking Backup of Database and Storage Folder';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        if (config('backup.backup_enable')) {
            File::delete(File::glob(base_path('backup/*.zip')));
            File::delete(File::glob(storage_path('app/public/*.zip')));
            Artisan::call('backup:run');
            if (config('backup.enable_copy_to_local_dir')) {
                File::copyDirectory('backup', config('backup.local_backup_dir'));
            }
        }

    }
}
