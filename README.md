# Event Booking System

## Setup Instructions
1. Clone the repository:
   ```
   git clone <your-repo-link>
   ```
2. Navigate to the project folder:
   ```
   cd event_booking
   ```
3. Import the database:
   - Open **phpMyAdmin**.
   - Create a new database **event_booking**.
   - Import the `database.sql` file from the repo.

4. Configure the database connection:
   - Open `db.php` and update the following with your credentials:
     ```php
     $servername = "localhost";
     $username = "root";
     $password = "";
     $dbname = "event_booking";
     ```

5. Start the server:
   ```
   php -S localhost:8080
   ```
   Or use XAMPP and place the project inside `htdocs`.

6. Access the project in a browser:
   ```
   http://localhost:8080/event_booking/
   ```

## Database Connection Details
- Host: `localhost`
- Username: `root`
- Password: `(leave empty)`
- Database Name: `event_booking`

## Sample Login Credentials
- **Admin**
  - Email: `admin@example.com`
  - Password: `admin123`
- **User**
  - Email: `user@example.com`
  - Password: `user123`

## Included Files
- `db.php` - Database connection file.
- `database.sql` - Contains table structure and sample data.
- `index.php` - Home page.
- `login.php` - User login page.
- `register.php` - User registration page.
- `dashboard.php` - Admin dashboard.

---

💡 Make sure your server is running before accessing the project!
