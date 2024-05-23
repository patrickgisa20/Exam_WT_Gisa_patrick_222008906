 EVENT MANAGEMENT SYSTEM.

$username = "gisa";
$password = "222008906";
$dbname = "event_management_system"; 


Event Management System Overview

 1. Introduction

The Event Management System is a software application designed to enhance the management of events within an organization. It offers functionalities for managing both admin and users, events, venues, attendees, bookings, event registration, and feedback. The system caters to two types of users: ADMIN and regular users (eventregistration/attendees,others). This document provides an overview of the system's structure, functionalities, and usage.

 2. System Requirements

To utilize the Event Management System, the following tools and resources are required:

- Computer
- Text editor (e.g., Sublime Text)
- XAMPP server
- Web browser (e.g., Chrome)

3. System Structure

The system is organized into the following components:

.User Authentication
Users see the index interface containing pictures of events, where both ADMIN and regular users can create accounts and log in to access their respective interfaces.

.User Interface
- Attendee Page: Enables attendees to register people who will attend the event.
- Event Registration Page: Allows users to register themselves on the site to make a report of people attending the event. It has a foreign key and displays information about events and attendees Beside tables.
- Booking: Allows users to book events. It has a foreign key of the event and stores the venue. It includes tables that show the events being managed.
- Feedback: Allows users to give feedback after the event. It has a table that shows the foreign key (event, venue) so that users can insert relevant data into the database.
- Logout: Destroys the session and returns to the index page.

 Admin Interface
- Login: Admins log in to access admin functionalities.
- Event Management: Admins can insert event details and view information about organizers and venues in tables.
- Organizers: Allows the admin to enter information about people who are capable of organizing the event.
- Sponsors: Allows entry of information about people or entities investing in events.
- Venues: Allows admin to insert venue details where events can take place.
- View: Allows admin to view all tables in the database and perform delete and update operations on records.
- Logout:Destroys the admin session and returns to the index page.

 4. Functionality

.User Authentication
- Secure user authentication mechanism.
- Individual accounts for ADMIN and regular users (booking/attendees, feedback).

 Event Organizer Management
- Organizers can input and manage their event details within the system.

.Attendee Management
- Attendees can view event information and register for events.

 Admin Functionality
- Admins can log in and access administrative features.
- Event management: Inserting event details and viewing organizer/attendee information.

 5. Usage

 User Interface
- Users (booking/attendees and others) log in to access their respective pages.
- Organizers input and manage their event information on the organizer page.
- Attendees view events and register for them on the attendee page.

 Admin Interface
- Admins log in to access the admin interface.
- Admins manage all aspects of the system and can view, update, and delete all records in the system.

6. Conclusion
The Event Management System is a comprehensive tool designed to streamline event management within an organization. By providing functionalities for user management, along with administrative features for the event system, the system aims to enhance efficiency and effectiveness in event operations. It enables secure and efficient handling of event registration, bookings, feedback, and overall event management, making it an invaluable resource for any organization looking to improve their event management processes