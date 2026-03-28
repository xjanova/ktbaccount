# Changelog

All notable changes to the KTB Account project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.0.0] - 2026-03-28

### Added

- Multi-tenant Village Fund Management system (ระบบบริหารกองทุนหมู่บ้าน)
- Tenant-scoped data isolation with TenantScope global scope
- Cash-basis accounting with 5-digit account codes and calendar year fiscal periods
- Member management with loan and savings tracking
- Transaction recording with journal entries and ledger reports
- LINE OA integration for per-tenant notifications via LINE Messaging API
- Role-based access control (admin, committee, member)
- Thai language UI with localization support
- API authentication via Laravel Sanctum
- Session-based web authentication
- Responsive dashboard with Tailwind CSS 4 and Alpine.js
- Flutter Android mobile application with auto-update via GitHub Releases
- CI/CD pipeline with automated testing, deployment, and releases
- Health check endpoint at /api/health

[1.0.0]: https://github.com/xjanova/ktbaccount/releases/tag/v1.0.0
