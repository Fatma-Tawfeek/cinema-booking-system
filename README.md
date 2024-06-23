# Cinema Booking System

Welcome to the Cinema Booking System project. This platform allows users to register, login, and book cinema seats for specific movies at chosen times and dates. It also includes functionality for handling payments using the Checkout.com payment gateway. Administrators can manage movies, actors, cinemas, and bookings through a dedicated dashboard.

## Features

-   **User Registration and Login:** Allow users to register and log in to the system.
-   **Seat Booking:** Users can book cinema seats for specific movies, times, and dates.
-   **Payment Integration:** Integrated payment functionality using Checkout.com payment gateway.
-   **Admin Dashboard:** Dashboard for administrators to manage movies, actors, cinemas, and bookings.

## Technologies Used

-   **Backend:** Laravel
-   **Frontend:** HTML, CSS, Javascript
-   **Payment Gateway:** Checkout.com

## Screenshots

![Homepage](https://i.imgur.com/KaEiRD4.png)

![Timeslots](https://i.imgur.com/qMXNZCn.png)

![Cinema Seats](https://i.imgur.com/ctSYkGP.png)

![Payment Confirmation](https://i.imgur.com/CTl4sTa.png)

![Bookings List](https://i.imgur.com/aTaE8r3.png)

## Installation

Follow these steps to set up the Cinema Booking System project on your local machine:

1. **Clone the repository:**

    ```sh
    git clone https://github.com/yourusername/zeem.git

    ```

2. **Navigate to the project directory:**

    ```sh
    cd zeem

    ```

3. **Install the dependencies:**

    ```sh
    composer install
    npm install

    ```

4. **Generate an application key:**

    ```sh
    php artisan key:generate

    ```

5. **Set up the database:**

    ```sh
    npm run dev
    ```

6. **Compile the assets:**

    ```sh
    php artisan migrate
    ```

7. **Serve the application:**
    ```sh
    php artisan serve
    ```
