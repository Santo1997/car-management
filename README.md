# Car Rental Web Application

This Laravel-based Car Rental Web Application allows users to browse available cars, select a car, and book it for a specified rental period. The system ensures that cars are available for the chosen dates before confirming the booking. The application features role-based access control, an admin dashboard, and a frontend for user interaction.

### 🔗 Links
- [Video Presentation](https://drive.google.com/file/d/1zDEjF1qtxodA7RfYS7sSmjgIU0oE6pAv/view?usp=sharing)


## Features

### Admin Dashboard
Administrators can:
- **Manage Cars**: Add, edit, and delete car details, including name, brand, model, year of manufacture, car type (SUV, Sedan, etc.), daily rent price, availability status, and car images.
- **Manage Rentals**: View and manage all car rentals, including rental ID, customer name, car details, rental start and end dates, total cost, and rental status (Ongoing, Completed, Canceled).
- **Manage Customers**: View and manage customer details such as name, email, phone number, address, and rental history.
- **Dashboard Overview**: View important statistics, such as the total number of cars, available cars, total rentals, and earnings from rentals.

### Frontend (User Interface)
Users can:
- **Browse Cars**: View available cars with filters such as car type, brand, and daily rent price.
- **Make a Booking**: Select a car, choose the rental start and end date, and book the car (availability is checked).
- **Manage Bookings**: After logging in, users can view their current and past bookings and cancel a booking (only if the rental has not started yet).
- **User Authentication**: Basic authentication system allowing users to sign up, log in, and log out.

### Email Notifications
- When a car is rented, the customer and admin receive a confirmation email with the rental details.

### Payment System
- No payment system is implemented, as bookings are handled by cash.

## Database Design

The database consists of the following tables:

- **users**: Stores information about users (both customers and admins).
  - `id`, `name`, `email`, `password`, `role`, `created_at`, `updated_at`
  
- **cars**: Stores details about cars.
  - `id`, `name`, `brand`, `model`, `year`, `car_type`, `daily_rent_price`, `availability`, `image`, `created_at`, `updated_at`
  
- **rentals**: Stores information about rentals.
  - `id`, `user_id`, `car_id`, `start_date`, `end_date`, `total_cost`, `created_at`, `updated_at`

## Models

- **User** (`User.php`)
  - `isAdmin()`: Method to check if the user is an admin.
  - `isCustomer()`: Method to check if the user is a customer.
  - `rentals()`: Defines a `hasMany` relationship with the `Rental` model (a user can have multiple rentals).

- **Car** (`Car.php`)
  - `rentals()`: Defines a `hasMany` relationship with the `Rental` model (a car can have multiple rentals).

- **Rental** (`Rental.php`)
  - `car()`: Defines a `belongsTo` relationship with the `Car` model (a rental is associated with one car).
  - `user()`: Defines a `belongsTo` relationship with the `User` model (a rental is associated with one user).

## Controllers

### Admin Controllers
- **CarController**: Handles car management (Admin/CarController.php).
- **RentalController**: Handles rental management (Admin/RentalController.php).
- **CustomerController**: Handles customer management (Admin/CustomerController.php).

### Frontend Controllers
- **PageController**: Handles frontend pages (Frontend/PageController.php).
- **CarController**: Manages car listings and bookings for users (Frontend/CarController.php).
- **RentalController**: Manages rental history and booking actions for users (Frontend/RentalController.php).


### 🔗 Links
- [Video Presentation](https://drive.google.com/file/d/1zDEjF1qtxodA7RfYS7sSmjgIU0oE6pAv/view?usp=sharing)
