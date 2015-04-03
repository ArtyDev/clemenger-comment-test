#Clemenger Comment Test
======================

A Symfony project created on March 31, 2015, 7:08 pm.

##Installation
####Check your server meets the requirements
```
php app/check.php
```
####Install Composer
```
curl -sS https://getcomposer.org/installer | php
```
####Install the vendors libraries
```
composer.phar install
```
####Update the database
```
php app/console doctrine:schema:update --force
```
####Run the development server
```
php app/console server:start
```
####Enjoy :)