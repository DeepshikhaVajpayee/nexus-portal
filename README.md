🚀 Nexus Portal

Enterprise Workforce Intelligence Platform

A full-stack, Dockerized web application built on a LAMP (Linux, Apache, MySQL, PHP) architecture to monitor, analyze, and manage workforce activity. The system integrates attendance tracking, analytics, reporting, and internal ticketing into a unified dashboard.

 Features
 Secure Authentication

Password hashing

Token-based session handling

Login & logout functionality


🪪 RFID-Based Attendance System

Simulated RFID scan API

Automatic check-in / check-out logic

Real-time attendance logs


Enterprise Dashboard

Live attendance monitoring

Analytics cards and visual insights

Chart-based visualization


 AI Insights Module

Workforce behavior analysis (simulated)

HR assistant interface


 Report Generation System

Generate monthly reports

Store and retrieve report history


 Ticketing System

Create and manage internal tickets

Priority-based issue tracking




Tech Stack

Layer	Technology

Backend	PHP
Database	MySQL
Web Server	Apache
Frontend	HTML, CSS, JavaScript, Bootstrap
Visualization	Chart.js
Containerization	Docker



 System Architecture

Modular PHP backend with REST-style APIs

MySQL relational database with normalized schema

Frontend communicates via fetch APIs

Dockerized services for consistent environment



 Getting Started

Prerequisites

Docker Desktop installed



 Installation & Setup

# Clone the repository
git clone <your-repo-link>

# Navigate to project folder
cd nexus-portal

# Start application
docker compose up -d --build


 Access Application

http://localhost:8000/login.php


 Login Credentials

Email: admin@enterprise.com
Password: password


 Project Structure

nexus-portal/
│
├── api/                 # Backend APIs
│   ├── auth/
│   ├── attendance/
│   ├── tickets/
│   └── reports/
│
├── config/              # Database & auth config
├── database/            # SQL schema
├── public/              # UI assets
├── docker/              # Container configs
│
├── index.php            # Dashboard
├── login.php
├── attendance.php
├── ai-insights.php
├── reports.php
├── tickets.php
├── sidebar.php
│
├── docker-compose.yml
├── Dockerfile
└── README.md


---

🔌 Key API Endpoints

Endpoint	Description

/api/auth/login.php	User authentication
/api/attendance/scan.php	RFID scan simulation
/api/attendance/logs.php	Fetch attendance logs
/api/tickets/create.php	Create ticket
/api/tickets/list.php	View tickets
/api/reports/generate.php	Generate report
/api/reports/list.php	View reports



---

Security Features

Password hashing using PHP password_hash

Token-based API protection

Input validation

Prepared statements (SQL injection prevention)



---

 Learning Outcomes

Full-stack application development using LAMP stack

REST API design and integration

Docker-based deployment and environment management

Secure authentication implementation

Database schema design and normalization




👩‍💻 Author

Deepshikha Vajpayee
B.Tech CSIT


