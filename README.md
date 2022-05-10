# Laravel Application Backup in Google Drive

This is a laravel package to backup your application in google drive along with local directory. This package is inspired by [Spatie Laravel Backup](https://github.com/spatie/laravel-backup) and [Flysystem Adapter for Google Drive](https://github.com/nao-pon/flysystem-google-drive)

``` bash
php artisan vendor:publish --provider="Spatie\Backup\BackupServiceProvider"
```
- Next step is to add google in the disk option in the config/backup.php.
``` bash
'disks' => [
    'google',
    'local',
],
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
        
        // ...
        
    ],
    
    // ...
];
```

- Next, we need to update .env file. In this environment file we need to add the following Google credentials with BACKUP_ENABLE and BACKUP_TIME:
``` bash
BACKUP_ENABLE=true
BACKUP_TIME=13:15

GOOGLE_DRIVE_CLIENT_ID=xxx.apps.googleusercontent.com
GOOGLE_DRIVE_CLIENT_SECRET=xxx
GOOGLE_DRIVE_REFRESH_TOKEN=xxx
GOOGLE_DRIVE_FOLDER_ID=null
```