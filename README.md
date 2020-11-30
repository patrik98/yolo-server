## Local Development
 
#### Prerequisites
 
 - Add `.env` file in the root directory
 
        APP_NAME=Laravel
        APP_ENV=local
        APP_KEY=base64:NRIPwSjgIE68JTNyGv7aNoewTSkzuuHC76YCzyYXQiI=
        APP_DEBUG=true
        APP_URL=http://localhost:8000
        LOG_CHANNEL=stack
        LOG_LEVEL=debug
        DB_CONNECTION=sqlite
  
 - Install all composer dependencies `composer install`
 - Add an empty file named `database.sqlite`  inside the folder `database`

### Voyager admin interface

#### Installation

- Enable extensions in php.ini
 
        extension=fileinfo
        extension=gd2
        extension=mbstring
        extension=exif      ; Must be after mbstring as it depends on it
        extension=openssl
        extension=pdo_sqlite
- Publish the assets that come with Voyager.

        php artisan vendor:publish --provider="Intervention\Image\ImageServiceProviderLaravelRecent"

- Run database migrations to create necessary tables and demo data: 
        
        php artisan migrate:fresh --seed
 
- To install hooks and create storage symlink to public folder:

        php artisan hook:setup
        php artisan storage:link

- Start local development server with `php artisan serve`
 
#### Using the admin interface

- Navigate to the application's admin interface (example: http://localhost:8000/admin)
- Use following credentials to log in:
     
        Username:   admin@yolo.at
        Password:   123
        
Additional note for development:
    When re-configuring Voyager, it is recommended to clear the Configuration cache before starting the local server:
    
        php artisan config:clear
