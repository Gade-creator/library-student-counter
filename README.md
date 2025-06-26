Library Student Counter System
📖 Overview
A web-based system for tracking student entries and exits in the university library using ID card scanning. Built with:

https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white
https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white
https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white

✨ Features
Real-time occupancy tracking

Student ID verification

Capacity monitoring with alerts

Automated reporting

Admin dashboard

🚀 Installation
Prerequisites
PHP 7.4+

MySQL 5.7+

Web server (Apache/Nginx)

Setup Steps
Clone repository:

bash
git clone https://github.com/yourusername/library-student-counter.git
Import database:

bash
mysql -u username -p database_name < sql/schema.sql
Configure:

bash
cp includes/config.sample.php includes/config.php
Set permissions:

bash
chmod -R 755 assets/ uploads/
🖥️ Usage
Entry Point: /scan/ - For student ID scanning

Display Screen: /display/ - Shows current occupancy

Admin Panel: /admin/ - Manage system settings (login required)

📂 Project Structure
text
library-student-counter/
├── assets/          # CSS, JS, images
├── includes/        # Configuration files
├── scan/            # Scanning interface
├── admin/           # Admin dashboard
├── display/         # Public display
├── sql/             # Database schemas
├── index.php        # Homepage
└── README.md        # This file
🤝 Contributing
Fork the project

Create your feature branch:

bash
git checkout -b feature/amazing-feature
Commit changes:

bash
git commit -m 'Add amazing feature'
Push to branch:

bash
git push origin feature/amazing-feature
Open a pull request

📜 License
Distributed under the MIT License. See LICENSE for more information.

📧 Contact
Project Maintainer - [Your Name]
Email - your.email@astu.edu.et

<div align="center"> <img src="assets/images/astu-logo.png" alt="ASTU Logo" width="150"> <p>Adama Science and Technology University</p> </div>
