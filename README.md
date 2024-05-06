# UWEFlix

## About The Project

UWEFlix is a cinema ticket booking and reservation system developed using Laravel. It has features like user roles, authentication, automated reservations, and much more.

## Code Overview 

-   Routing basics
-   MVC architecture
-   Blade templating language
-   Middlewares
-   Authentication and authorization basics
-   Relational databases (MySQL)
-   Database migrations
-   Eloquent ORM
-   Database CRUD operations
-   HTML, CSS, JS
-   Alpine.js
-   File uploads
-   Searching and filtering through models

> Note: The website resets automatically every 30 minutes.

### System Credentials

| User Role               | Email                           | Username      | Password        |
| ------------------ | ------------------------------- | ------------- | --------------- |
| SystemAdmin        | systemadmin&#64;uweflix&#46;com | systemAdmin   | adminpass       |
| CinemaManager      | cm-manager&#64;uweflix&#46;com  | cinemaManager | cm_managerpass  |
| Customer           | customer&#64;uweflix&#46;com    | customer      | customerpass    |
| ClubRepresentative | clubRep&#64;uweflix&#46;com     | clubRep       | clubpass        |

<br>

---

<br>

## Installation Instructions

> Note: As this is a college group project and not a production ready application, the .env file is already configured and included in the repository.

<br>

1. Clone the repository by running the following command in your terminal or command prompt:
    ```bash
    git clone https://github.com/naaih/UWEFlix.git
    ```
2. Change into the project directory:
    ```bash
    cd UWEFlix
    ```
3. Install the project dependencies using Composer. Ensure you have Composer installed on your machine. Run the following command:
    ```bash
    composer install
    ```
   If composer installation fails, Run the following command:
    ```bash
    composer update
    ```
4. Generate an application key:
    ```bash
    php artisan key:generate
    ```
5. Configure the .env file and set the necessary configuration options, such as database credentials and application-specific settings.
6. Run the database migrations to create the required tables:
    ```bash
    php artisan migrate
    ```
7. Optionally, seed the database with 20 movies, shows, users, and categories:
    ```bash
    php artisan db:seed
    ```
8. Create a symbolic link from public/storage to storage/app/public by:
    ```bash
    php artisan storage:link
    ```
9. Finally, you can start the local development server:
    ```bash
    php artisan serve
    ```
    The application will be now accessible at: http://localhost:8000
   
<br>

## User Roles

<br>

**Administrator:**

-   Manages users' creation and website authorities
-   Accepts requests from managers to become managers
-   Can delete existing users

**Manager:**

-   Responsible for managing, creating, and modifying movie details
-   Responsible for managing, creating, and modifying shows
-   Can update information such as title, date, start and end time, screening room, and poster image
-   Can view the overall seat status for each show (vacant/reserved)

**Customers:**

-   Registered users who have provided their personal data
-   Can reserve movie tickets
-   Able to reserve any number of tickets for non-clashing movies

**Guests:**

-   Unregistered or non-logged-in users
-   Can view current movies' details
-   Can log in or register (sign up) as a customer
-   Unable to reserve tickets
