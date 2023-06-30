Conexa

This project includes the following features:
-User Authentication using JWT or Auth0
-Data Management
-RESTful API

Endpoints
Here is a description of the API endpoints:

Register user:
-POST /api/register
    Body example:
    {
      "name": "Nahuel Savedra",
      "email": "test@test.com",
      "password": "secretpassword"
    }
-POST /api/login
    Body example:
    {
      "email": "test@test.com",
      "password": "secretpassword"
    }

Next endpoints are also protected with JWT, so you must include an Authorization: Bearer <token> header with your request.

Retrieves a list of resources. Supports limit and offset parameters for pagination.
-GET /api/people 
-GET /api/planets 
-GET /api/vehicles

Retrieves the details of a specific resource.
-GET /api/people/{id} 
-GET /api/planets/{id}
-GET /api/vehicles/{id}

Local Installation
Follow these steps to deploy the project in your local environment:

Clone the repository to your local machine with git clone https://github.com/username/project.git.
Navigate to the project directory with cd project.
Install the project dependencies with composer install.
Copy the example environment file to a new .env file with cp .env.example .env.
Generate a new application key with php artisan key:generate.
Set up your database in the .env file.
Run the database migrations with php artisan migrate.
Run php artisan jwt:secret to set secret key for jwt
Start the local development server with php artisan serve.

You should now be able to access the application at http://localhost:8000.
