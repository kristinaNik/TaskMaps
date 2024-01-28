# Project Name

Maps 

## Table of Contents

- [Introduction](#introduction)
    - [Backend](#backend)
    - [Frontend](#frontend)
    - [PHPUnit Testing](#phpunit-testing)
- [Usage](#usage)
  - [PHP/DI Container](#phpdi-container)
- [Installation](#installation)

## Introduction

This project is a custom implementation without relying on any specific PHP framework. It employs a custom logic for both the backend and frontend components.

### Backend

The backend is responsible for building the PHP Dependency Injection (DI) container and registering the dependencies of various classes. It follows a custom logic to manage dependencies, ensuring a modular and maintainable codebase. Additionally, the backend makes requests to the OpenStreetMap (OSM) and Google Maps APIs to retrieve coordinates based on the provided address.

### Frontend

On the frontend, a simple form is provided with one input field that requires users to enter an address. After submitting the form, the application displays an OpenStreetMap (OSM) map with the location corresponding to the provided address.
- For the generation of the map , I have used jQuery script
  The jQuery script responsible for handling the form submission and generating the map:


### PHPUnit Testing

The project includes PHPUnit tests for various services.

### PHP/DI Container

Inside the closure, two geocoding provider instances are resolved from the container:
- $osmProvider is an instance of the OSMGeocodingProvider class.
- $googleMapsProvider is an instance of the GoogleMapsProvider class.

```bash
	$container->set(GeocodingService::class, function () use ($container) {
		$osmProvider = $container->get(OSMGeocodingProvider::class);
		$googleMapsProvider = $container->get(GoogleMapsProvider::class);

		// Choose to work with which provider
		return GeocodingServiceFactory::create($osmProvider);
	});
```

The key part is the decision-making process to choose which provider to work with:
 - The GeocodingServiceFactory::create($osmProvider) line indicates that the GeocodingServiceFactory::create method is invoked with the $osmProvider as an argument.
 - The factory method (create) is responsible for deciding and creating an instance of GeocodingService based on the provided provider (in this case, the OSM provider).

## Installation

```bash
composer install
vendor/bin/phpunit
```

## Stack ##
- PHP version 8 and above
- jQuery
- HTML


