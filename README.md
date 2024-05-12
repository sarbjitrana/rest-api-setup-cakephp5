# CakePHP Application Skeleton

![Build Status](https://github.com/cakephp/app/actions/workflows/ci.yml/badge.svg?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/cakephp/app.svg?style=flat-square)](https://packagist.org/packages/cakephp/app)
[![PHPStan](https://img.shields.io/badge/PHPStan-level%207-brightgreen.svg?style=flat-square)](https://github.com/phpstan/phpstan)

A skeleton for creating applications with [CakePHP](https://cakephp.org) 5.x.

The framework source code can be found here: [cakephp/cakephp](https://github.com/cakephp/cakephp).

## Installation

1. Download [Composer](https://getcomposer.org/doc/00-intro.md) or update `composer self-update`.
2. Run `php composer.phar create-project --prefer-dist cakephp/app [app_name]`.

If Composer is installed globally, run

```bash
composer create-project --prefer-dist cakephp/app
```

In case you want to use a custom app dir name (e.g. `/myapp/`):

```bash
composer create-project --prefer-dist cakephp/app myapp
```

You can now either use your machine's webserver to view the default home page, or start
up the built-in webserver with:

```bash
bin/cake server -p 8765
```

Then visit `http://localhost:8765` to see the welcome page.


1. **Rest APIs setup CakePHP**: To set up CakePHP for creating these APIs, you'll need to follow these steps:


2. **Database Configuration**: Configure your database settings in `config/app.php`. You'll find the database configuration array in this file. Set your database connection details there.

3. **Generate the User Model**: You can use the CakePHP console to generate the User model. Run the following command in your terminal:

```bash
bin/cake bake model Users
```

This command will generate the User model based on the table named `users` in your database.

4. **Create the UsersController**: Create a new controller named `UsersController` using the CakePHP console:

```bash
bin/cake bake controller Users
```

This will create a UsersController with basic CRUD actions.

5. **Implement the API Endpoints**: Use the code provided in my previous message to implement the API endpoints in the UsersController.

6. **Setup Routes**: Configure the routes for your API endpoints in `config/routes.php`. You can use CakePHP's routing system to map URLs to controller actions.

For example:

```php
// config/routes.php

use Cake\Routing\Route\DashedRoute;

Router::defaultRouteClass(DashedRoute::class);

Router::scope('/', function ($routes) {
    $routes->setExtensions(['json']); // Enable JSON response
    $routes->resources('Users', [
        'map' => [
            'signup' => [
                'action' => 'signup',
                'method' => 'POST'
            ],
            'login' => [
                'action' => 'login',
                'method' => 'POST'
            ],
            'logout' => [
                'action' => 'logout',
                'method' => 'POST'
            ],
            'resetPassword' => [
                'action' => 'resetPassword',
                'method' => 'POST'
            ],
            'refreshToken' => [
                'action' => 'refreshToken',
                'method' => 'POST'
            ]
        ]
    ]);
});
```

7. **To test your signup API endpoint in Postman, follow these steps:**


 **Set Request Details**:
   - Choose the HTTP method as `POST`.
   - Enter the URL for your signup API endpoint. For example, if your API endpoint is `http://localhost:8765/users/signup`, enter this URL in the request URL field.

**Set Headers (Optional)**: If your API requires specific headers, such as `Content-Type`, `Accept`, or custom headers, add them to the request headers section. For example, you might need to set `Content-Type: application/json` if your API expects JSON data.

**Set Request Body**: Depending on how your signup API endpoint is designed, you'll need to provide data in the request body. This typically includes information such as username, email, password, etc. If your API expects JSON data, select the "raw" option in the request body and enter the JSON data accordingly. For example:

   ```json
   {
       "username": "example",
       "email": "example@example.com",
       "password": "password123"
   }
   ```

**Send Request**: Once you've set up the request details and included the necessary data, click on the "Send" button to send the request to your API endpoint.


