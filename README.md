## Juice Box Code Test

This is a coding test for juice box that follows the outline laid out in the provided PDF

The whole project is hoisted via Laravel Sail

To run the project on a windows machine (what it was developed on) you will need WSL 2 and Docker desktop installed.

The steps I used to run the project are listed below

1. Download the repo
2. Navigate to the folder with powershell
3. run composer install
4. Enter WSL
5. run the command ./vendor/bin/sail up -d
6. run the command ./vendor/bin/sail artisan migrate

To Seed the DB run the command ./vendor/bin/sail artisan db:seed

To run the dispatcher for the welcome email run the command ./vendor/bin/sail artisan dispatch:test-job {id}
NOTE: you will need to make the env variable are set up to actually set an email. I used mailtrap to test this

To use the weather endpoint you will need to acquire an api key and also add that to the env file.
I used OpenWeatherMap, so may env vars ended up looking like this

WEATHER_API_KEY={my_key}
WEATHER_API_URL="https://api.openweathermap.org/data/2.5/weather"

To run the test case just run ./vendor/bin/sail artisan test

Originally I had planned for swagger but there is currently a known version conflict with the latest version of laravel in regards to zircote/swagger-php
So instead I have included a postman collection

Please let me know if there are any issues
