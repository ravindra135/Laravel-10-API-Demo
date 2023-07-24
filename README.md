<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## About This Project

**API Demo** is a open source project to understand the working modules of API Development along with laravel key concepts.

## Key Concepts

### Introduction

* `/public/index.php` is the main entry file or point for a laravel application.
* The **Service Container** is a gaint box that keeps app services together. It allows the app to interact with the services.
* The App Needs to bind a service to the container before resolving it from the container.
* **Singleton** service can only have 1 instance.
* **Kernel** is the core of an app that does all of the heavy work for us.

### Middleware

* Middleware are functions that run before the request hits the router.
* The `handle()` method contains the main logic for the middleware, while the `terminate()` method contains the cleanup logic just before the app is shutdown.
* The kernel is responsible to pass the request to the router through the middleware.
* The kernel bootstrap the application by setting up:
    - Environment variables
    - Configuration
    - Exception Handling
    - Register **Facade** and **Service Provider**

### Service Providers

* Service providers are classes that instruct Laravel on how to instantiate a Service/Class.
* The `register()` method is where define our class binding.
* The `boot()` method is called where after all services are registered.
* We need to put our Service Provider in the `provider` array in the `config/app.php` file to activate the service provider. Otherwise Laravel will automatically resolve the Service on its own using the `Automatic Resolution` feature.

### Facade

* Facade allows us to call Service Provider method statically, providing us a convenient way to call Service Methods.
* *You can think of facade as a static counterpart of a service class.*

### Migrations

* Migration is a concept of version control for database.
* Laravel will run migrations files in **chronological order**, i.e by following the timestamp in the migration file's name.

### Seeding & Factories

* Seeding is referred to populating the database with dummy data.
* Factory classes are used to generate fake models or dummy content.
* We put the main seeding logic in the classes called Seeder.
* We can use the `db:seed` Artisan command to trigger the seeders.