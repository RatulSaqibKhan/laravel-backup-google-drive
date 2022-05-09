<?php

namespace Ratulsaqibkhan\LaravelBackupGoogleDrive;

use Illuminate\Support\ServiceProvider;
use Ratulsaqibkhan\Commands\AppDbBackupCommand;

class LaravelBackupGoogleDriveServiceProvider extends ServiceProvider
{
    protected $rootPath;

    /**
    * Register any application services.
    *
    * @return void
    */
    public function register()
    {
        $this->rootPath = realpath(__DIR__.'/../');
    }

    public function boot()
    {
        $this->loadCommands();
    }

    private function loadCommands()
    {
        $this->commands([
            AppDbBackupCommand::class
        ]);
    }
}