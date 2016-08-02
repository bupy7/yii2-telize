yii2-telize (DEPRECATED)
========================

**Extension is deprecated. More info [here](http://www.cambus.net/adventures-in-running-a-free-public-api/).**

Wrapper of service offers a REST API allowing to get a visitor IP address and 
to query location information from any IP address. http://www.telize.com/

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist bupy7/yii2-telize "*"
```

or add

```
"bupy7/yii2-telize": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

Add following code to your configuration file of application:

```php
...
'components' => [
    ...
    'geoIp' => [
        'class' => 'bupy7\telize\GeoIp',
        'externalIp' => YII_ENV_DEV,
    ],
    ...
],
...
```

Get information from IP address:

```php
var_dump(Yii::$app->geoIp->info);
// or select address
var_dump(Yii::$app->geoIp->getInfo('255.255.255.255'));
// get ip
var_dump(Yii::$app->geoIp->ip);
```


##License

yii2-widget-cropbox is released under the BSD 3-Clause License.
