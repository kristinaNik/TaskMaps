# Project Name

Maps provider project

## Table of Contents

- [Introduction](#introduction)
    - [Backend](#backend)
    - [Frontend](#frontend)
    - [PHPUnit Testing](#phpunit-testing)
    - [PHP CS Fixer](#php-cs-fixer-)
- [Setup](#installation)

## Introduction

The project 
- is a custom implementation without relying on any specific PHP framework. It employs a custom logic for both the backend and frontend components.
- utilizes [Guzzle](https://docs.guzzlephp.org/) to make HTTP requests to external APIs. 
- follows a coding style standard, and use [PHP CS Fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer) to ensure code consistency.

### Backend

The backend is responsible for building the PHP Dependency Injection (DI) container and registering the dependencies of various classes. It follows a custom logic to manage dependencies, ensuring a modular and maintainable codebase. Additionally, the backend makes requests to the OpenStreetMap (OSM) and Google Maps APIs with the help of [Guzzle](https://docs.guzzlephp.org/) to retrieve coordinates based on the provided address.
- In the `build` function of the geocode.php file, the geocoding provider is selected based on the provided argument. The available options are 'osm' and 'google_maps'. If no valid provider is provided, the application will return an error
```php
function build(string $provider)
{
    // ...

    try {
        $chosenProvider = match ($provider) {
            'osm' => $osmProvider,
            'google_maps' => $googleMapsProvider,
            default => $osmProvider
        };
    } catch (\UnhandledMatchError $e) {
        echo json_encode(['error' => "No available provider"]);
        exit;
    }

    return GeocodingServiceFactory::create($chosenProvider);
}
```
and the call 

```php
try {
	$container = build($_ENV['PROVIDER']);
} catch (Exception $e) {
	echo json_encode(['error' => 'Error building the container']);
	exit;
}
```

### Frontend

On the frontend, a simple form is provided with one input field that requires users to enter an address. After submitting the form, the application displays an OpenStreetMap (OSM) map with the location corresponding to the provided address.
- For the generation of the map that is displayed in the view, I have used jQuery script
  The jQuery script responsible for handling the form submission and generating the map:
- The front end is loaded with the `loadView` function, which allows you to dynamically load the view based on the chosen geocoding provider. The geocoding provider is passed as an argument, and the corresponding HTML file is included using a match statement.

```php
try {
	loadView($_ENV['PROVIDER']);
} catch (Exception $e) {
	echo json_encode(['error' => "Couldn't load view"]);
	exit;
}
```

### PHPUnit Testing

The project includes PHPUnit tests for various services. To run all the tests you can use the following command

```bash
vendor/bin/phpunit
```

## PHP CS Fixer 
Used to format the code according to the project's coding style
```bash
composer cs-fix
```

## Setup
1) Install composer dependencies
```bash
composer install
```
2) Copy .env.local and create a .env file and choose a map provider
- Available map providers for env variable `PROVIDER`:
  * `osm`
  * `google_maps`

## Stack ##
- PHP version 8 and above
- Guzzle Client
- PhpUnit version 9.6
- php-di
- php dotenv
- Java Script/jQuery
- HTML


