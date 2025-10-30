# Security Checklist

## WordPress Hardening
- Enforce 2FA for administrators via security plugin (TOTP)
- Disable `xmlrpc.php` and reduce login attempts (theme hook)
- Apply strict roles; editors cannot install plugins

## Headers & TLS
- Managed via Cloudflare WAF: HSTS, CSP with script/style hashes, Referrer Policy
- Theme sets baseline headers for same-origin framing and MIME sniffing protection

## Infrastructure
- Redis AUTH enabled, limited to internal network
- Automated nightly backups to S3-compatible storage
- Monitor with WP Activity Log and server audit trails

## Web3 Considerations
- Validate RPC endpoints via allowlist
- Store transaction hashes as order meta only
- Plan for chain reorg handling by monitoring confirmations (configurable)
