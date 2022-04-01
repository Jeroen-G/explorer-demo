# Explorer demo app: cartographers

## Installation

- Fork or clone the repository
- `composer install`.
- The app is prepared to work with Laravel Sail: `vendor/bin/sail up -d`
- `vendor/bin/sail artisan scout:index cartographers`
- `vendor/bin/sail artisan migrate:fresh --seed`
- `vendor/bin/sail artisan scout:import "App\Models\Cartographer"`

## Usage
The following URLs should work:
- http://localhost:9000 for the app
- http://localhost:5601 for Kibana
- http://localhost:9200 if you want to access Elasticsearch through its API
