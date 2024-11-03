# Turpal - Technical Challenge

## Description

Imagine you are working for a travel company called _Travello_.

Travello started out by selling their own products (like experiences/tours/events) for a while. They became quite successful and they decided to integrate with 3rd party providers to expand their range of products.

Here you are expected to write a minimal working API for the business.

We have bootstrapped the project in a Laravel enviorment.
This is the initial [database schema](https://dbdiagram.io/d/630380baf1a9b01b0fbb25ca).

## Tasks

### 1. Search API

First you are expected to deliver Travello products through the search API:

-   Accessible by `GET /search` route.
-   Only **available** products should be shown.
-   Optionally filter by `startDate` and `endDate`. Default is 2 weeks from today.

Sample response structure:

```json
[
    {
        "title": "Desert Safari",
        "minimumPrice": "250.0 AED",
        "thumbnail": "https://picsum.photos/300/200"
    }
]
```

### 2. Integration

Now you are in charge of the integration. This is the primary focus of this challenge.

The idea is to have **transparent** integration with the ever-increasing list of providers.  
By transparent, we mean the Search API always presents the same response structure [as detailed above] for all sort of products.

#### Provider

Here is a fictional provider you need to integrate with:

1. Heavenly Tours ([API Docs](https://documenter.getpostman.com/view/24789999/2s8Z6zyrnn))

## Delivery

1. Clone this repository under your own git namespace.
2. Write us _your_ best code.
3. Send us the link to the repository.

We appreciate your time and effort in advance. Good luck!

## Prerequisites
- **Docker**
- **Docker Compose**
- **Make** (optional, for using the provided Makefile)

## How to Use
### Using the Makefile
1. **Initial Setup**
```
make setup
```
This command will:

- Copy ```.env.example``` to ```.env```
- Build and start the Docker services
- Install Composer dependencies
- Generate the application key
- Run migrations and seed the database
2. **Start Services**
```
make up
```
3. **Stop Services**
```
make down
```
4. **Rebuild Services**
```
make rebuild
```
5. **Run Tests**
```
make test
```
6. **Run Artisan Commands**
```
make artisan migrate
```
7. **Run Composer Commands**
```
make composer require vendor/package-name
```
8. **View Logs**
```
make logs
```
### Without Using the Makefile
1. **Clone the Repository**
```
git clone https://github.com/mjpakzad/travel-ch.git
cd travel-ch
```
2. **Copy the ```.env``` File**
```
cp .env.example .env
```
3. **Build and Start the Docker Services**
```
docker-compose up -d --build
```
4. **Install Composer Dependencies**
```
docker-compose exec travel-app composer install
```
5. **Generate the Application Key**
```
docker-compose exec travel-app php artisan key:generate
```
6. **Run Migrations and Seed the Database**
```
docker-compose exec travel-app php artisan migrate --seed
```
7. Run Tests
```
docker-compose exec travel-app php artisan test
```
### Accessing the Application
- Application URL: http://localhost
- Laravel Telescope: http://localhost/telescope
- Laravel Horizon: http://localhost/horizon

## Additional Information
### Queue Management
- The ```queue``` service in ```docker-compose.yml``` continuously processes the queues.
- Redis is used as the queue driver.

### Email Sending
- Emails are sent to users after each transaction.
- Use Laravel Telescope to view the sent emails.

### Redis Configuration
- The ```phpredis``` extension is used to connect to Redis.
- Ensure ```REDIS_CLIENT=phpredis``` is set in the ```.env``` file.

### Running Artisan or Composer Commands
- **Artisan:**
```
docker-compose exec travel-app php artisan {command}
```
- **Composer:**
```
docker-compose exec travel-app composer {command}
```
