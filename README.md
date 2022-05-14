# Laravel Application Backup in Google Drive

This is a laravel package to backup your application in google drive along with local directory. This package is inspired by [Spatie Laravel Backup](https://github.com/spatie/laravel-backup) and [Flysystem Adapter for Google Drive](https://github.com/nao-pon/flysystem-google-drive)

Install this package using the following command
``` bash
composer require ratulsaqibkhan/laravel-backup-google-drive
```

``` bash
php artisan vendor:publish --provider="Spatie\Backup\BackupServiceProvider"
```
- Next step is to add google and backup in the disk option in the config/backup.php.
``` bash
'disks' => [
    'google',
    'backup',
],
```

- Now set up empty string to the name option in the config/backup.php.
``` bash
/*
* The name of this application. You can use this name to monitor
* the backups.
*/
'name' => '',
```

- Afterward, register GoogleDriveServiceProvider provider inside the config/app.php file.

``` bash
'providers' => [
    Ratulsaqibkhan\LaravelBackupGoogleDrive\Providers\GoogleDriveServiceProvider::class,
]

```

- At this point, we will add the storage disk configuration to config/filesystem.php:
``` bash
return [
  
    // ...
    
    'disks' => [
        
        // ...
        
        'google' => [
            'driver' => 'google',
            'clientId' => env('GOOGLE_DRIVE_CLIENT_ID'),
            'clientSecret' => env('GOOGLE_DRIVE_CLIENT_SECRET'),
            'refreshToken' => env('GOOGLE_DRIVE_REFRESH_TOKEN'),
            'folderId' => env('GOOGLE_DRIVE_FOLDER_ID'),
        ],
        
        'backup' => [
            'driver' => 'local',
            'root' => base_path('backup'),
        ],
        // ...
        
    ],
    
    // ...
];
```
- Now create a folder named "backup" in the application root at which the local backup files could be kept

- Next, we need to update .env file. In this environment file we need to add the following Google credentials with BACKUP_ENABLE:
``` bash
BACKUP_ENABLE = true

GOOGLE_DRIVE_CLIENT_ID=xxx.apps.googleusercontent.com
GOOGLE_DRIVE_CLIENT_SECRET=xxx
GOOGLE_DRIVE_REFRESH_TOKEN=xxx
GOOGLE_DRIVE_FOLDER_ID=null
```

- With the following command the application can be backup:
``` bash
php artisan laravel-app:backup
```
- For more info go to [Spatie Laravel Backup](https://github.com/spatie/laravel-backup) and [Flysystem Adapter for Google Drive](https://github.com/nao-pon/flysystem-google-drive)