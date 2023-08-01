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

### Accessors, Mutators, Relationships & Casting

* Accessors is used to access the already set data in modified way;
    * A string in DB - `"HELLO WORLD"` -> *while accessing this we want lowercase value* so, we will define accessors which will convert and return the `lowercase` value -> `"hello world"`.

* Mutators is used to set the data attribute before updating the value to database;
    * A String from a form input to be updated in a `uppercase` into DB -> *If we define mutator to update the particular string value to be updated only in uppercase it will be triggered and modify the value to uppercase* -> And then Updates the value into DB.

* We use the `hasMany()` and `belongsTo()` methods, to define one to many relationship.

* BelongsToMany() is used to defone many to many relationships. We use `attach(), detach(), toggle(), and sync()` to associate relations.

* Accessors and mutators transform values when we retrieve/set model attributes.

### Seeding Relationships

* Laravel offers us factory helper functions like `has()` and `for()` to quickly generates relations for models.

* We can use the `sync()` method to generate many to many relation records.

### RESTful Laravel Routes

* API Routes typically refers to routes that return `JSON`, while web routes are routes that return `HTML` pages.

* Types of Request `GET`, `POST`, `PATCH or PUT`, `DELETE` type request.

* We define API routes in the `routes/api.php`, and web routes in `routes/web.php`.

* Laravel uses the `substitue bindings middleware` to automatically load model instance to the controller.

### API Resources Controllers

* Controller is a function that runs when a `HTTP` request hits a route.

* We can delegate our route controllers into a dedicated Laravel Controller class.

* There a 5 main methods in a controller class:
    * `Index` - displays a list of resources.
    * `Store` - creates a new resource.
    * `Show` - displays a specific resource.
    * `Update` - updates a specific resource.
    * `Destroy` - deletes a specific resource.

* The `resource` route helper method enables us to easily define API routes.

### Best Practices for Controllers

* Route group can help us to effectively organize our `API` Routes.
* We can either use the array syntax or the method syntax to define a route group.
* We can add URL prefix, route name prefix, namespace and middleware to a route group.
* The `where()` method is useful to add matching constraint to URL parameters.

### Automagically Load Files Recursively

* Iterator is an object that allows us to iterate through a series of time.
* The directory iterator can help us to automatically load our routes in a folder.

### Essential Eloquent 101

* Laravel's ORM - Eloquent provides an easy API for us to work with database.
* We use to `query()` method to start a database query,
    - `get()` to retrieve records,
    - `find()` to find by id,
    - `create()` to create a new record,
    - `update()` to update a record,
    - `delete()` to delete a record

* Laravel protects the model fields from mass assignment by default. To enable mass assignment, we need to define the `protected $fillable = []` property in the model.

* `$hidden` will hide the model fields when we convert the model into an array, and `$append` will add extra fields to the array.

### Database Transactions

* Database Transactions groups multiple database operations together and only applies the operations when all of them passed. It will rollback any changes if one of the operations failed.

* We use the `transaction()` method in the DB facade to trigger a transaction.

### Robust API Responses

* Resource Class helps us to manage our `API JSON` response in one place.
* It makes our API response to be more confident and maintainable.
* We can use the `php artisan make:resource [fileName]` command to generate the resource boilerplate.

### Paginated API Resources

* Pagination is the notion of displaying  our query results by page, otherwise we would have to send everything to the client.
* We call the paginate() method on our query to create a paginator. We can then pass the paginator to our resource collection for a paginated `JSON` response.

### The Repository Pattern

* Repository is a class that takes care of model operations.

* Repository manages model operations in one place, and improves the maintainability of our app.

### Exception Class & Error Handling

* Creating custom exception classes in our app can ensure consistent API responses for error handling.

* The `report()` method is responsible for reporting or logging the exception.

* The `report()` helper function calls the report method in the specified exception class.

* The `render()` method is responsible for send the error back to the HTTP Client.

