# Explorer demo app: cartographers

## Installation

- Fork or clone the repository
- `composer install`.
- `cp .env.example .env`
- The app is prepared to work with Laravel Sail: `vendor/bin/sail build && vendor/bin/sail up -d`
- `vendor/bin/sail artisan key:generate`
- `vendor/bin/sail artisan scout:index cartographers`
- `vendor/bin/sail artisan migrate:fresh --seed`
- `vendor/bin/sail artisan scout:import "App\Models\Cartographer"`
- `vendor/bin/sail artisan horizon` but only if you want to use the queueable update alias job, set `QUEUE_CONNECTION=redis` in your .env file.

## Usage
The following URLs should work:
- http://localhost:9000 for the app
- http://localhost:5601 for Kibana (username: elastic, password as set in .env)
- http://localhost:9200 if you want to access Elasticsearch through its API
- http://localhost:9000/horizon if you have Laravel Horizon and Redis running
