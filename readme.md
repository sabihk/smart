Project Setup
-------------
1) Run "composer install" from command line to get vendor folder.

2) Run "php artisan key:generate" to set application key.

3) Provide write mode for "storage" folder.

4) Create a database & provide credentials in ".env" file. (Change .env.example to .env)

5) Run "php artisan migrate" from command line.
    This will create users table with all the fields needed for this application.

Application Architecture
------------------------
1) There are 2 user types:

    i)  User
    ii) Admin

2) Any user can register in this application and will be provided 'User' role.
    User will be displayed only "You are logged in!" message in home page.

3) For the first user to provide admin role manually change
    'role' field (datatype enum) in "users" table from '0' to '1'.

    This will provide the user an Admin role and now Home page will display all the existing users
    with the following functionality:
    User Role   -> This dropdown will change user status
    Edit        -> On click of this button, a modal with user details will be displayed.
    Delete      -> This will soft delete the user.

Project Architecture/Design
---------------------------
1) database/migrations/2014_10_12_000000_create_users_table.php -> This file is having "users" table schema to create in database.

2) Laravel provides user login & register authentication.
    Modified the following files as per the requirement of this application:

    i) resources/views/auth/register.blade.php      -> User registration page view file.
    ii) public/css/smart.css                        -> All the stylings for this application are added in this file.
    iii) public/scripts/smart.js                    -> All the jQuery codes for this application are added in this file.
    iv) app/Http/Controllers/Auth/AuthController.php-> This file is having server side validaiton for user registration & creates user after validation.
    v) resources/views/home.blade.php               -> This is the view file of home page.
    vi) resources/views/editUserDetails.blade.php   -> This is the view file for user details edit in modal.
    vi) app/Http/Controllers/HomeController.php     -> All the logics of this applicaiton are written in this controller.
    vii) app/User.php                               -> All the business logic of this application are written in this model.

3) Plugins used:

    i)  public/plugins/datatables   -> Datatables plugin is used to display user details.
    ii) public/plugins/datepicker   -> Bootstrap datepicker plugin is user for birthday selection.

References
----------
Regular expression for email & phone are taken from web.

API
---
This is not implemented.