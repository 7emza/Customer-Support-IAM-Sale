# Customer Support Web Application
This is a simple customer support web application that allows customers to submit and manage issues. The application has two modules; the customer management module and the admin management module.

## Requirements
php: `"^7.3|^8.0"`

laravel: `"^8.54"`

MySQL or any other compatible database management system

Composer

## How to Run the Project
 **1-Clone the repository :**
 
```
    git clone https://7emza@bitbucket.org/7emza/customer-support-iam.git
```
 
**2-Install dependencies:**
 
```
composer install
```

**3-Create a new database and configure the database connection in the `.env` file.**

**4-Migrate the database tables:**

```
php artisan migrate
```

**5-Seed the database with initial data:**
```
php artisan db:seed
```

**6-Generate a new application key:**
```
php artisan key:generate
```

**7-Start the application:**
 
```
php artisan serve
```

The application should now be running at [http://localhost:8000](https://http://localhost:8000).

## Features
Customers can submit and manage issues through a user interface.
Issues can have different statuses (Submitted, In Progress, Resolved, Closed).
Customers can display issue details.
Customers receive an email when they submit an issue (status submitted).
Customers receive an email notification when an admin changes the status of an issue (Submitted, In Progress, Resolved, Closed).
Admins can manage issues by displaying, editing, and changing the status of issues.
Customers can only change the status of an issue to Closed, which sends an email notification to all admins.

## Architecture
The application is built using Laravel 8.x and follows the Model-View-Controller (MVC) architecture. It consists of two main modules: the customer management module and the admin management module. The customer management module allows customers to submit and manage issues, while the admin management module allows admins to manage issues by displaying, editing, and changing the status of issues.