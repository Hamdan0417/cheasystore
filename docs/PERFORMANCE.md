# Performance Strategy

## Core Web Vitals Targets
- Largest Contentful Paint: ≤ 2.5s on staging baseline
- Cumulative Layout Shift: ≤ 0.1
- Time To First Byte: ≤ 0.7s (Cloudflare + optimized PHP-FPM)

## Optimization Techniques
- Tailwind for atomic CSS and Purge-based reduction
- Critical CSS inline for hero area
- Lazy load media via `loading="lazy"` defaults
- Redis object cache + page cache plugin for dynamic responses
- JS chunking with defer for theme bundles

## Monitoring
- Use Lighthouse CI in future pipeline for regressions
- Capture RUM metrics via Cloudflare Analytics or SpeedCurve integration
