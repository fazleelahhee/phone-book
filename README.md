# RESTful API for a phone book application

Purpose of this plugin is to enable hackajob to evaluate my PHP programming skills & Coding standards.

## Task description

Your task is to build a RESTful API for a phone book application. Your APIs need to support an authentication method in order to secure your requests.

Requirements

mandatory endpoints: create, read, update, delete (feel free to extend these endpoints)
use an authentication method to secure your requests (Examples: JWT token, oAuth, etc.)
use a way to make your data persistent (database is preferred)
write at least one unit test and a functional test
We strongly recommend you use frameworks to solve the challenge if you added frameworks to your hackajob profile. Try to use good practices for the application's architecture. Extra points are given for correct use of design patterns and programming principles.

Please describe in a README.md file how the application works and write any other additional info needed about your endpoints.


## Installation

### Minimum requirements
* PHP version version >= 7.3.0
* Composer installed

Clone from the repository

```
    $mkdir phone-book-application
    $cd phone-book-application
    $git clone https://github.com/fazleelahhee/phone-book.git .
    $composer update
```

Once composer updated. need to update **.env** with database connections details.

**file: .env**
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE= < add database name >
DB_USERNAME= < add database user name >
DB_PASSWORD= < add databse password >
```

Once database .env file has been updated. Now we need to run database migrate. To run database migration command you have to sure - you are inside the 'phone-book-application' folder.

```
$php artisan key:generate
$php artisan migrate
```

Once database migration is done, then we need to install personal access for the accessing the api.

```
$php artsan passport:install
```

**All done**

## Api documentation
Its should be available in:  **http://<your host url>/docs/**


## Unit Test

```
$composer test
```