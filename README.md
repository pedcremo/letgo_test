Technical_test with Symfony 2.8.4
=======================================
* Clone this project "git clone https://github.com/pedcremo/letgo_test.git"
* Install dependencies "php composer.phar install"
* Run your application: (READ PREREQUISITES)
    1. Execute the php app/console server:run command.
    2. Browse to the http://localhost:8000/api/twitter/{twitter_profile_user} URL to test the endpoint.

* Test your application:
    1. phpunit is the testing tool. Install it.sudo apt-get install phpunit
    2. To run unit tests simply execute phpunit in the project root

Example. http://localhost:8000/api/twitter/nicklaus_
This api endpoint retrieves the last 10 tweets of a given user as a last parameter. In this case nicklaus_.

For re-checking Symfony requirements executing this command:

   php letgo_technical_test/app/check.php


Symfony bundles used
---------------------
For twitter API connection I have used https://github.com/endroid/EndroidTwitterBundle

$ composer require endroid/twitter-bundle

Under the hood endroid/twitter-bundle uses php5-curl module so install it

sudo apt-get install php5-curl

For memcaching I'am going to use https://github.com/snc/SncRedisBundle bundle.
Acually this bundle integrates Predis and phpredis into your Symfony application.

Add the snc/redis-bundle package to your require section in the composer.json file.
$ composer require snc/redis-bundle 2.x-dev
$ composer require predis/predis ^1.0
READ documentation https://github.com/snc/SncRedisBundle/blob/master/Resources/doc/index.md

We should install and run a redis server on the same server where this example has been deployed
sudo apt-get install redis-server

Check that actually is running "ps -e|grep -i redis"

Prerequisites
-------------
php5-cli
php5-curl
redis-server

apt-get install php5-cli php5-curl redis-server
