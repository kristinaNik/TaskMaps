# Project Name

Maps 

## Table of Contents

- [Introduction](#introduction)
    - [Backend](#backend)
    - [Frontend](#frontend)
    - [PHPUnit Testing](#phpunit-testing)
- [Features](#features)
- [Installation](#installation)

## Introduction

This project is a custom implementation without relying on any specific PHP framework. It employs a custom logic for both the backend and frontend components.

### Backend

The backend is responsible for building the PHP Dependency Injection (DI) container and registering the dependencies of various classes. It follows a custom logic to manage dependencies, ensuring a modular and maintainable codebase. Additionally, the backend makes requests to the OpenStreetMap (OSM) and Google Maps APIs to retrieve coordinates based on the provided address.

### Frontend

On the frontend, a simple form is provided with one input field that requires users to enter an address. After submitting the form, the application displays an OpenStreetMap (OSM) map with the location corresponding to the provided address.

### PHPUnit Testing

The project includes PHPUnit tests for various services.


## Installation

```bash
composer install
vendor/bin/phpunit

