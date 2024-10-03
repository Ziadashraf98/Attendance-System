# Attendance System

## Table of Contents

- [Installation](#installation)
- [Usage](#usage)


## Installation

1. **Clone the repository:**

    ```bash
    https://github.com/Ziadashraf98/Attendance-System.git
    ```

2. **Change into the project directory:**

    ```bash
    cd your-project
    ```

3. **Install dependencies:**

    ```bash
    composer install
    ```

7. **Migrate the database:**

    ```bash
    php artisan migrate
    ```
8. **Running the Development Server:**

    ```bash
    php artisan serve
    ```

## Usage

### API Endpoints

  ```http
                                          ** User Authentication **


-Register:
     POST /api/user/register
        Request Body:

            name (string): User's full name.
            email (email): User's unique email.
            ID_no (integer): User's unique ID number (digits:5).
            password (string): User's password (min 8 characters , max 30 characters).
            c_password (string): User's confirmation password (same:password).
  
   -Log In:
        POST /api/user/login
            Request Body:

            ID_no (digits:5): User's ID number.
            password (string): User's password.
    -Log Out:
        POST /api/user/logout
        User must be authenticated



                                            ** User Attendance **


-check In:
        GET /api/user/check_in
        User must be authenticated

-check Out:
        GET /api/user/check_out
        User must be authenticated



                                            ** User Work Hours **


-Total Hours:
       POST /api/user/get_total_hours
       User must be authenticated
           Request Body:

            from_date (date).
            to_date (date): after_or_equal:from_date.

            
            
