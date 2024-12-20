Laravel Application Documentation
1. How to Run the Application Locally
Prerequisites

Ensure you have the following installed on your local machine:

    PHP (version 8.1 or higher)
    Composer
    PostgreSQL
    Git
    Node.js and npm (optional for frontend assets)

Steps to Run Locally

    1. Clone the Repository

git clone https://github.com/kipkemoifred/ordering-app.git
cd ordering-app

    2. Install PHP Dependencies

composer install

    3. Set Up Environment Variables

cp .env.example .env
Update the .env file for your PostgreSQL setup.

    4. Generate Application Key

php artisan key:generate

    5. Set Up the Database

psql -U postgres
CREATE DATABASE laravel;

    6. Run migrations:

php artisan migrate

     7. Install Node.js Dependencies (if applicable)

     8. npm install

     9. Run the Development Server

    10. php artisan serve



2. Steps to Deploy the Application with CI/CD Scripts

Prerequisites

    GitHub repository for your Laravel application.
    DigitalOcean Droplet or VPS.
    SSH keypair for deployment.

Steps to Deploy with CI/CD

    Generate SSH Key Pair Generate and configure your SSH keypair for deployment to DigitalOcean.

    Configure GitHub Actions CI/CD Pipeline Create the .github/workflows/ci-cd.yml file with the pipeline definition (as shown in the earlier response).

    Push Changes to GitHub

    git add .github/
    git commit -m "Add CI/CD pipeline for testing and deployment"
    git push origin main

    Monitoring the CI/CD Workflow Go to the Actions tab on GitHub to monitor the CI/CD workflow.

Additional Notes
Permissions

Ensure correct permissions for storage and cache directories:

sudo chown -R www-data:www-data /var/www/your-app/storage /var/www/your-app/bootstrap/cache

DigitalOcean Firewall

Make sure your droplet’s firewall allows SSH access (port 22) and HTTP (port 80).
