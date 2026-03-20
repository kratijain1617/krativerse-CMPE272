# CURL Lab - Your Part (Company A)

## What You Built

1. **Local database** (`data/company_a.db`) — SQLite with `list_of_users_A`
2. **API endpoint** (`api/users.php`) — Returns your users as JSON (others CURL this)
3. **Aggregated page** (`list_all_users.php`) — Shows users from A (local DB) + B & C (via CURL)

## Share With Teammates

**Your API URL** (they add this to their config and CURL it):

```
https://your-site.com/api/users.php
```

For local testing: `http://localhost:8000/api/users.php`

**Expected response format** (so they can match it):

```json
{
  "company": "A",
  "company_name": "Echo Creative Studio (A)",
  "users": [
    {"id": 1, "name": "Mary Smith", "email": "mary.smith@email.com", "department": "Marketing"}
  ]
}
```

## What Teammates Must Provide

Update `config/companies_config.php` with their real URLs:

```php
define('COMPANY_B_API_URL', 'https://company-b-actual-url.com/api/users.php');
define('COMPANY_C_API_URL', 'https://company-c-actual-url.com/api/users.php');
```

## API Contract (for B and C)

Each company needs an `api/users.php` that returns:

- `Content-Type: application/json`
- `Access-Control-Allow-Origin: *` (or specific origins) if cross-domain
- JSON: `{"company":"X","company_name":"...","users":[{"id":...,"name":"...","email":"...","department":"..."}]}`
