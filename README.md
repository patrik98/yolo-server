## Local Development
 
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
 - Run database migrations with `php artisan migrate`
 - Start local development server with `php artisan serve`
