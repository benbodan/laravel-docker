## Scaffolding

|             | Paths                               | 
|-------------|-------------------------------------|
| Routes      | src/app/Http/Clients/Routes/web.php |
| Controllers | src/app/Http/Clients/Controllers    | 
| Tests       | src/app/Http/Clients/Tests          |

## Commands

|                    Commands         | 
|-----------------------------|
| php artisan export:payments |

## Installation

```sh
# clone the repo
git clone https://github.com/benbodan/laravel-docker
cd laravel-docker

# create the env variables for the containers
cp .env .env.example

# start containers
docker-compose up -d

# when the containers are up open a terminal in app container
docker-compose exec app sh

# copy the env variables required by laravel 
cp .env .env.example

# install composer packages
composer install

# Generate the required keys for laravel
php artisan key:generate 

# run the migrations and seeders
php artisan migrate
php artisan db:seed 

# run the tests 
php artisan test
```