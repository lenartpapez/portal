### About

This was a thesis project made for requirements of the local national institute of public health which my mentor was working with at the time. Stack: Laravel, Vue (admin panel), bootstrap (yuck), MySQL.

## How to

Clone the repo and run ```composer install``` and ```npm install```. Host the app with Laravel Valet and change .env.example to .env with appropriate settings (you will need to establish a local database). Afterwards, run ```php artisan key:generate``` and ```php artisan jwt:secret``` to establish the mandatory app settings. Finally, run ```php artisan migrate:fresh --seed``` to run the migrations with starting seeds.

### Basic auth: 
portal / portal_thesis

### User and admin user: 
admin@portal.si / admin

If you wanna understand more about the app itself and it's main features, let me know.
