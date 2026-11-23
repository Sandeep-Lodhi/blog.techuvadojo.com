# blog.techuvadojo.com

WordPress source for the TechuvaDojo website. This repository contains the
WordPress application files and the custom `TechuvaDojo` theme.

## Repository contents

- `wp-admin/`, `wp-includes/`, and the root PHP files: WordPress core
- `wp-content/themes/blogtechu-custom/`: the custom site theme and its source
  assets
- `refrence/`: design/reference images and service, blog, and news planning
  notes (the folder name is kept as it exists in the project)
- `wp-config-sample.php`: example WordPress configuration

## Requirements

- PHP and MySQL or MariaDB, supported by the included WordPress version
- A web server configured to serve this directory, such as Apache or Nginx
- Node.js and npm to rebuild the theme's CSS and JavaScript

## Local setup

1. Clone this repository into your local web server's document root.
2. Create a database for the site. This repository does not include a database
   export, so existing pages, posts, settings, and user accounts are not
   restored by cloning alone.
3. Copy `wp-config-sample.php` to `wp-config.php` and enter your local database
   credentials. Generate unique WordPress keys and salts for the environment.
   `wp-config.php` is intentionally ignored by Git.
4. Configure the local web server to use this directory as its document root,
   then complete or connect the WordPress installation.
5. In WordPress Admin, activate **TechuvaDojo** under **Appearance > Themes**.

## Theme assets

The theme's compiled files are in
`wp-content/themes/blogtechu-custom/dist/`. To rebuild them after changing the
theme source:

```bash
cd wp-content/themes/blogtechu-custom
npm install
npm run build
```

For Vite's development server, run `npm run dev` from the same directory.

## Files not included

The root `.gitignore` excludes environment-specific or generated files,
including:

- `wp-config.php` and local diagnostics
- `wp-content/uploads/` (site media)
- `node_modules/`, WordPress upgrade/cache directories, and `.DS_Store`

Back up the database and uploads separately if you need a complete site
migration; do not commit database credentials or private keys.
