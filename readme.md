# laravelAPIServer

### About

This is a demo laravel API server with Laravel Passport authentication for running a relational CRUD application for the following [VueJS API client application](https://github.com/vurghus-minar/vuejsAPIclient)

### Endpoints Tests using Postman

You can import the relevant endpoints examples using [Postman](https://www.getpostman.com)

The file is located in the root of your application folder

```
laravelAPIserver.postman_collection.json
```

### Set up

#### Requirememts

Please refer to the set up requirements for running Laravel [here](https://laravel.com/docs/5.5/installation)

#### Database

Create a MySQL database and change the following records accordingly in the `.env` file in the root level of your application folder.

```ini
DB_DATABASE=database_name
DB_USERNAME=database_username
DB_PASSWORD=database_password
```

#### Host file configuration on Apache Server

The following is the host file and an example virtualhost set up for apache(XAMPP) on Windows.

```ini
  #notes.local
  127.0.0.1       notes.local
  127.0.0.1       www.notes.local
```

```xml
  <VirtualHost *:80>
      ServerName notes.local
      ServerAlias www.notes.local

      DocumentRoot "path_to_your_webroot\laravelAPIserver\public"


      CustomLog "path_to_your_webroot\laravelAPIserver\storage\logs\notes.local-access.log" common
      ErrorLog  "path_to_your_webroot\laravelAPIserver\storage\logs\notes.local-error.log"
  </VirtualHost>

```

#### Demo data set up

Set up passport data:

```sh
php artisan passport:install

```

Once completed select the copy Client 2 secret from the oauth_clients database table

![copy Client 2 secret](https://github.com/vurghus-minar/laravelAPIServer/raw/master/ss1.png)

Paste the secret key in `.env` file

![paste Client 2 secret](https://github.com/vurghus-minar/laravelAPIServer/raw/master/ss2.png)

Set up dummy Users:

```php
php artisan tinker
factory(App\User::class, 10)->create();
```

Set up dummy Notes:

```php
php artisan tinker
factory(App\Note::class, 50)->create();
```

You have now successfully created the laravel API server. You can access the API using the [VueJS API Client project](https://github.com/vurghus-minar/vuejsAPIclient)

#### Support

If you require any support, please feel free to raise an issue.
