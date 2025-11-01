# HMS-Hospital Management System 🚑🏥

A compact, student-friendly PHP full‑stack web application to digitalize hospital workflows — patient registration, doctor profiles, appointment scheduling, and lightweight administrative reporting. Ideal for college students learning full‑stack web development with PHP & MySQL. 👨‍💻📚

---

Table of contents
- Project overview
- Features
- Detailed features by role
- Technology stack
- Target audience & user roles
- Prerequisites
- Installation & setup (local, XAMPP)
- File structure (project layout) 🗂️
- Configuration-time FAQs (helpful tips) ❓
- Usage
- 🚨 **CRITICAL SECURITY STATUS - READ IMMEDIATELY** 🚨
- How to fix the critical vulnerabilities (high priority)
- Contribution (urgent)
- License
- Contributor

## Project overview
HMS-Hospital Management System (HMS) is a learning-focused Hospital Management System built with PHP and MySQL. It implements role-based registration/login (Admin / Patient / Doctor), doctor profile management, appointment CRUD, and an admin panel placeholder.

This project is for educational and local testing purposes only. Do NOT deploy to production until the critical security issues below are fully remediated. ⚠️

## Features (core)
- Role-based user registration and login (Admin, Patient, Doctor)
- Doctor profile management (viewing/updating availability)
- Patient dashboard for viewing upcoming appointments
- Basic CRUD operations for appointment scheduling
- Administrative panel (placeholder)

## Detailed features by role — as implemented in this project ✨

- Patient
  - Sign Up & Login, Password Management & Logoff — user authentication flows.
  - Book Appointment, Download Appointment Ticket & Cancel Appointment — schedule with preferred doctors and manage bookings.
  - Profile Update — keep personal information up‑to‑date.
  - View Appointment History & Download Prescription — access past appointments and prescriptions.
  - Query to Doctor — send direct queries to assigned doctors.

- Doctor
  - Sign Up & Login, Logoff — access to doctor portal.
  - Profile & Password Update — keep professional details current.
  - View Appointments & Attend Appointment — overview of today’s, upcoming, and past appointments.
  - Search Patient, Add New Patient & Book Appointment — manage patient records and create bookings.
  - Answer Queries & Departmental Queries — respond or escalate patient queries.

- Admin (placeholder features)
  - Dashboards: counts of admitted patients, ongoing treatments, closed cases; departmental metrics; doctor stats; appointment trends.
  - Manage Data: oversee patient, doctor, appointment, query, and feedback records.
  - Authorize Doctors: enable doctors to input or update professional details.

## Technology stack
- PHP (server-side) — primary language
- MySQL / SQL — database
- HTML, CSS, JavaScript, jQuery — frontend
- Chart.js (used for simple dashboard charts)
- XAMPP recommended for local development

## Target audience & user roles
Audience: college students new to full‑stack web development — code is intended to be readable and easy to modify.

Roles:
- Admin — management and oversight (placeholder functionality)
- Doctor — profile/availability, appointments, patient access
- Patient — registration, scheduling, history, prescriptions

## Prerequisites ✅
- PHP 7.4 or newer
- MySQL (or MariaDB)
- XAMPP (recommended) or another AMP stack
- A web browser for testing

Note: Composer is NOT required for this project (removed from prerequisites). 🚫📦

## Installation & setup (local development using XAMPP)
1. Install XAMPP (https://www.apachefriends.org/) and start Apache & MySQL from the XAMPP control panel. ⚙️  
2. Clone the repository into your XAMPP htdocs (or www) directory:
   - git clone https://github.com/Chandansahu7980/Hospital-Management-System.git
   - Example paths:
     - Windows: C:\xampp\htdocs\Hospital-Management-System
     - Linux: /opt/lampp/htdocs/Hospital-Management-System
3. Database setup — IMPORTANT:
   - Import the database file located at DB/projectHMS.sql (this is the SQL file provided with the project and must be used to create schema + seed data).
   - In phpMyAdmin (http://localhost/phpmyadmin) or via CLI:
     - Create a database, for example: phms_db.
     - Import DB/projectHMS.sql into your new database.
     - Example CLI import:
       - mysql -u root -p phms_db < /path/to/Hospital-Management-System/DB/projectHMS.sql
4. Configure the database connection:
   - The project has a database config script at db/config.php — update this file with your local DB credentials (host, username, password, database name).
   - Typical XAMPP defaults: host = 127.0.0.1 or localhost, username = root, password = (blank), database = phms_db.
5. Test the DB connection:
   - Run the database connection test file: open db/config.php in your browser:
     - http://localhost/Hospital-Management-System/db/config.php
   - This file should report a successful connection (or show errors that indicate what to fix).
6. Open the app in your browser:
   - http://localhost/Hospital-Management-System/
7. Default accounts and test data:
   - If database.sql includes seed accounts, use those credentials. If not, register new accounts through the app UI.

## Usage
- Register as Patient or Doctor (or create an Admin account if seed data exists).
- Doctors can edit their profile and set availability.
- Patients can create, view, update, and cancel appointments.
- Admin panel is a placeholder and may contain demo links for administrative tasks.

---

# 🚨 Critical Security Status - Read Immediately 🚨
**THIS SECTION IS CRITICAL — READ NOW.**  
The current codebase contains at least two clear, high-risk security vulnerabilities that **must** be remediated before any public deployment. These issues put all users and their data at immediate risk.

1) Unfiltered Direct SQL Queries — SQL Injection Risk (HIGH)
- What it is: The codebase concatenates user-supplied input directly into SQL query strings (for example: building "SELECT ... WHERE id = $_GET['id']" or inserting form fields directly into an INSERT statement).
- Why it’s dangerous: An attacker can craft input that alters the SQL query's structure (SQL Injection). This can lead to:
  - Reading, modifying, or deleting sensitive data (including user credentials and appointments).
  - Escalating privileges, bypassing authentication, or triggering destructive SQL commands.
  - Total database compromise and data exfiltration.
- Where it affects: All CRUD operations (registration, login, appointment scheduling, profile updates) that use concatenated SQL statements without prepared statements or proper escaping.

2) Plaintext Password Storage — Immediate Account Compromise (CRITICAL)
- What it is: All user passwords (Patient and Doctor accounts observed in the current codebase) are stored in the database in plaintext (unencrypted, unhashed, unsalted).
- Why it’s dangerous: If the database is leaked, accessed, or queried improperly, **every** password is immediately readable by an attacker. This enables:
  - Immediate credential theft and reuse (credential stuffing on other services).
  - Easy impersonation of users (including doctors and admins).
  - Complete loss of user privacy and trust.
