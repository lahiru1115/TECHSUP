# TECHSUP: Online IT Services Management System

TECHSUP is an online platform designed to streamline the management of IT services. It provides a convenient and efficient way for users to report and track IT issues, while allowing administrators to effectively manage and resolve these issues.

## Features

### User

- **Landing Page**: The user is greeted with a visually appealing landing page that provides an overview of the platform and its features.
- **Facilities Page**: Users can explore the available IT facilities and services provided by the system. This page offers detailed information about each service.
- **Help Page**: Users can access a comprehensive help page that provides assistance and guidance for common IT issues.
- **Login and Registration**: Users can create an account and log in to the system, ensuring a personalized and secure experience.
- **Issue Management**: Users can add, view, and delete their reported issues. This feature allows them to keep track of their IT problems and monitor their resolution progress.
- **Profile Management**: Users can update their profile information and, if necessary, delete their profile from the system.

### Admin

- **Login**: Administrators can securely log in to the system to access their administrative privileges.
- **Dashboard**: The admin dashboard provides an overview of the system's performance, including statistics on issues, user activity, and resolved problems.
- **Issue Management**: Admins can view, delete, and solve reported issues. This feature enables efficient issue triage and resolution.
- **User Management**: Administrators can manage user accounts by viewing user details, updating their information, and deleting user accounts if necessary.
- **Add New Admin**: Administrators can add new admin accounts, enabling multiple administrators to collaborate in managing the TECHSUP system effectively.

## Technologies Used

- **HTML**: The foundation of the web pages and structure of the TECHSUP application.
- **CSS**: Used for styling the web pages, ensuring an appealing and user-friendly interface.
- **PHP**: Server-side scripting language utilized for handling backend functionalities and connecting with the database.
- **MySQL**: The chosen database management system for storing and retrieving data efficiently.

## Getting Started

To set up a local copy of TECHSUP and start exploring its functionalities, follow these steps:

1. Clone the repository:

   ```bash
   git clone https://github.com/lahiru1115/TECHSUP.git
   ```

2. Configure the web server environment (e.g., WampServer, XAMPP) to point to the cloned project directory.

3. Import the provided SQL dump file (`techsup.sql`) into your MySQL database.

4. Update the database connection parameters in the `dbh.inc.php` file located in the [includes](includes) directory.

5. Access the application through your web browser using the configured server URL.

## Login Credentials

### Admin

To access the admin portal, follow these steps:

1. Open the user login page and enter `admin@2` as the username with any password. This will redirect you to the admin login page.

2. Use the following credentials to log in as an admin:

   - Username: Admin
   - Password: 1234

### User

Use the following credentials to log in as a user:

- Username: ucsc <br>
  Password: ucsc

- Username: Kavishka <br>
  Password: 1234

- Username: Munzira <br>
  Password: 1234

- Username: Lahiru <br>
  Password: 1234

## Contributing

Contributions are welcome! If you'd like to contribute to TECHSUP, please follow these guidelines:

1. Fork the repository.

2. Create a new branch for your feature/bug fix.

3. Commit your changes with descriptive commit messages.

4. Push your branch to your forked repository.

5. Submit a pull request to the main repository, explaining the changes you've made.

## Contact

For any inquiries or support regarding TECHSUP, please reach out to the project maintainer:

- Name: [Lahiru Dissanayake](https://github.com/lahiru1115)
- Email: [lahirudissanayake15@gmail.com](mailto:lahirudissanayake15@gmail.com)

Feel free to report any issues or suggest enhancements via the [issue tracker](https://github.com/lahiru1115/TECHSUP/issues).
