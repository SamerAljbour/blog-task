1. Clone the Repository
Clone the repository to your local machine:
git clone https://github.com/your-repository-url.git
cd your-project-directory
2. Install Dependencies
Ensure Composer is installed.
Run the following command to install all necessary dependencies:
composer install
3. Set Up Environment Variables
Copy .env.example to create .env configuration file:
cp .env.example .env
4. Generate Application Key
Run the command to generate the application key:
php artisan key:generate
5. Set Up the Database
Set up a MySQL (or another supported database) instance.
Update .env file with your database credentials:
env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
6. Run Migrations
Run the migrations to create the required tables:
php artisan migrate
7. Run Seeders
Seed the database to insert predefined roles and users:
php artisan db:seed
To refresh and reseed the database (migrate and seed again):
php artisan migrate:refresh --seed
8. Create Users and Assign Roles
RoleSeeder will create:
customer and admin roles
Admin user: email admin@example.com, password Admin@1234
Customer users: 3 automatically created
9. Access the Application
Start the development server:
php artisan serve
Access the app at http://127.0.0.1:8000/blogs.
