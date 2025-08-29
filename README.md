# SmartCareerAI – AI-Based Career Counseling Web App

SmartCareerAI is an **AI-powered platform** that helps students discover ideal career paths through a personality test, AI-generated suggestions, and structured roadmaps. This version includes the **core frontend and backend structure**, built in PHP with modular architecture.

---

## 📁 Project Structure

```
project/
├── home.php                ← Homepage
├── login.php                ← User login page
├── register.php             ← User registration page
├── forgot-password.php      ← Forgot password page
├── /includes                ← Common backend includes
│   ├── header.php           ← Website header section
│   ├── footer.php           ← Website footer section
└── └── db.php               ← Database connection file
├── /assets                  ← Frontend styling and assets
│   └── style.css            ← Base stylesheet (In css folder)
│   └── scripts.js           ← Javascript Scripts (In js folder)
└── └── img                  ← Resources of images (In img folder)
├── /user                    ← User dashboard (career tests, reports, resume builder, interview-kit, job-recommendations)
    ├── /includes                ← Common backend includes
    │   ├── header.php           ← Website header section
    │   ├── footer.php           ← Website footer section
    │   └── db.php               ← Database connection file
    ├── /assets                  ← Frontend styling and assets
    │   └── styles.css           ← Base stylesheet (In css folder)
    │   └── scripts.js           ← Javascript Scripts (In js folder)
    └── └── img                  ← Resources of images (In img folder)
├── /admin                   ← Admin dashboard (management)
    ├── /includes                ← Common backend includes
    │   ├── header.php           ← Website header section
    │   ├── footer.php           ← Website footer section
    │   └── db.php               ← Database connection file
    ├── /assets                  ← Frontend styling and assets
    │   └── styles.css           ← Base stylesheet (In css folder)
    │   └── scripts.js           ← Javascript Scripts (In js folder)
    └── └── img                  ← Resources of images (In img folder)
├── /api                     ← API endpoints (AI logic, suggestions)
├── /blogs                   ← Career blogs & articles
├── /reports                 ← Career reports and exports
├── /sqldb                   ← Database SQL files (schema + sample data)
```

---

## ✅ Features (Current Version)

* Static and dynamic front pages with shared header/footer
* Styled using CSS with primary color theme `#3FBBC0 + white`
* Modular file structure for **easy scalability**
* PHP backend with **Laravel-style includes** (but runs on plain PHP)
* Authentication system (Register, Login, Reset/Forgot Password)
* Career Assessment engine with AI-driven recommendations
* Blog & Articles module
* Career Reports (PDF/HTML)
* Admin panel with management tools

---

## 🛠 Setup Instructions

1. **Download** the project folder and place it in your localhost directory (e.g., `XAMPP/htdocs` or Laravel `public/` folder).
2. Start local server:

   * XAMPP → Start Apache & MySQL
   * Laravel (if integrating) → Configure routes accordingly
3. Import database:

   * Open **phpMyAdmin** → Create new DB → Import `/sqldb/smartcareerai.sql` `/sqldb/password-reset.sql` `/sqldb/admin-invite-codes.sql` `/sqldb/sample-data.sql`
4. Run the app in the browser:

   ```
   http://localhost/SmartCareerAI/home.php
   ```

---

## 📦 File Descriptions

| File/Folder       | Purpose                             |
| ----------------- | ----------------------------------- |
| index.php         | Home page with banner and intro CTA |
| login.php         | Form for existing users to sign in  |
| register.php      | New user signup form                |
| /includes/        | Shared layout + logic files         |
| header.php        | Navigation + site header            |
| footer.php        | Site footer                         |
| db.php            | Database connection handler         |
| /assets/style.css | Main styling for layout and buttons |
| /blogs            | Career-related blogs and content    |
| /reports          | Generated career reports            |

---

## 📌 Next Steps (Future Enhancements)

* Expand AI-powered recommendation engine
* Add Counselor-Student live chat / scheduling system
* Build mobile-optimized UI
* Integrate Admin analytics dashboard
* Enhance gamified career quizzes

---

## 👨‍👩‍👧‍👦 Team Roles

* **Sami Amir Rizwan** – Project Lead & Management (Full leadership, architecture, development oversight)
* **Aleesha Amir** – Frontend Developer (UI/UX, portal design, styling)
* **Syed Faiq Ahmed** – Backend Developer (Database, PHP logic, server-side features)

---

## 📧 Contact

For contributions, support, or queries, contact the **Project Lead**:
📩 Email: **[sarizwan777@gmail.com](mailto:sarizwan777@gmail.com)**

---

✅ **Status:** Project Completed (August 2025)
