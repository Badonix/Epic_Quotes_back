<div style="display:flex; align-items: center">
  <h1 style="position:relative; top: -6px">Movie Quotes App</h1>
</div>

---

This **Epic Movie Quotes** backend API is for social media app about movies and its quotes. This app allows users to post movies and quotes, like or comment each others quotes and send notifications.

#

### Table of Contents

- [Prerequisites](#prerequisites)
- [Tech Stack](#tech-stack)
- [Getting Started](#getting-started)
- [Migrations](#migration)
- [Development](#development)
- [Resources](#resources)

#

### Prerequisites

- <img src="readme/assets/php.svg" width="35" style="position: relative; top: 4px" /> *PHP@7.2 and up*
- <img src="readme/assets/mysql.png" width="35" style="position: relative; top: 4px" /> _MYSQL@8 and up_
- <img src="readme/assets/npm.png" width="35" style="position: relative; top: 4px" /> _npm@6 and up_
- <img src="readme/assets/composer.png" width="35" style="position: relative; top: 6px" /> _composer@2 and up_

#

### Tech Stack

- <img src="readme/assets/laravel.png" height="18" style="position: relative; top: 4px" /> [Laravel@10.x](https://laravel.com/docs/10.x) - back-end framework

#

### Getting Started

1\. First of all you need to clone Epic Movie Quotes API repository from github:

```sh
git clone https://github.com/RedberryInternshipnikoloz-danelia-epic-movie-quotes-back
```

2\. Next step requires you to run _composer install_ in order to install all the dependencies.

```sh
composer install
```

3\. after you have installed all the PHP dependencies, it's time to install all the JS dependencies:

```sh
npm install
```

and also:

```sh
npm run dev
```

in order to build your JS/SaaS resources.

4\. Now we need to set our env file. Go to the root of your project and execute this command.

```sh
cp .env.example .env
```

And now you should provide **.env** file all the necessary environment variables:

#

**MYSQL:**

> DB_CONNECTION=mysql

> DB_HOST=127.0.0.1

> DB_PORT=3306

> DB_DATABASE=**\***

> DB_USERNAME=**\***

> DB_PASSWORD=**\***

**DOMAINS:**

> SANCTUM_STATEFUL_DOMAINS=localhost:3000

> SPA_DOMAIN=http://localhost:3000

> SESSION_DOMAIN=localhost

**GOOGLE:**

> GOOGLE_CLIENT_SECRET=null

> GOOGLE_CLIENT_ID=null

> GOOGLE_CALLBACK_REDIRECT=null

**MAIL**

> MAIL_DRIVER=smtp

> MAIL_HOST=smtp.gmail.com

> MAIL_PORT=465

> MAIL_USERNAME=hello@example.com

> MAIL_PASSWORD=null

> MAIL_ENCRYPTION=ssl

> MAIL_FROM_NAME="${APP_NAME}"

**PUSHER**

> PUSHER_APP_ID=

> PUSHER_APP_KEY=

> PUSHER_APP_SECRET=

> PUSHER_HOST=

> PUSHER_PORT=

> PUSHER_SCHEME=https

> PUSHER_APP_CLUSTER=

#

after setting up **.env** file, execute:

```sh
php artisan config:cache
```

in order to cache environment variables.

5\. Now execute in the root of you project following:

```sh
php artisan key:generate
```

##### Now, you should be good to go!

#

### Migration

if you've completed getting started section, then migrating database if fairly simple process, just execute:

```sh
php artisan migrate
```

#

### Development

You can run Laravel's built-in development server by executing:

```sh
php artisan serve
```

Build js files:

```sh
npm run dev
```

it will watch JS files and on change it'll rebuild them, so you don't have to manually build them.

#

### Resources

Structure of database:

<img src="/readme/assets/drawSQL.png" style="position:absolute; top:10px" height="250"/>

#
