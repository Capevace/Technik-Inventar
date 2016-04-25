# Technik Inventar

Das Inventursystem basiert auf dem PHP Framework Laravel 5.

## Installation

Setup database in the `.env`

For production:
```
APP_DEBUG=false
APP_URL=<SITE_URL>

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=<DB_NAME>
DB_USERNAME=<DB_USERNAME>
DB_PASSWORD=<DB_PASSWORD>
```

For debug:
```
APP_DEBUG=true
```

Install all dependencies (composer and npm)
```sh
> git clone https://github.com/Capevace/Technik-Inventar.git
> composer install
> npm install
```

Use the Laravel Artisan CLI to migrate the database, generate an encryption key and setup the system.
```sh
> php artisan migrate
> php artisan key:generate
> php artisan inventory:setup {Leiter Account Passwort}
```
## Copyright

© 2015 Lukas von Mateffy
