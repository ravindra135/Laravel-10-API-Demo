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

### Unit Test vs Feature Test vs E2E (End 2 End) 

* Unit Testing is the notion of testing the smallest unit/building blocks in out app i.e. functions. If the building blocks are working, then the app should work. (this is not necessarily true)

* Feature Testing focuses on the feature and outcome rather than the individual fucntions. It is more reliable than Unit testing but slower.

* End-to-End testing mocks the end users' behaviour and has the highest reliability. However, E2E is very hard to implement and very slow.

### Unit Testing Essentials