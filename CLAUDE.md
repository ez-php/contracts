# Coding Guidelines

Applies to the entire ez-php project — framework core, all modules, and the application template.

---

## Environment

- PHP **8.5**, Composer for dependency management
- All project based commands run **inside Docker** — never directly on the host

```
docker compose exec app <command>
```

Container name: `ez-php-app`, service name: `app`.

---

## Quality Suite

Run after every change:

```
docker compose exec app composer full
```

Executes in order:
1. `phpstan analyse` — static analysis, level 9, config: `phpstan.neon`
2. `php-cs-fixer fix` — auto-fixes style (`@PSR12` + `@PHP83Migration` + strict rules)
3. `phpunit` — all tests with coverage

Individual commands when needed:
```
composer analyse   # PHPStan only
composer cs        # CS Fixer only
composer test      # PHPUnit only
```

**PHPStan:** never suppress with `@phpstan-ignore-line` — always fix the root cause.

---

## Coding Standards

- `declare(strict_types=1)` at the top of every PHP file
- Typed properties, parameters, and return values — avoid `mixed`
- PHPDoc on every class and public method
- One responsibility per class — keep classes small and focused
- Constructor injection — no service locator pattern
- No global state unless intentional and documented

**Naming:**

| Thing | Convention |
|---|---|
| Classes / Interfaces | `PascalCase` |
| Methods / variables | `camelCase` |
| Constants | `UPPER_CASE` |
| Files | Match class name exactly |

**Principles:** SOLID · KISS · DRY · YAGNI

---

## Workflow & Behavior

- Write tests **before or alongside** production code (test-first)
- Read and understand the relevant code before making any changes
- Modify the minimal number of files necessary
- Keep implementations small — if it feels big, it likely belongs in a separate module
- No hidden magic — everything must be explicit and traceable
- No large abstractions without clear necessity
- No heavy dependencies — check if PHP stdlib suffices first
- Respect module boundaries — don't reach across packages
- Keep the framework core small — what belongs in a module stays there
- Document architectural reasoning for non-obvious design decisions
- Do not change public APIs unless necessary
- Prefer composition over inheritance — no premature abstractions

---

## New Modules & CLAUDE.md Files

### 1 — Required files

Every module under `modules/<name>/` must have:

| File | Purpose |
|---|---|
| `composer.json` | package definition, deps, autoload |
| `phpstan.neon` | static analysis config, level 9 |
| `phpunit.xml` | test suite config |
| `.php-cs-fixer.php` | code style config |
| `.gitignore` | ignore `vendor/`, `.env`, cache |
| `.github/workflows/ci.yml` | standalone CI pipeline |
| `README.md` | public documentation |
| `tests/TestCase.php` | base test case for the module |
| `start.sh` | convenience script: copy `.env`, bring up Docker, wait for services, exec shell |
| `CLAUDE.md` | see section 2 below |

### 2 — CLAUDE.md structure

Every module `CLAUDE.md` must follow this exact structure:

1. **Full content of `CODING_GUIDELINES.md`, verbatim** — copy it as-is, do not summarize or shorten
2. A `---` separator
3. `# Package: ez-php/<name>` (or `# Directory: <name>` for non-package directories)
4. Module-specific section covering:
   - Source structure — file tree with one-line description per file
   - Key classes and their responsibilities
   - Design decisions and constraints
   - Testing approach and infrastructure requirements (MySQL, Redis, etc.)
   - What does **not** belong in this module

### 3 — Docker scaffold

Run from the new module root (requires `"ez-php/docker": "0.*"` in `require-dev`):

```
vendor/bin/docker-init
```

This copies `Dockerfile`, `docker-compose.yml`, `.env.example`, `start.sh`, and `docker/` into the module, replacing `{{MODULE_NAME}}` placeholders. Existing files are never overwritten.

After scaffolding:

1. Adapt `docker-compose.yml` — add or remove services (MySQL, Redis) as needed
2. Adapt `.env.example` — fill in connection defaults matching the services above
3. Assign a unique host port for each exposed service (see table below)

**Allocated host ports:**

| Package | `DB_HOST_PORT` (MySQL) | `REDIS_PORT` |
|---|---|---|
| root (`ez-php-project`) | 3306 | 6379 |
| `ez-php/framework` | 3307 | — |
| `ez-php/orm` | 3309 | — |
| `ez-php/cache` | — | 6380 |
| **next free** | **3310** | **6381** |

Only set a port for services the module actually uses. Modules without external services need no port config.

---

# Package: ez-php/contracts

Shared interfaces and abstract base classes for the ez-php framework. Zero production dependencies beyond PHP, ext-pdo, and ez-php/http. Enables modules to decouple from ez-php/framework.

---

## Source Structure

```
src/
├── ContainerInterface.php        — bind() + make(); implemented by Application
├── ServiceProvider.php           — Abstract base with ContainerInterface $app; modules extend this
├── ConfigInterface.php           — get(key, default): mixed; implemented by Config
├── DatabaseInterface.php         — query() + transaction() + getPdo(); implemented by Database
├── ExceptionHandlerInterface.php — render(Throwable, Request): Response; implemented by DefaultExceptionHandler
├── EzPhpException.php            — Base exception extending RuntimeException
└── MiddlewareInterface.php       — handle(Request, callable): Response; implemented by all middleware

tests/
├── TestCase.php                  — Base PHPUnit test case
└── ContractsSmokeTest.php        — Verifies all contracts exist and are usable
```

---

## Key Classes and Responsibilities

### ContainerInterface

Only two methods: `bind()` and `make()`. Intentionally minimal — PSR-11 only has `get()`/`has()` which is not enough for module ServiceProviders that need to register bindings.

### ServiceProvider

Abstract base class. `$app` is typed as `ContainerInterface` so modules can extend it without depending on `ez-php/framework`. Two-phase lifecycle: `register()` (bind services) and `boot()` (use services).

### DatabaseInterface

Covers the three operations the ORM needs: `query()` for SELECT, `transaction()` for DML, and `getPdo()` for raw access in schema operations.

### ExceptionHandlerInterface

Depends on `ez-php/http` for `Request` and `Response` — acceptable since `ez-php/http` is already framework-free.

---

## Design Decisions and Constraints

- **No logic** — Only interfaces and one thin base class (`ServiceProvider`). No implementation anywhere.
- **`ContainerInterface::bind()` returns `void`** — No fluent interface in the contract. The Application's builder pattern (returning `$this`) is application-level, not a contract requirement.
- **`EzPhpException` is concrete** — Modules instantiate it directly or extend it. Making it abstract would break callers that throw it without subclassing.
- **`ez-php/http` as a dependency** — `ExceptionHandlerInterface` and `MiddlewareInterface` both reference `Request` and `Response`. Since `ez-php/http` is already zero-dependency, this is an acceptable dependency.
- **No PSR-11** — PSR-11 only provides `get()`/`has()`. Module ServiceProviders also need `bind()`. Extending PSR-11 would add a Composer dependency for marginal gain.

---

## Testing Approach

- No infrastructure required.
- Tests verify contracts exist as interfaces/abstract classes and that `ServiceProvider` can be extended.
- `EzPhpException` tested for instantiation and message passing.

---

## What Does NOT Belong Here

| Concern | Where it belongs |
|---|---|
| Concrete implementations | `ez-php/framework` or individual modules |
| `Application`, `Container`, `Router` | `ez-php/framework` |
| `Request`, `Response` | `ez-php/http` |
| `CommandInterface` | `ez-php/console` |
| Module-specific interfaces | Individual module packages |

