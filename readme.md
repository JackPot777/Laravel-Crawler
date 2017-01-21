# Laravel Universal Crawler
> A web html crawler that crawl the data into your database.

## Current Version
v1.0 - 20170121 Alpha Build
Enough for my usage.

## System Requirements
* PHP 7 
* enable pcntl_fork
* Laravel 5.1 LTS

## Installation Guide
    git clone https://github.com/simplylouis/Laravel-Crawler
    cd Laravel-Crawler
    composer install
    php artisan migrate
    php artisan db:seed
    php artisan DaemonDispatcher:Start #background Process

## Default Account
    email:      admin@admin.com
    password:   admin

## Screenshots
![](https://raw.githubusercontent.com/simplylouis/Laravel-Crawler/master/image.gif)

## Credits
* Gentelella - Bootstrap Admin Template by Colorlib

## Contribution
Please fork and submit a pull request :D .

## Copyright and License
Code and documentation copyright by [Owner](http://www.simplylouis.com) , licensed under the [MIT license](http://opensource.org/licenses/MIT)
Free for commercial use and non-commercial use.
