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
 - Run database migrations with to create tables and demo data `php artisan migrate:fresh --seed`
 - Start local development server with `php artisan serve`

### Using Voyager admin interface
- Navigate to the application's admin interface (example: http://localhost:8000/admin)
- Use following credentials to log in:
     
        Username:   admin@yolo.at
        Password:   123
