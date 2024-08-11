
# Real Estate Booking Website

Welcome to the **Real Estate Booking Website**! This is an assignment I completed for a university course, a web-based application that allows users to browse and book properties, providing a seamless user experience from browsing listings to finalizing reservations. The system includes a robust authentication system, property management and booking functionality.

## Table of Contents

- [Introduction](#introduction)
- [Features](#features)
- [Installation](#installation)
- [Usage](#usage)
- [Screenshots](#screenshots)
- [Future Improvements](#future-improvements)

## Introduction

This project was developed as a full-stack web application using PHP, MySQL, HTML/CSS, and JavaScript. It aims to provide a comprehensive platform for users to search, view, and book properties. It also includes a secure login system, allowing only authenticated users to make reservations.

## Features

- **User Authentication:** Secure login and registration system using PHP sessions.
- **Property Listings:** Users can browse available properties with detailed information and images.
- **Booking System:** Users can check property availability and make reservations for specific dates.
- **Error Handling:** Clear feedback for invalid login attempts or unavailable booking dates.
- **Responsive Design:** Ensures accessibility and usability across different devices.

## Installation

To get this project up and running on your local machine, follow these steps (or refer to the documentation file, which includes the above steps written in Greek, along with accompanying screenshots):

1. **Clone the repository:**
   ```bash
   git clone https://github.com/yourusername/real-estate-booking-system.git
   ```

2. **Navigate to the project directory:**
   ```bash
   cd real-estate-booking-system
   ```

3. **Set up your environment:**
   - Ensure you have a local server environment like XAMPP or WAMP installed.
   - Place the project files in your server's root directory (e.g., `htdocs` for XAMPP).

4. **Configure the database:**
   - Import the provided `database.sql` file into your MySQL database.

5. **Run the project:**
   - Start your local server and access the project via your browser at `http://localhost/php/index.php`.

## Usage

1. **Registration:**
   - New users can register by providing a username, password, and email address.

2. **Login:**
   - Existing users can log in using their credentials.

3. **Browsing Properties:**
   - After logging in, users can browse through the available properties.

4. **Booking a Property:**
   - Users can select a property, check availability by selecting dates, and finalize their reservation.

5. **Logout:**
   - Users can securely log out, ending their session.

## Screenshots

- Desktop view of the Home Page
![Image 1](image1.png)


- Mobile view of the Home Page
![Image 2](ImagesforReadme/image2.png)

- Login Page
![Image 3](/ImagesforReadme/image3.png)

- Register Page
![Image 4](ImagesforReadme/image4.png)

- First view of the Reserve Page
![Image 5](ImagesforReadme/image5.png)

- Second view of the Reserve Page
![Image 6](ImagesforReadme/image6.png)
![Image 7](ImagesforReadme/image7.png)

- Create Listing Page
![Image 8](ImagesforReadme/image8.png)

For the complete experience, please run the project. These are just a few example screenshots to give you a sense of the website.

## Future Improvements

In evaluating the current implementation, several areas for future improvements have been identified:

1. **Enhanced Security:** Implementing password hashing and stronger validation for user inputs.
2. **Admin Panel:** Developing an admin interface to manage properties, reservations, and users more effectively.
3. **Payment Integration:** Adding a payment gateway to allow users to make payments directly through the platform.
4. **User Profile:** Allowing users to view and manage their past and upcoming reservations.
5. **Multilingual Support:** Implementing support for multiple languages to cater to a broader audience.