* The `abort()` helper function is a quick way to send back and error ressponse.

### Using Event in a API Server

* `Event Listeners` are classes / functions that get executed when an event is dispatched.

* We define our Event - Event listener mapping in the `Event Service Provider`.

* `Event Subscriber` is a class, that let us to group our event - listener mappings in one place.

* We register Subscriber in the `protected $subscribe = [];` property in the Event Service Provider.

### Building & Sending Emails

* `Laravel Mail` class offers us an easy way to define and send out application emails.

* `Mailtrap.io` is a fake SMTP testing Service that allows us to test email in our local env. `Personal preference is mailhog`.

* Laravel allows us to write our mail template in `markdown` syntax.

* We can use the `Mail` facade to send out emails.

## Unit Test vs Feature Test vs E2E (End 2 End) 

* Laravel Uses `PHPUnit` as its official testing library.

* Unit Testing is the notion of testing the smallest unit/building blocks in out app i.e. functions. If the building blocks are working, then the app should work. (this is not necessarily true)

* Feature Testing focuses on the feature and outcome rather than the individual fucntions. It is more reliable than Unit testing but slower.

* End-to-End testing mocks the end users' behaviour and has the highest reliability. However, E2E is very hard to implement and very slow.

* For Creating some Tests
    * Feature: `php artisan make:test [Test_Name]`
    * Unit: `php artisan make:test [Test_Name] --unit`

* A Function without a test suffix `test_[function_name]` will be treated as a regular php function. So, test_ suffix is inportant. Or use 

```php
/*
* @test
* Test Anotation at the beginning of the functon
*/
```

### Unit Testing Essentials

* Unit Testing is Used for testing functions.

* Laravel provides a `TestCase` class which is basically an enhanced version of the one provided by PHPUnit. Laravel's TestCase loads a lot of helper methods for us to use.

* We should write tests on both 'Happy Path' and 'Sad Path' for our functions.

### Feature Testing Essentials

* Testing a Group of Functions.

* Providing the `-filter` flag to PHPUnit allows us to run a specific test.
* `Event::fake()` stops events from dispatching in out app and allows us to capture and assert event dispatching.
* The `json()` method allows us to easily perform HTTP requests to our API endpoints.

### PHPUnit Live Reload Tests

* `PHPUnit Watcher` is a wonderful package by 'Spatie' that automagically rerun our tests whenever there is a change in our source code.

> composer require spatie/phpunit-watcher --dev

* It is a great tool that will save us lots of time and make us happier in the long run.

### Power Up with Composer Script

* Composer scripts are handy shorthand that allows us to define and run complex commands.

* If we want to pass arguments to our scripts, we need to supply an additional `'--'` after the script name.

### Test Driven Development - TDD Intro

* TDD is the idea of writing test first and write the code later.
* In standard TDD, we would write the bare minimum code to pass our test and refactor our code as we progress to the more advanced tests.

### Validating HTTP Requests

* We can define Request class to easily validate incoming HTTP requests.

* We inject Request class in controller methods to get Laravel to perfom validation on the incoming requests.

* We can create custom validation rule either by closure or a dedicated rule class.

### Custom Validation with Validator

* Validator is an alternative way to validate input data other than using the Request class.

* Validator has the benefit of providing us a lot of helper functions to work with validation.

### Config & ENV Variables

* `config()` is a handy helper function to access configuration values from the cofig folder.

* We use the `dot notation` to access the configuration.

* `env()` is a helper function to access environmental variables.

### Generating API Docs with Scribe

