# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [1.2.0] - 2025-XX-XX

### Added

- New system configuration option that allows selection of the active admin theme from those installed

### Changed

- Theme selector plugin now reads from the new system configuration value
- Default config values (`etc/config.xml`) now reference the new system configuration value

### Removed

- Existing system configuration to enable/disable the Mage-OS admin theme

## [1.1.1] - 2025-04-29

### Changed

- Theme selector plugin now returns early if not in admin scope, including when using emulation

## [1.1.0] - 2025-04-15

### Changed

- Corrected composer package name in README.md

## [1.0.0] - 2025-04-08

### Added

- Configuration to Enable M137 Admin Theme
- Module Init
