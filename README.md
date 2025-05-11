# Poya Day Booking System

This is a web application developed using laravel(api) and vue(single page application) to make booking for poya day dhamma sermon. This uses laravel sanctum for API authentication.   

## Pre requirements 
- php(^8.2) and composer should be installed
- node and npm should be installed
- any SQL database server supported by laravel should be installed
  
  ***migrations files are included in code files, no need to add them separately***    

## Installation and Setup

1. Download zip file from main branch of github repo 
2. In root directory execute following command to install laravel and other php packages 

```bash
composer install
```
3. Navigate to frontend directory and execute following command to install vue+vite project and other javascript packages 
```bash
npm install
```
4. Setup database
   1. create .env file by using copy of .env.example file and change values of 

         - DB_CONNECTION
         - DB_PORT
         - DB_USERNAME
         - DB_PASSWORD
     
       according to your database server
   2. create database called 'poya_day_booking_system' as described in DB_DATABASE value of .env file

5. Run migration and seeding database
   1. start database server
   2. navigate into root directory and run following commands one after another in order to run migrations and seed database
```bash
php artisan migrate
```
```bash
php artisan db:seed
```
6. In root rirectory, run following command to start laravel application 
```bash
php artisan serve
```
 -- *Note : database server should always be run to function laravel application*

7. Navigate to frontend directory and run following command to start vue+vite application 
```bash
npm run dev
```

## How to use
- Three pages in application:
  - booking portal 
      - make a booking for poya day
      - anyone can make a booking
      ![alt text](https://github.com/ShanGemunu/poya-day-booking-system/blob/main/readme-images/booking_protal.png?raw=true)

  - login page
      -  user can login here using credentials, **sample admin credentials,  email: admin@mail.com, password - 1234**  
      ![alt text](https://github.com/ShanGemunu/poya-day-booking-system/blob/main/readme-images/login_page.png?raw=true)

  - admin portal  
      -  need to logged as admin to work (sample admin credentials are provided above)
      -  all pending bookings are there
      -  can approve or reject bookings
      ![alt text](https://github.com/ShanGemunu/poya-day-booking-system/blob/main/readme-images/admin_protal.png?raw=true)

- authenticated user can logged out using **logout** button at navbar
   
      

