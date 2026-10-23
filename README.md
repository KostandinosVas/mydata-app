# mydata-app

Invoicing application for Greek businesses with integration to **AADE myDATA**, the Greek tax authority's electronic books platform.

Businesses issue invoices and receipts, and the app transmits them to myDATA, stores the returned identifiers (MARK, UID, QR URL), and keeps a full log of every transmission.

> **Status:** early development. The domain model is in place; invoice issuing and myDATA transmission are in progress.

## Features

**Done**
- Multi-tenant domain model: every user, customer, product and invoice series belongs to a company
- Customers with per-company VAT number uniqueness
- Products with AADE VAT categories
- Invoice series per company branch, with sequential numbering
- AADE credentials encrypted at rest and never exposed to the frontend
- Test suite and CI on every pull request

**Planned**
- Invoice issuing (sales invoices, service invoices, retail receipts, credit notes)
- Asynchronous transmission to myDATA through a queue, with retries and a transmission log
- Cancellation and correlated credit notes
- EU VAT number validation through VIES
- JSON API with token authentication
- Peppol (UBL) export

## Tech stack

| Layer | Technology |
| --- | --- |
| Backend | Laravel 12, PHP 8.5 |
| Frontend | Vue 3, TypeScript, Inertia.js, Tailwind CSS |
| Database | MariaDB 11 |
| myDATA integration | [firebed/aade-mydata](https://github.com/firebed/aade-mydata) |
| Tests | Pest |
| Code quality | Pint, Prettier, ESLint |
| Local environment | Docker via Laravel Sail |
| CI | GitHub Actions |

## Getting started

Requirements: Docker and Docker Compose. PHP and Node are not needed on the host; everything runs in containers.

```bash
git clone https://github.com/KostandinosVas/mydata-app.git
cd mydata-app

# Install PHP dependencies through a temporary container
docker run --rm -u "$(id -u):$(id -g)" -v "$(pwd):/var/www/html" -w /var/www/html \
    laravelsail/php84-composer:latest composer install --ignore-platform-reqs

cp .env.example .env
```

In `.env`, point the database to the MariaDB container:

```dotenv
DB_CONNECTION=mariadb
DB_HOST=mariadb
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=sail
DB_PASSWORD=password
```

Then start the environment:

```bash
./vendor/bin/sail up -d
./vendor/bin/sail artisan key:generate
./vendor/bin/sail artisan migrate
./vendor/bin/sail npm install
./vendor/bin/sail npm run dev
```

The app runs at http://localhost.

## Testing

```bash
./vendor/bin/sail artisan test
```

Tests run against a dedicated `testing` database in MariaDB, the same engine as the application.

## Code quality

```bash
./vendor/bin/sail pint --test        # PHP code style
./vendor/bin/sail npm run format:check  # Prettier
./vendor/bin/sail npm run lint:check    # ESLint
```

## CI

Every pull request to `main` runs two GitHub Actions workflows:

- **tests**: the full Pest suite on PHP 8.5 against a MariaDB 11 service container
- **linter**: Pint, Prettier and ESLint in check-only mode

`main` is protected: changes land only through pull requests with passing checks.

## myDATA environment

Development uses the AADE myDATA test environment. Credentials (user ID and subscription key) are stored per company and encrypted with the application key.
