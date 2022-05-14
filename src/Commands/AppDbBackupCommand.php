<?php

namespace Ratulsaqibkhan\LaravelBackupGoogleDrive\Commands;

use Exception;
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
    protected $signature = 'laravel-app:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Taking Backup of Database and Customized Folders';

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
            try {
                $this->info("Starting backing up your application.");
                File::delete(File::glob(base_path('backup/*.zip')));
                File::delete(File::glob(storage_path('app/public/*.zip')));
                Artisan::call('backup:run');
                $this->info("Your application has been backed up successfully!");
            } catch (Exception $e) {
                $this->info("Something Went wrong!");
                $this->info($e->getMessage());
            }
        } else {
            $this->info("Please update BACKUP_ENABLE variable to true in the .env and add this variable in backup.php");
        }

    }
}
