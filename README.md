## Installation Guide

Follow these steps to set up the Laravel REST API on your local machine:

1. **Clone the Repository**
   - Clone the repository to your local machine using:
     ```bash
     git clone [repository-url]
     ```
     Replace `[repository-url]` with the actual URL of the repository.

2. **Navigate to the Project Directory**
   - Change into the project directory:
     ```bash
     cd Laravel_REST_API
     ```

3. **Install Dependencies**
   - Run the following command to install the necessary dependencies:
     ```bash
     composer install
     ```

4. **Create and Configure the Database**
   - Create a new database and configure the `.env` file to include your database settings.

5. **Run Migrations and Seed Database**
   - Execute the migrations and seed the database with:
     ```bash
     php artisan migrate --seed
     ```

Now, your Laravel REST API should be set up and ready to use!
