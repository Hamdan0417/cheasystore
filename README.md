# Cheasy Store Platform

Custom WooCommerce implementation for the Cheasy dropshipping storefront with AliExpress-inspired merchandising, crypto checkout, and automated SEO.

## Requirements
- Node.js 20+
- PHP 8.1+
- WordPress 6.8.x with WooCommerce latest

## Getting Started
```bash
git clone https://github.com/Hamdan0417/cheasystore
cd cheasystore
cp .env.example .env
npm install
npm run dev
```

Sync theme and plugins into your WordPress installation (Git deploy or manual upload). Activate:
- Theme: `cheasy`
- Child Theme: `cheasy-child` (optional overrides)
- Plugins: `cheasy-web3`, `cheasy-seo-gen`

## Packages
- **cheasy theme**: Tailwind-powered storefront components
- **cheasy-web3 plugin**: Wallet login and crypto checkout gateway
- **cheasy-seo-gen plugin**: Meta + schema generators

## Deployments
Use GitHub Actions workflow `Deploy Staging` to sync to staging once secrets are configured. See `docs/RUNBOOKS.md` for details.

## Development Notes
- Tailwind input file: `wp-content/themes/cheasy/src/main.css`
- JS entrypoints live in `wp-content/themes/cheasy/assets/js`
- Web3 scripts located under `wp-content/plugins/cheasy-web3/includes/js`

## License
Proprietary – Cheasy Labs internal project.
