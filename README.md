# Laravel Application Backup Using [Spatie Laravel Backup](https://github.com/spatie/laravel-backup) in Google Drive

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
- Next create new Service Provider using following command

``` bash
php artisan make:provider GoogleDriveServiceProvider
```
- Then, inside the boot() method add the Google driver for the Laravel filesystem:
``` bash
// app/Providers/GoogleDriveServiceProvider.php

public function boot()
{
    \Storage::extend('google', function ($app, $config) {
        $client = new \Google_Client();
        $client->setClientId($config['clientId']);
        $client->setClientSecret($config['clientSecret']);
        $client->refreshToken($config['refreshToken']);
        $service = new \Google_Service_Drive($client);
        $adapter = new \Hypweb\Flysystem\GoogleDrive\GoogleDriveAdapter($service, $config['folderId']);

        return new \League\Flysystem\Filesystem($adapter);
    });
}
```

- Afterward, register your GoogleDriveServiceProvider provider inside the config/app.php file.

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