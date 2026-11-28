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
2. Create a database for the site. Existing pages, posts, settings, and user
   accounts are not restored by cloning alone; restore a private backup as
   described below.
3. Copy `wp-config-sample.php` to `wp-config.php` and enter your local database
   credentials. Generate unique WordPress keys and salts for the environment.
   `wp-config.php` is intentionally ignored by Git.
4. Configure the local web server to use this directory as its document root,
   then complete or connect the WordPress installation.
5. In WordPress Admin, activate **TechuvaDojo** under **Appearance > Themes**.

## Back up and restore site data

The Git repository contains the site code, not the live database or uploaded
media. To make a complete migration backup, start the site in Local and run
these commands from the site root using Local's site shell (with WP-CLI
available):

```sh
mkdir -p migration-backups
wp db export migration-backups/site.sql
tar -czf migration-backups/uploads.tar.gz -C wp-content uploads
```

The SQL file contains site content, settings, and user accounts. Keep both
backup files private and transfer them separately from GitHub. The
`migration-backups/` directory is ignored by Git and must not be committed.

On the destination system:

1. Clone this repository, create an empty database, and configure
   `wp-config.php` with its credentials. Keep the table prefix consistent with
   the source site's database.
2. Copy the two backup files into `migration-backups/`, then run from the site
   root:

   ```sh
   wp db import migration-backups/site.sql
   tar -xzf migration-backups/uploads.tar.gz -C wp-content
   ```

3. Replace the source site URL with the destination URL using WP-CLI so
   serialized WordPress data is handled correctly, then refresh permalinks:

   ```sh
   wp search-replace 'https://source.example' 'https://destination.example' --all-tables --skip-columns=guid
   wp rewrite flush
   ```

   Substitute the actual source and destination URLs. Sign in with an account
   from the imported database.

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
- `migration-backups/` (private database and media exports)
- `node_modules/`, WordPress upgrade/cache directories, and `.DS_Store`

Never commit database exports, user data, database credentials, or private
keys.
