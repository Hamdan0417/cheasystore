# Runbooks

## Deploy to Staging
1. Push branch and open PR
2. Merge to `main` or trigger `Deploy Staging` workflow manually
3. Ensure secrets `STAGING_HOST`, `STAGING_USER`, `STAGING_SSH_KEY`, `STAGING_PATH` are configured
4. Workflow builds Tailwind assets, syncs files, and activates required plugins

## Clear Caches
- Redis: `wp redis flush` via WP-CLI
- Page cache plugin (to be selected) via WP-CLI command e.g. `wp cache flush`
- Cloudflare: purge zone cache for affected URLs

## Rollback
1. Use Git tags per release to revert quickly
2. Re-run deploy workflow pointing to previous commit or restore backup from S3
3. Flush caches to propagate rollback

## Webhook Diagnostics
- TAP: verify webhook secret and delivery logs in TAP dashboard
- Crypto: inspect REST `/cheasy-web3/v1/transactions` logs via server access log