- Where it affects: Registration and user table(s) — any code that writes or reads passwords from the DB in plaintext.

You must treat these as top-priority, block-the-deployment issues. Do not deploy this repository to any public or production-facing server until they are resolved.

---

## How to fix the critical vulnerabilities (high priority)
Below are concrete, actionable remediation steps and code patterns to implement immediately.

1) Prevent SQL Injection — migrate to prepared statements (recommended: PDO or mysqli prepared statements)
- Use PDO with prepared statements and bound parameters:
  - Example using PDO:
  ```php
  // Use PDO and prepared statements
  $pdo = new PDO('mysql:host=127.0.0.1;dbname=phms_db;charset=utf8mb4', $DB_USER, $DB_PASS, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  ]);

  // Example safe SELECT
  $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
  $stmt->execute([':email' => $_POST['email']]);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);
  ```

  - Or mysqli prepared statement:
  ```php
  $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
  $stmt->bind_param("s", $_POST['email']);
  $stmt->execute();
  $result = $stmt->get_result();
  ```

- Replace all dynamic SQL concatenations (including SELECT, INSERT, UPDATE, DELETE) with prepared statements and explicit parameter binding.

2) Fix password handling — use PHP's password_hash() and password_verify()
- On registration:
  ```php
  $passwordHash = password_hash($_POST['password'], PASSWORD_DEFAULT);
  // Store $passwordHash into the database (not the raw password)
  $stmt = $pdo->prepare("INSERT INTO users (email, password_hash, role) VALUES (:email, :hash, :role)");
  $stmt->execute([':email' => $_POST['email'], ':hash' => $passwordHash, ':role' => $role]);
  ```
- On login:
  ```php
  $stmt = $pdo->prepare("SELECT id, password_hash FROM users WHERE email = :email");
  $stmt->execute([':email' => $_POST['email']]);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);
  if ($user && password_verify($_POST['password'], $user['password_hash'])) {
      // success
  } else {
      // invalid credentials
  }
  ```
- Do NOT invent your own cryptographic functions or use MD5/SHA1 unsalted. Use PHP's built-ins: password_hash() and password_verify().

3) Migrating existing plaintext passwords
- Create an offline migration script that:
  - Requires admin access and runs from a safe environment (not publicly accessible).
  - Reads each user with a plaintext password, computes password_hash(plaintext), and updates the stored password field to the hash.
  - Example pseudo-workflow:
    - Add a new column password_hash (nullable).
    - For each user row where password_hash is NULL:
      - $hash = password_hash($row['password'], PASSWORD_DEFAULT);
      - UPDATE users SET password_hash = $hash WHERE id = $row['id'];
    - After verifying migration success, remove the plaintext password column (or clear its values) and rename password_hash to password if desired.
  - Make backups before running migration. Do NOT overwrite hashed values accidentally.

4) Additional security hardening (recommended)
- Validate and sanitize all inputs server-side (and use prepared statements as primary defense).
- Use HTTPS for any deployed environment.
- Use least privilege for DB user (no root-level DB user for the app).
- Implement CSRF tokens on forms.
- Implement proper session management (regenerate session IDs after login).
- Do not keep configuration files with credentials committed to the repository. Use environment variables or a .env file that is ignored by git.

---

## Contribution
We welcome contributors. The primary call-to-action is urgent and specific:

Top priority (required before any other contributions):
1. Fix the two critical security vulnerabilities described above:
   - Migrate all SQL code to prepared statements (PDO or mysqli prepared statements).
   - Implement secure password storage using password_hash() on registration and password_verify() on login.
   - Provide a safe migration path for existing plaintext-stored passwords.
   - Add unit or integration tests that ensure SQL injection attempts are neutralized and that login uses hashing.

Secondary contributions (accepted only after the top-priority fixes are under control):
- Bug fixes (UI/UX improvements, pagination, validation)
- New features (notification system, appointment reminders, admin reporting)
- Refactoring to MVC architecture, adding routing and templating
- Adding automated tests and CI (GitHub Actions)
- Improving documentation and coding standards

How to contribute:
- Fork the repo, create a feature branch per change, and open a PR with detailed descriptions. When submitting PRs that change authentication or DB logic, include tests and migration scripts and clearly mark security implications.

If you want to take ownership of one of the fixes above, please state your intention in the issue tracker and provide PRs that focus on a single vulnerability at a time (e.g., "Migrate registration/login to password_hash and prepared statements").

## License
This project is offered under the MIT License. (Insert full MIT license text here in the LICENSE file.)

---

If you are a student using this repo for learning:
- Treat the security sections as a hands-on lab: first, reproduce the vulnerability in a safe local environment, then implement the fixes above and verify they remove the vulnerability.
- Ask for code review from more experienced developers before merging security-critical changes.

Thank you for reviewing HMS — please address the security items immediately if you plan to use this project with real or sensitive data.