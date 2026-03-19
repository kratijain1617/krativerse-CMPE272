# Products/Services Cookies Lab (PHP)

This folder is a self-contained mini-site for a CMPE 272 lab.

## Lab Requirements Covered

1. Products/Services section containing **10** products/services (`products.php`)
2. Each product has its own PHP page (`product1.php` ... `product10.php`) with:
   - name
   - description
   - image
   - link back to Products/Services
3. PHP cookies track the **last 5 previously visited product pages**
4. Products page links to a page that shows last 5 (`recently_viewed.php`)
5. Extra credit: cookies track **top 5 most visited** (`most_visited.php`)

## Data + Cookie Architecture

- Product data: `includes/products_data.php`
- Cookie logic: `includes/cookie_helpers.php`
  - Uses `setcookie()` and `$_COOKIE`
  - Stores arrays using `json_encode()` / `json_decode()`
  - 30-day expiry via `time() + 60*60*24*30`
- Product pages call cookie tracking **before** any HTML output (inside `includes/product_page.php`)

## Run in XAMPP (Windows)

1. Copy the whole `lab-products-cookies/` folder into:
   - `C:\xampp\htdocs\lab-products-cookies\`
2. Start **Apache** in the XAMPP Control Panel.
3. Open in browser:
   - `http://localhost/lab-products-cookies/index.php`

## Run with PHP built-in server

From this folder:

```bash
php -S localhost:8001
```

Then open:
- `http://localhost:8001/index.php`

## Verify the Cookies

1. Open `products.php`
2. Click product pages in different order
3. Check:
   - `recently_viewed.php` shows last 5, most recent first, unique
   - `most_visited.php` shows top 5 sorted by count

