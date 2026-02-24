# Echo Creative Studio - Company Website

A professional company website for **Echo Creative Studio**, a video production and creative media agency.

## Company Overview

**Echo Creative Studio** is a full-service creative agency specializing in:
- Video production (commercials, documentaries, corporate films)
- Photography (product, events, branding)
- Brand design and motion graphics
- Digital and social media content

## Website Sections

| Page | URL | Description |
|------|-----|-------------|
| **Home** | `index.php` | Main landing page with hero, features, and call-to-action |
| **About** | `about.php` | Company story, mission, values, and statistics |
| **Products & Services** | `products.php` | Services offered (Video, Photography, Branding, Digital Content) |
| **News** | `news.php` | Latest company news, awards, and announcements |
| **Contact** | `contacts.php` | Company and team contacts loaded from text files via PHP |

## Contact Data (PHP + Text Files)

Contacts are stored in text files and read dynamically using PHP:

- **`data/company_contacts.txt`** — Main company address, phone, email, and business hours
- **`data/team_contacts.txt`** — Team members with format: `Department|Name|Email|Phone|Title`

To update contacts, simply edit these text files — no code changes required.

## Requirements

- PHP 7.4 or higher
- Web server (Apache, Nginx, or PHP built-in server)

## Local Development

### Using PHP Built-in Server

```bash
php -S localhost:8000
```

Then open [http://localhost:8000](http://localhost:8000) in your browser.

### Using XAMPP / WAMP / MAMP

Copy the project into your `htdocs` (or equivalent) folder and access via your local server URL.

## File Structure

```
├── index.php          # Home page
├── about.php          # About page
├── products.php       # Products & Services page
├── news.php           # News page
├── contacts.php       # Contact page (reads from data/*.txt)
├── includes/
│   ├── header.php     # Shared header/navigation
│   └── footer.php     # Shared footer
├── css/
│   └── style.css      # Styles
├── js/
│   └── main.js        # Mobile menu toggle
├── data/
│   ├── company_contacts.txt  # Company contact info
│   └── team_contacts.txt     # Team contact directory
└── README.md
```

## Deployment

Upload all files to your web hosting root (e.g., `public_html`). Ensure:
- PHP is enabled
- The `data/` folder has read permissions for the web server
