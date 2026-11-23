# Blogtechu Custom Theme

Modern classic WordPress theme for TechuvaDojo, built with PHP templates, Tailwind CSS, and Vite.

## Folder Structure

```text
blogtechu-custom/
├── assets/
│   ├── css/              # Tailwind source CSS
│   ├── fonts/            # Local font files, if needed
│   ├── images/           # Theme images and icons
│   └── js/               # Vite JavaScript entry
├── dist/                 # Compiled production CSS and JS enqueued by WordPress
├── inc/                  # Theme setup, assets, helpers, patterns
├── languages/            # Translation files
├── patterns/             # Optional block pattern PHP files
├── template-parts/
│   ├── content/          # Post/page/card/empty-state templates
│   ├── layout/           # Reusable layout sections
│   └── navigation/       # Pagination and navigation pieces
├── 404.php
├── archive.php
├── comments.php
├── footer.php
├── front-page.php
├── functions.php
├── header.php
├── home.php
├── index.php
├── page.php
├── search.php
├── searchform.php
├── single.php
├── style.css             # Required WordPress theme header
├── theme.json            # Editor/global style settings
└── vite.config.js
```

## Commands

```bash
npm install
npm run build
```

WordPress loads `dist/style.css` and `dist/main.js` through `inc/enqueue.php`, so run `npm run build` after editing files in `assets/`.
