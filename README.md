# Jobs Platform

## Getting started

The quickly way of setting up the project is using [Laravel Sail](https://laravel.com/docs/sail),
for that you'll need [Docker](https://docs.docker.com/get-docker/) 
and [Docker Compose](https://docs.docker.com/compose/) under Linux / macOS (or Windows WSL2).

### Installation

Clone the repository and change directory:

    git clone https://github.com/mbissonho/jobsplatform-laravel
    cd jobsplatform-laravel

Create .env file:

    mv .env.sail .env

Install the dependencies(PHP 8.1 required):

    composer install

Start and access the PHP application:

    ./vendor/bin/sail up -d && ./vendor/bin/sail bash

Migrate the database with seeding(inside container):

    ./artisan migrate --seed

## Usage

The API is available at `http://localhost/api`.

### Run tests

    ./vendor/bin/sail artisan test

Or inside container, run:

    ./artisan test


