# Cringila General Medical Practice (CGMP) — Website Redevelopment

Repo: [github.com/munim456/Project101](https://github.com/munim456/Project101)

Laravel 12 rebuild of the CGMP website: public marketing site, blog, and a
custom admin CMS so the client can edit all content without touching code.
HealthEngine handles bookings — no custom booking engine.

## Requirements

- PHP 8.2+ with the **GD or Imagick extension enabled** (required by
  Intervention Image for upload resizing/compression — without it, every
  image upload in the admin fails with `DriverException`)
- Composer 2.x
- MySQL 8.x or MariaDB 10.4+
- Node 18+ / npm

## Local setup

```bash
git clone https://github.com/munim456/Project101.git cgmp
cd cgmp
composer install
npm install
cp .env.example .env
php artisan key:generate
```

Edit `.env` with your database credentials (`DB_DATABASE=cgmp` etc.), then:

```bash
php artisan migrate --seed
php artisan storage:link
npm run build        # or `npm run dev` while developing
php artisan serve
```

Visit `http://127.0.0.1:8000`. Admin panel at `/admin`.

**Seeded admin login:** set by `ADMIN_EMAIL` / `ADMIN_PASSWORD` in `.env`
(defaults to `admin@cgmp.test` / `password` if unset — override this in
every environment, including local).

## What's seeded

`php artisan migrate --seed` populates: the admin user, both doctors (Dr
Homayera Noor, Dr Muhammad Iqbal), the four homepage services, the mask
health notice, site settings (clinic details, placeholder HealthEngine URL),
static Privacy Policy/Terms pages, blog categories, and one demo blog post.
Replace the placeholders (HealthEngine URL, clinic phone, clinic photos)
with real values from the admin dashboard before launch.

## Key structure

- `routes/web.php` — public routes; `routes/admin.php` — admin routes
  (behind `auth` + `admin` middleware)
- `app/Models/Setting.php` — key/value site settings (`Setting::get('key')`)
- `app/Models/Section.php` — flexible JSON content blocks (hero, about)
- `app/Support/ImageUploader.php` — resizes + converts uploads to WebP
- `resources/views/layouts/site.blade.php` — public layout;
  `resources/views/layouts/admin.blade.php` — admin layout

## Before production launch

- Enable the GD (or Imagick) PHP extension on the production server
- Set real SMTP credentials in `.env` (`MAIL_MAILER=smtp` + client's provider)
- Run `php artisan config:cache route:cache view:cache` as part of deploy
- Replace the HealthEngine URL, clinic contact details, and doctor/clinic
  photos via the admin dashboard
- Change or remove the seeded admin password
