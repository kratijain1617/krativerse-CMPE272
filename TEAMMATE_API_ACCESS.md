# Allow API Access for CURL Lab (Share with Teammates)

If your host returns an HTML page (e.g. Cloudflare "Checking your browser") instead of JSON when other teams CURL your `api/users.php`, they cannot fetch your users.

## For Geeshitha / Nexus Academy (geeshitha.com)

### Option 1: Cloudflare (if using Cloudflare)

1. Log in to Cloudflare dashboard
2. Select **geeshitha.com**
3. Go to **Security** → **WAF** or **Page Rules**
4. Add a rule to **skip** or **disable** bot protection for:
   - URL: `*geeshitha.com/nexus_academy/api/*`
   - Or: `*geeshitha.com/nexus_academy/api/users.php`
5. Set **Security Level** to "Essentially Off" for that path, or add an exception for server-side requests

### Option 2: .htaccess (Apache)

If your host uses Apache and supports mod_headers, add to `nexus_academy/api/.htaccess`:

```apache
<IfModule mod_headers.c>
    Header set Access-Control-Allow-Origin "*"
    Header set X-Robots-Tag "noindex"
</IfModule>
```

(This helps with CORS; it may not fix Cloudflare blocking.)

### Option 3: Ensure api/users.php outputs only JSON

Add at the very top of `api/users.php` (before any other output):

```php
<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
// Prevent any output buffering from adding HTML
if (ob_get_level()) ob_end_clean();
// ... rest of your code
```

### Option 4: Contact your hosting provider

Ask them to whitelist server-to-server (CURL) requests to `/nexus_academy/api/users.php` or disable bot/challenge pages for that path.

---

**Expected API response format:**
```json
{"company_name":"Company A","users":[{"id":"1","name":"...","email":"...","role":"..."}]}
```
