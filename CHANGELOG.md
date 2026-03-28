# Changelog

All notable changes to `ez-php/contracts` are documented here.

The format follows [Keep a Changelog](https://keepachangelog.com/en/1.0.0/).

---

## [v1.2.0] — 2026-03-28

### Changed
- `ExceptionHandlerInterface::render()` — second parameter type changed from `Request` to `RequestInterface`; implementations must be updated accordingly
- `MiddlewareInterface::handle()` — first parameter type changed from `Request` to `RequestInterface`; implementations must be updated accordingly
- Updated `ez-php/http` dependency constraint to `^1.2`

---

## [v1.0.1] — 2026-03-25

### Changed
- Tightened all `ez-php/*` dependency constraints from `"*"` to `"^1.0"` for predictable resolution

---

## [v1.0.0] — 2026-03-24

### Added
- `ContainerInterface` — `bind(string, mixed): void` and `make(string): mixed` for dependency injection contracts
- `ServiceProvider` — abstract base with two-phase `register()` and `boot()` lifecycle
- `ConfigInterface` — `get(string, mixed): mixed` with dot-notation key support
- `DatabaseInterface` — `query()`, `execute()`, `transaction()`, and `getPdo()` for database abstraction
- `ExceptionHandlerInterface` — `render(Throwable, Request): Response` for HTTP error handling
- `MiddlewareInterface` — `handle(Request, callable): Response` for middleware chain contracts
- `TranslatorInterface` — `get(string, array): string` for i18n abstraction
- `EzPhpException` — concrete base exception for all framework exceptions
