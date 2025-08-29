SmartCareerAI – AI-Based Career Counseling Web App
SmartCareerAI is an AI-powered platform that helps students discover ideal career paths through a personality test, AI-generated suggestions, and structured roadmaps. This version includes the core frontend and backend structure.

📁 Project Structure

project/
├── index.php ← Homepage
├── login.php ← User login page
├── register.php ← User registration page
├── /includes ← Common backend includes
│ ├── header.php ← Website header section
│ ├── footer.php ← Website footer section
│ └── db.php ← (To be created later: database connection)
├── /assets ← Frontend styling and assets
│ └── style.css ← Base stylesheet

✅ Features (in current version)

Static front pages with shared header/footer

Styled using CSS with your selected color theme (#3FBBC0 + white)

Modular file structure for easy expansion

Laravel-style PHP includes (but works in plain PHP)

🛠 Setup Instructions

Download the project folder and place it in your localhost directory (e.g., XAMPP htdocs or Laravel public/ folder).

Run a local server:

XAMPP: Start Apache & MySQL

Laravel: Set up Laravel routes if integrating

Open index.php in your browser:
http://localhost/SmartCareerAI/home.php

📦 File Descriptions

File/Folder	Purpose
index.php	Home page with banner and intro CTA
login.php	Form for existing users to sign in
register.php	New user signup form
/includes/	Shared layout and logic files
header.php	Navigation + site header
footer.php	Site footer
/assets/style.css	Main styling for layout and buttons

📌 Next Steps (For Full Version)

Build db.php and set up MySQL database connection

Add backend login/register logic (login_handler.php, register_handler.php)

Create /user/ dashboard and test modules

Add AI suggestion API endpoint (/api/ai_suggestions.php)

Build admin panel under /admin

🧑‍💻 Team Roles (Recommended)

Frontend: Works in /assets + page layout

Backend: Works in /includes + dynamic logic

PM: Oversees progress, GitHub versioning

AI/Logic: Works on test scoring and AI integration

📧 Contact

If you need help or contributions, contact the team lead or project manager at this email: sarizwan777@gmail.com.

Would you like me to package this README file with your other files (once tools are available), or should I generate a downloadable copy separately?


graph TD;
    subgraph "Cloud 1: User Identity & Access"
        direction LR
        Users["fa:fa-user users Table<br>(Stores user profiles)"]
        PasswordResets["fa:fa-key password_resets Table<br>(Manages password recovery tokens)"]
        AuthTokens["fa:fa-shield-alt auth_tokens Table<br>(Handles 'Remember Me' sessions)"]
        
        Users -- "Password Reset Request" --> PasswordResets;
        Users -- "Creates 'Remember Me' Token" --> AuthTokens;
    end

    subgraph "Cloud 2: Admin Identity & Access"
        direction LR
        AdminInvites["fa:fa-envelope admin_invites Table<br>(One-time admin registration codes)"]
        Admins["fa:fa-user-shield admins Table<br>(Stores administrator accounts)"]
        
        AdminInvites -- "Enables Account Creation" --> Admins;
    end

    subgraph "Cloud 3: Aptitude Testing Engine"
        direction TB
        TestQuestions["fa:fa-list-alt test_questions Table<br>(Question bank)"]
        TestSessions["fa:fa-play-circle test_sessions Table<br>(Tracks a user's test attempt)"]
        TestAnswers["fa:fa-check-square test_answers Table<br>(Stores user's selected answers)"]
        Results["fa:fa-poll results Table<br>(Final scores & AI feedback)"]
        
        TestQuestions --> TestSessions;
        TestSessions --> TestAnswers;
        TestAnswers --> Results;
    end

    subgraph "Cloud 4: Career & Mentorship Resources"
        direction LR
        Careers["fa:fa-briefcase careers Table<br>(Career path information)"]
        Mentors["fa:fa-users mentors Table<br>(Mentor profiles)"]
    end

    subgraph "Cloud 5: Initial Data Population"
        SampleData["fa:fa-database sample-data.sql<br>(Provides initial test data)"]
    end

    %% Connections between Clouds
    Users -- "Initiates Test" --> TestSessions;
    Results -- "Generates For" --> Users;
    Results -- "Recommends" --> Careers;
    Results -- "Suggests" --> Mentors;
    Admins -- "Manages" --> TestQuestions;
    Admins -- "Manages" --> Careers;
    Admins -- "Manages" --> Mentors;

    SampleData -- "Inserts Sample Data Into" --> Users;
    SampleData -- "Inserts Sample Data Into" --> Admins;
    SampleData -- "Inserts Sample Data Into" --> Careers;
    SampleData -- "Inserts Sample Data Into" --> Mentors;
    SampleData -- "Inserts Sample Data Into" --> TestQuestions;

    %% Styling
    style Users fill:#cde4ff,stroke:#6699ff,stroke-width:2px
    style Admins fill:#cde4ff,stroke:#6699ff,stroke-width:2px
    style TestSessions fill:#d5f5e3,stroke:#58d68d,stroke-width:2px
    style Results fill:#d5f5e3,stroke:#58d68d,stroke-width:2px
    style Careers fill:#fdebd0,stroke:#f5b041,stroke-width:2px
    style Mentors fill:#fdebd0,stroke:#f5b041,stroke-width:2px
    style SampleData fill:#f2d7d5,stroke:#e74c3c,stroke-width:2px
