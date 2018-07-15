# Install

You will need:
* Laravel - https://laravel.com/docs/5.6
* Homestead - https://laravel.com/docs/5.6/homestead

## GIT
Download / clone from here

## DB
```
CREATE DATABASE `videos`
  DEFAULT CHARACTER SET = `utf8`
  DEFAULT COLLATE = `utf8_unicode_ci`;
```
## Config
Create .env file with the following contents:
```
APP_ENV="local"
APP_KEY="base64:OFrRvej2o7J0ub8nbWIljxb9Z5oysHQi+6OtmhPkfGc="
APP_DEBUG="1"

DB_PASSWORD="secret"

BROADCAST_DRIVER="log"

MAIL_HOST="smtp.mailtrap.io"
MAIL_PORT="2525"
MAIL_USERNAME=""
MAIL_PASSWORD=""

PUSHER_APP_ID=""
PUSHER_APP_KEY=""
PUSHER_APP_SECRET=""
PUSHER_APP_CLUSTER="mt1"

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
```

## Inside Homestead
* `php artisan migrate:refresh --seed`
* `composer install`
* `npm install`
* `npm run watch-poll`

## Tests
* `phpunit` - tests auth, file upload, and delete
