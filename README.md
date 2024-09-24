## Weather App

![cartman](https://upload.wikimedia.org/wikipedia/en/7/77/EricCartman.png "Cartman")

Also, I'm understanding "harmful UV rays" as UV Index 🙃

⌛ Written in 2h...

😶 What not done (yet!):
 - Another notification channel
 - Query optimization
 - Moving to service
 - Several PHPUnit unit tests
 - Frontend...

✅ What done:
 - Support for different Weather providers
 - Pause notifications
 - Notifications for multiple cities
 - Auth (but cmon, it's out of box)
 - Custom threshold values for notifications
 - One-button docker setup (Sail-powered, but personally prefer to build `docker-compose`/`Dockerfile` by myself)

Queries can be optimized. Especially with batching. But API supports `bulk` parameter only in Pro version...

And something else to say...

#### Run:

```shell
cp .env.example .env
composer install
npm i
./vendor/bin/sail up -d
./vendor/bin/sail artisan migrate
./vendor/bin/sail npm run dev
```

`./vendor/bin/sail npm run dev` on my Linux machine fails due to permission bit. If that's the case then use:
```shell
./vendor/bin/sail exec laravel.test npm run dev
```
Where `laravel.test` is the name of the container (`./vendor/bin/sail top` to check it).
