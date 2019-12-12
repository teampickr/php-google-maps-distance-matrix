# PHP Google Maps Distance Matrix API

This is a simple package that allows access to the Google Maps Distance Matrix API using a (mostly) fluent API.
There is support for both the Standard License and Premium/Enterprise License types provided by Google.

## Installation

Install the package using composer:

```
$ composer require teampickr/php-google-maps-distance-matrix
```

## Frameworks

At the moment we only have framework compatibility for Laravel. However, we welcome PRs to add further framework
specific behavior as long as it doesn't prevent the package working for others, or pull in dependencies that are
not optional (suggested).

### Laravel

If you are using Laravel then you can use our service provider. If you have Laravel >5.5 then the package
will be auto discovered upon install. Else, add the following to your `config/app.php` file:

```php
<?php

'providers' => [
    ...
    \TeamPickr\DistanceMatrix\Frameworks\Laravel\DistanceMatrixServiceProvider::class,
]
```

#### Facades

Personally, I hate facades. However, I know people like them. If you are using Laravel >5.5 then the facade will
be automatically discovered. Else, you can add it in your `config/app.php` file.

```php
<?php

'aliases' => [
    ...
    'DistanceMatrix' => \TeamPickr\DistanceMatrix\Frameworks\Laravel\DistanceMatrix::class,
]
```
#### Configuration

First, make sure you have copied the configuration file:

```
$ php artisan vendor:publish --tag=config
```

This will make a `config/google.php` file, this is where your API Key / License information is fetched from.
By default we use the `.env` configuration values to get your API key.

If you have a standard api key all you need to add to your `.env` is:

```
GOOGLE_MAPS_KEY=MY-API-KEY
```

If you are a Premium / Enterprise Google Maps user, and use a encryption key and client ID then you should add
the following to your `.env`:

```
GOOGLE_LICENSE_TYPE=premium
GOOGLE_MAPS_CLIENT_ID=MY-CLIENT-ID
GOOGLE_MAPS_ENC_KEY=MY-ENCRYPTION-KEY
```

Please, make sure you don't store your keys in version control!

## Usage

#### License / API Key

Before making requests you need to create your License object. If you are a standard google maps user, then all
you will need is your API key, then you can create your license as follows:

```php
$license = new StandardLicense($apiKey);
```

If you are a Premium / Enterprise google maps user, then you need to create your license as follows:
```php
$license = new PremiumLicense($clientId, $encryptionKey);
```

Then, you can start making your request:

```php
$request = new DistanceMatrix($license);

// or

$request = DistanceMatrix::license($license);
```

#### Basic usage

```php
$response = DistanceMatrix::license($license)
    ->addOrigin('norwich,gb')
    ->addDestination('52.603669, 1.223785')
    ->request();
   
// I want to make the following but of API better,
// as it looks horrible at the moment.
$rows = $response->rows();
$elements = $rows[0]->elements();
$element = $element[0];

$distance = $element->distance();
$distanceText = $element->distanceText();
$duration = $element->duration();
$durationText = $element->durationText();
$durationInTraffic = $element->durationInTraffic();
$durationInTrafficText = $element->durationInTrafficText();

// or

$response->json['destination_addresses'][0];
$response->json['rows'][0]['elements'][0]['distance']['value'];
$response->json['rows'][0]['elements'][0]['duration_in_traffic']['text'];
```
