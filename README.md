**Customer Support Web Application
**This is a simple customer support web application that allows customers to submit and manage their issues. It has the following requirements:

The customer must have an interface where he can submit/display issues.
The issues can have different status (Submitted, In Progress, Resolved, Closed).
The customer can display issue details.
When a customer submits an issue (status submitted), he must receive an email.
When an admin changes an issue status, the customer must receive an email notification (Submitted, in progress, resolved, Closed).
The admin must have the full ability to manage the issues (display/show/edit/change status).
The customer can change only the issue status to closed, so in this case, all admins must receive an email notification.
Architecture
This project consists of two modules:

Customer management module
Admin management module
How to Run the Project
To run this project, follow these steps:

Clone the repository to your local machine using git clone.
Install the dependencies using composer install and npm install.
Create a .env file from the .env.example file and update the configuration settings.
Run the database migrations using php artisan migrate.
Seed the database using php artisan db:seed.
Start the application using php artisan serve.
For more information, please refer to the project documentation.

[links here] - add any necessary links here, such as documentation or other resources.

Note: Make sure to have a mail server set up to test the email notifications.