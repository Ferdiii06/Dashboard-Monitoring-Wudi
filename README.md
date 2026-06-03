# WUDI Monitoring Dashboard & Backend

Welcome to the WUDI Monitoring Dashboard! This project serves as both the robust REST API backend for the WUDI task management platform and a fully integrated, aesthetic, modern Monitoring Dashboard for administrators. Built with Laravel 12, PHP 8.2, and Tailwind CSS.

---

## 📖 Overview

WUDI is designed to provide seamless task management, team collaboration, push notifications, and scheduled reminders. On top of this powerful backend, we've integrated a real-time **Monitoring Dashboard** that tracks active users, API interactions, system health, and security logs. 

To make system administration even easier, the dashboard includes **Wudi AI Assistant**—an intelligent chatbot powered by **Gemini 2.5 Flash** that can summarize metrics, audit logs, and provide actionable insights in natural language.

---

## ✨ Key Features

### 🖥️ Monitoring Dashboard (Frontend)
- **Real-Time Analytics:** View live task distributions, user growth charts, and daily API interactions.
- **System Health Polling:** Automatically monitors Database Latency, API Requests, CPU/RAM Usage, and WebSocket status every 5 seconds.
- **Data Exporting:** Generate and download reports in **CSV** or **PDF** formats instantly directly from the browser.
- **Dynamic Security Logs:** Tracks user activities, flags anomalies, and displays them in an easy-to-read audit list.
- **Wudi AI Assistant:** A built-in, context-aware chat assistant that reads real-time dashboard data and summarizes logs for you. Fully customized with WUDI branding, local chat history persistence, and clean text formatting.

### ⚙️ Core Backend (API)
- **JWT Authentication:** Stateless token-based auth with idempotent token rotation.
- **Google OAuth:** Sign in or register using a Google ID token.
- **Email Verification & OTP:** Secure onboarding with 6-digit OTP verification for emails and password resets.
- **Team Collaboration:** Create teams, set member limits, and track completion per member.
- **Push & In-App Notifications:** Firebase Cloud Messaging (FCM HTTP v1) combined with persistent in-app read/unread states.
- **Timezone Sync & Scheduled Jobs:** Daily deadline checks and localized push notifications via Laravel Scheduled Commands.
- **Rate Limiting & Security:** Stricter throttle groups for authentication and general traffic. Gzip compression enabled.

---

## 🛠️ Tech Stack

- **Framework:** Laravel 12 (PHP 8.2)
- **Frontend UI:** Blade Templates, Vanilla JS, Tailwind CSS
- **AI Model:** Google Gemini 2.5 Flash
- **Database:** PostgreSQL (Production) / SQLite (Development)
- **Authentication:** JWT (php-open-source-saver/jwt-auth)
- **Push Notifications:** Firebase Cloud Messaging via `kreait/laravel-firebase`

---

## 🚀 Installation & Setup

1. **Clone the repository:**
   ```bash
   git clone https://github.com/Ferdiii06/Dashboard-Monitoring-Wudi.git
   cd Dashboard-Monitoring-Wudi
   ```

2. **Install PHP & Node dependencies:**
   ```bash
   composer install
   npm install
   ```

3. **Configure the environment:**
   ```bash
   cp .env.example .env
   ```
   *Edit `.env` and configure your database, JWT secret, Gemini AI Key (`GEMINI_API_KEY`), and Firebase settings.*

4. **Add Firebase Credentials:**
   Place your Firebase Service Account JSON file in `storage/app/firebase.json` (Ensure it matches the `FIREBASE_CREDENTIALS` path in `.env`).

5. **Generate Application Keys:**
   ```bash
   php artisan key:generate
   php artisan jwt:secret
   ```

6. **Run Database Migrations & Symlink:**
   ```bash
   php artisan migrate
   php artisan storage:link
   ```

7. **Build Frontend Assets:**
   ```bash
   npm run build
   ```

---

## 💻 Running the Application

To start the local development server:

```bash
# Run the Laravel backend server
php artisan serve

# In a separate terminal, run the queue worker for background jobs
php artisan queue:work

# Run scheduled commands (for reminders)
php artisan schedule:work
```

Navigate to `http://127.0.0.1:8000` in your browser to access the WUDI Monitoring Dashboard.

---

## 🤖 Wudi AI Assistant Configuration

The AI Assistant utilizes Google's **Gemini 2.5 Flash** model. Ensure your `.env` contains a valid API key:
```env
GEMINI_API_KEY=your_google_gemini_api_key_here
```
The AI is configured in `app/AI/Services/WudiAiService.php`. It pulls real-time context from the dashboard metrics and logs to provide highly accurate, bullet-point summaries of your system's status.

---

## 🛡️ Security & License
- Passwords hashed with Bcrypt (12 rounds)
- Idempotent token refresh prevents concurrent 401 storms
- Input validation on all request payloads

**License:** Proprietary Software. All rights reserved.