* Recommended Package: [Scribe](https://scribe.knuckles.wtf/laravel)
* Scrive is an amazing package that helps us to generate API documentation in a beautiful webpage.
* We use the `@` directive in PHPDocs to provide details about our API endpoints.

### Throttle & Rate Limiting

* Throttle means to limit the number of operations in a given period of time.

* The throttle middleware in Laravel helps to mitigate Denial-of-Service (DoS) attacks from malicious user.

* We can define named Rate Limiter in Route Service Provider.
* We can pass in the rate limiting config directly to the throttle middleware if we prefer not to use the named Rate Limiter.

* KeyNote: For Imrpovements, we can use `ThrottleRequestsWithRedis` instead of default `Throttle` middleware. Change the Cache Driver to `Redis`

## Fortify & Authentication Introduction

* Laravel Fortify is a package that takes care of most authentication logic for us out of the box.

* Fortify provides us several features out of the box:
    - Registration
    - Login
    - Reset Password
    - Email Verification
    - Update Profile Information
    - Update Password
    - Two Factor Authentication (2FA)

### Fortify: Authentication Registration & Password Reset

* Laravel protects all its web routes from CSRF attacks by default.
* We need `Laravel Sanctum` if we want to protect our API routes from CSRF attacks.
* We can use `Fortify Action` classes to customize the user registration logic along with other actions.
* Password Reset requires a GET route with a route name of `password.reset` in order to work properly.

### Fortify: Email Verification & Update User Profile

* Fortify provides us a handy email verification feature to confirm the user's email address.

* We can use the `verify` middleware to protect our app's routes.

* We will need to implement the `MustVerifyEmail` interface to our user model for email verification to work.

### Fortify: 2FA

* The User model needs to use the `TwoFactorAuthenticatable` trait in order to 2FA to work properly.
* The confirmPassword option will force the user to confirm their password when setting up 2FA.
* Laravel will issue the user a new set of recovery codes if they log in via recovery code.

### Fortify: Custom Email Verification

* Laravel Fortify relies on the built-in `VerifyEmail` class provided by Laravel to send out verification email.

* We call `VerifyEmail::toMailUsing()` to define our own logic to send out the verification notification.

* We can encode information into Laravel's signed route for validation in the future.

### Custom Authentication Logic

* We use `Fortify::authenticateUsing()` to override the default authentication logic

* `Fortify::authenticateThrough()` allows us to customise the authentication pipeline.

* `Fortify::confirmPasswordUsing()` provides a way to customize the password confirmation logic.

## Laravel Sanctum (Learn More)

* Sanctum offers cookie-based authentication and token-based authentication.

* Token is simple to setup and use but can be dangerous if it is stolen.

* Cookie is harder to setup, but it will protect our app from `CSRF` and `XSS` attacks.

* Cookie based authentication is sensitive to domain names, be sure to configure Sanctum before use.

### Testing Authentication

* Laravel provides us a convenient `actingAs()` method to login as any given user.

* `setUp()` is a handy special function that runs before every test function.

* `teardown()` is the opposite of `setup()`. It runs after every test function.

* `actingAs()` accepts a second argument where we can specify which auth guard that we want to use.

### How to Translate: Multilingual Apps

* Internationalisation or `i18n` is the notion of providing translation to different locale.

* By default, `lang` won't be there. We need to run the `php artisan lang:publish` command to publish language files.

* We can use the `__()` or `Lang::get()` to retrieve translations from the language files.

* Laravel puts all the translations files in `lang` folder.
    - In Version 8 > `resources/lang` directory.
    - In Version 9 or later > `./lang` directory.

* We can choose to write our tanslation files in either php or json file format.

* `trans_choice()` is a helper functions for us to handle pluralization.

### Share Private Links that Expires

* We can use signed routes to protect our routes from unwanted modification.

* We use `URL::temporarySignedRoute()` to create a link with expiration, while `URL::signedRoute()` to create a permanent protected link.

* Laravel uses salted `sha256` to has the route as a measure to prevent modifications.

### Notifications - All you need to Know.

* Laravel Provides us a variety of drivers to send our notifications to our users, including mail, database, broadcast, slack and vonage.

* There are many more community-maintained drivers, e.g. telegram, discord etc.

* `php artisan make:notification` will generate the boilerplate to create a new notification class.

* We can use `Notification::send()` or `$notifiable->notify()` to send out notifications.