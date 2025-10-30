# SEO Playbook

## Meta Strategy
- Generate titles from templates: `{brand} {product} best price | Cheasy`
- Description fallback uses short description or category copy trimmed to 155 characters
- Canonical URLs automatically set via WordPress core filters

## Schema Coverage
- Product schema for PDP
- Organization schema for default pages
- FAQ schema for FAQ template
- Breadcrumbs rely on WooCommerce built-ins

## Sitemap & Robots
- Use core WP sitemaps; enhance via filters to include WooCommerce taxonomy
- `robots.txt` served via Cloudflare rules referencing staging/production toggles

## Content Guidelines
- Use blog templates for guides, comparisons, and best-of lists
- Encourage unique copy for imported products via AliDropship adjustments
