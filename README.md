# Lejob.ma

[![status: draft](https://img.shields.io/badge/status-draft-orange)](https://github.com/nolongeraregistereduser/Lejob.ma)  
[![license: MIT](https://img.shields.io/badge/license-MIT-blue)](LICENSE)

Lejob.ma is a job board / recruitment marketplace built to connect employers and candidates — focused on the Moroccan market and similar francophone/north-african audiences. It combines a modern Laravel backend with a Vite + React frontend to deliver fast, interactive candidate and employer experiences.

Short tagline: "Find jobs. Hire talent. Build careers in Morocco."

---

## Quick elevator pitch (for non-technical people)

Lejob.ma helps companies post jobs, filter and shortlist candidates, and manage applicants. Candidates can create profiles, upload CVs, search and apply for jobs, and receive email updates. The platform includes admin tools to moderate content and manage listings. It’s designed to be simple for job seekers and powerful for hiring teams.

Key benefits:
- Publish and discover job listings by location, function and company.
- Manage job postings and candidate applications from an employer dashboard.
- Candidate profiles with CV upload and quick apply flow.
- Admin moderation and analytics to monitor platform health.
- Optional paid/featured listing support (placeholder included).

---

## For technical readers — overview

- Backend: Laravel 11 (PHP >= 8.2)
- Frontend: Vite + React (React 18.x)
- Styling/tools: TailwindCSS and Bootstrap, PostCSS, Sass
- Optional integrations: Stripe (stripe/stripe-php present), S3-compatible storage pattern
- Task queue / workers: Laravel queues (queue config present)
- Tests: PHPUnit / Laravel test tooling (phpunit.xml present)
- Build tooling: Vite (frontend dev & build)
- Useful files found in the repo: `composer.json`, `package.json`, `vite.config.js`, `tailwind.config.js`, `phpunit.xml`, `artisan`

The project is organized as a typical Laravel app with frontend assets managed by Vite and React components inside the resources directory.

---

## Features (high level)
- Job listings with categories and geographic locations
- Employer dashboard for creating/updating job ads
- Candidate registration/profile and CV upload
- Search and filtering (title, company, category, location)
- Email notifications (application confirmations, interview invites)
- Admin panel for moderation and analytics
- Foundations for payments / featured listings via Stripe

---

## Repo layout (what to expect)
- app/ — Laravel backend code (models, controllers, services)
- config/ — Laravel configuration
- database/ — migrations, factories, seeders
- public/ — web assets (built frontend output)
- resources/ — frontend assets, React components, views
- routes/ — Laravel routes (web, api)
- tests/ — automated tests (PHPUnit / Laravel)
- vite.config.js, tailwind.config.js — frontend build configs
- composer.json / package.json — dependencies and scripts

---

## Prerequisites (local dev)

- PHP >= 8.2
- Composer
- Node.js >= 18 (recommended for Vite 6+)
- npm (or yarn)
- A relational database (MySQL, MariaDB, or PostgreSQL)
- Optional: Redis for cache/queue, Docker if you prefer containers

---

## Environment variables

Create a `.env` in the project root (copy `.env.example` if present). Typical variables used by Laravel apps here:

- APP_NAME=Lejob
- APP_ENV=local
- APP_KEY=base64:...
- APP_URL=http://localhost:8000
- LOG_CHANNEL=stack

Database
- DB_CONNECTION=mysql
- DB_HOST=127.0.0.1
- DB_PORT=3306
- DB_DATABASE=lejob
- DB_USERNAME=root
- DB_PASSWORD=

Queue & cache (optional)
- QUEUE_CONNECTION=database or redis
- CACHE_DRIVER=file or redis
- SESSION_DRIVER=file or redis

Mail (for emails)
- MAIL_MAILER=smtp
- MAIL_HOST=smtp.example.com
- MAIL_PORT=587
- MAIL_USERNAME=
- MAIL_PASSWORD=
- MAIL_ENCRYPTION=tls
- MAIL_FROM_ADDRESS=hello@lejob.ma
- MAIL_FROM_NAME="Lejob"

Storage / external services (if used)
- AWS_S3_BUCKET=
- AWS_ACCESS_KEY_ID=
- AWS_SECRET_ACCESS_KEY=

Stripe (if using paid features)
- STRIPE_KEY=
- STRIPE_SECRET=

Adjust the variables above to reflect any `.env.example` or configuration present in the app.

---

## Local development — step-by-step

1. Clone
   - git clone https://github.com/nolongeraregistereduser/Lejob.ma.git
   - cd Lejob.ma

2. PHP dependencies
   - composer install

3. Node dependencies
   - npm install

4. Environment
   - cp .env.example .env
   - Edit `.env` and set DB and mail credentials
   - php artisan key:generate

5. Database
   - Create the database in your DB engine (MySQL/Postgres)
   - php artisan migrate
   - php artisan db:seed (if seeders exist and you want demo data)

6. Run the dev servers
   Option A — separate terminals (simple)
   - Terminal 1: php artisan serve --host=127.0.0.1 --port=8000
   - Terminal 2: npm run dev
   Visit http://127.0.0.1:8000

   Option B — concurrently (composer dev script may already run a multi-process dev workflow)
   - composer run dev
   (This repo includes dev tooling in composer.json that runs `php artisan serve` and `npm run dev` together via `concurrently`. Use whichever you prefer.)

7. Optional: run queue worker (local)
   - php artisan queue:work

---

## Build for production

1. Build frontend
   - npm run build

2. Migrate & optimize backend
   - php artisan migrate --force
   - php artisan route:cache
   - php artisan config:cache
   - php artisan view:cache

3. Deploy using your chosen stack (nginx + php-fpm, Docker, Laravel Vapor, Forge, etc.). Ensure environment variables and storage permissions are correctly set.

---

## Docker (optional)

There is no official `docker-compose.yml` in the repo. If you prefer Docker, create a small compose file with:
- PHP-FPM + Nginx service
- Database service (MySQL/Postgres)
- Node build service (or run npm install locally)
- Redis (optional)

Docker is recommended for parity between environments but is not required.

---

## Testing & quality

- Run Laravel tests (PHPUnit):
  - php artisan test
  - or vendor/bin/phpunit

- Linting / formatting:
  - Laravel Pint is included in composer dev dependencies (run via composer scripts or vendor binaries)
  - Frontend: set up ESLint / Prettier if desired (not included by default)

Continuous integration: add a GitHub Actions workflow to run tests on PRs (recommended).

---

## Security & backups

- Keep APP_KEY and secrets outside of source control.
- Use a secure mail provider for notifications.
- Perform DB backups before production migrations.
- Configure HTTPS at the server/reverse-proxy level.

---

## Contributing

Contributions are welcome. Suggested workflow:
1. Fork the repo
2. Create feature branch: git checkout -b feat/your-feature
3. Add tests for new features or bug fixes
4. Open a Pull Request describing the change
5. Ensure CI passes and include screenshots for UI changes

Please follow the existing coding style and add or update docs for notable changes.

---

## Code of Conduct

Be respectful, inclusive and constructive when interacting with maintainers and contributors. Consider adding a `CODE_OF_CONDUCT.md` file if you intend to accept external contributions.

---

## License

This project is released under the MIT License. See LICENSE.

---

## Contact / Maintainers

- Maintainers: (replace with real contact info)
- Repo: https://github.com/nolongeraregistereduser/Lejob.ma

---

## Next steps I recommend
- Add a `CONTRIBUTING.md` and `CODE_OF_CONDUCT.md`.
- Include a `.env.example` with required env keys (if missing).
- Add a simple `docker-compose.yml` for easy local setup.
- Create GitHub Actions for CI (run php artisan test and `npm run build` on PRs).
- Add screenshots or a short demo video in the README to help non-technical viewers.

If you want, I can:
- Open a PR that replaces the current README with this polished version.
- Add a starter `docker-compose.yml` and `.env.example` as a follow-up PR.
