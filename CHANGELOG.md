# Changelog

All notable changes to this project are documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [2.0.0] - 2026-09-22

### Added
- Dual compatibility for Joomla 3.10 and Joomla 4 / 5.
- Dedicated helper for SobiPro review queries, Community Builder avatars, and entry aliases.
- English and Persian administrator language files.
- Configurable SobiPro title field ID (default remains `1`).
- `CHANGELOG.md` shipped in the install package.
- Joomla Update Server declaration with SHA-256 support.

### Changed
- Module element renamed from `mod_lidapp_latestreviews` to `mod_sobipro_latest_reviews`.
- Author and copyright metadata set to AsiaSun.ir.
- Stylesheet paths are registered only when the Komento / SobiPro files exist on the site.

### Fixed
- Functions are no longer declared inside the layout file.
- Module parameters are read from `$params` instead of a second database lookup.
- Review and title output is escaped before render.

## [1.0.0] - 2014-07-29

### Notes
- Original LidApp / MB-EMPIRE Joomla 2.5 module.
