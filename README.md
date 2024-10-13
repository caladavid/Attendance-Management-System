## Attendance Management Application!

<p align="center">
  <a href="#"><img src="https://github.com/user-attachments/assets/31b81b5d-e07c-480d-9fb0-2ba8102b7d58"/></a>
  <a href="#"><img src="https://github.com/user-attachments/assets/2147e2b1-e7e1-4d1c-aa0f-395521920d46"/></a>
</p>

<p align="center">
  <a href="#"><img src="https://img.shields.io/badge/laravel-%23FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white"/></a>
  <a href="#"><img src="https://img.shields.io/badge/livewire-%234e56a6.svg?style=for-the-badge&logo=livewire&logoColor=white"/></a>
  <a href="#"><img src="https://img.shields.io/badge/postgres-%23316192.svg?style=for-the-badge&logo=postgresql&logoColor=white"/></a>
  <a href="#"><img src="https://img.shields.io/badge/bootstrap-%238511FA.svg?style=for-the-badge&logo=bootstrap&logoColor=white"/></a>
</p>

This web-based application, developed as part of a university project, is designed to optimize and simplify the process of tracking employee attendance for companies and institutions.

🚀 With this platform, employees can effortlessly log their attendance, while administrators can manage users, departments, and shifts, and generate detailed attendance reports. The system is built using Laravel and modern web technologies to ensure a fast, responsive, and secure experience.

Get ready to streamline your organization's attendance management with the Attendance Management Application – efficient, user-friendly, and tailored to your needs! 🌟


## Features 

- User Authentication:
  - Secure login and logout system.
  - Differentiated user roles (Admin and Employee).
- User Management (CRUD):
  - Create, view, edit, and delete employee records.
  - Assign roles, departments, and shifts to each user.
- Department Management (CRUD):
    - Create and manage departments that employees are assigned to.
- Shift Management (CRUD):
    - Define and manage work shifts with specified start and end times.
    - Shift validation to ensure end time is after the start time.
- Attendance Tracking:
    - Employees can easily log their check-in and check-out times.
    - Efficient tracking of work hours.
- Report Generation:
    - Generate detailed reports by date range, department, or employee.
    - Export reports in PDF format for easy review.
- Responsive Design and Usability:
    - User-friendly interface accessible from any device (mobile or desktop).
    - Intuitive dashboard for managing employees, shifts, and departments.
- Security:
    - Role-based access control to limit administrative functions.
    - Data validation and protection against common attacks like SQL injection.

## Installation Instructions

To set up and run the Attendance Management Application, follow these steps:

1. **Clone the Repository:**
   ```bash
   git clone [repository-url]
   ```
   
2. Navigate to the Project Directory:
   ```bash
   cd attendance-management-app
   ```
   
3. Install Dependencies: Run the following command to install Laravel dependencies:
   ```bash
   npm install
   composer install
   ```

4. Configure Environment Variables:
- Create a .env file in the root directory.
- Copy the contents from .env.example and set the required environment variables (e.g., database connection details).

5. Run Migrations: Set up the database by running the migrations:
      ```bash
   php artisan migrate
   ```

6. Start the Development Server: Run the development server with:
   ```bash
   php artisan migrate

   ```
7. Access the Application: Open your browser and navigate to http://localhost:8000 to access the app.
   
# Experiencing an Issue? ⚠️

Did you stumble upon a bug or encounter an issue while using Astralea? Your feedback is invaluable to us! Please report any [bugs or technical glitches](https://github.com/caladavid/astralea/issues)  you encounter so we can swiftly address them and enhance your browsing experience. 

## Get in Touch! 📩

We'd love to hear from you! Whether you have a question, feedback, or just want to say hello, don't hesitate to reach out. Feel free to [contact me](https://github.com/caladavid) and let's connect!  

## Support & Contributions 🤲

#### [Star this project](https://github.com/caladavid/astralea) ⭐️
