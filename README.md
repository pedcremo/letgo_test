Letgo_technical_test with Symfony 2.8.4
=======================================
* Clone this project "git clone https://github.com/pedcremo/letgo_test.git"
* Install dependencies "php composer.php install"
* Run your application:
    1. Execute the php app/console server:run command.
    2. Browse to the http://localhost:8000/api/twitter/{twitter_profile_user} URL to test the endpoint.

Example. http://localhost:8000/api/twitter/nicklaus_
This api endpoint retrieves the last 10 tweets of a given user.

For twitter API connection I have used https://github.com/endroid/EndroidTwitterBundle

$ composer require endroid/twitter-bundle

Under the hood endroid/twitter-bundle uses php5-curl module so install it

sudo apt-get install php5-curl

phpunit is the testing tool. Install it.

sudo apt-get install phpunit

To run unit tests simply execute phpunit in the project root

For re-checking Symfony requirements executing this command:

   php letgo_technical_test/app/check.php
