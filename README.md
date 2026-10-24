# ez-php/contracts

Shared interfaces and abstract base classes for the ez-php framework.

## Installation

```bash
composer require ez-php/contracts
```

You rarely need to require it directly: `ez-php/framework` and every module that implements
or consumes these contracts already depend on it. Require it explicitly when writing your own
package against the contracts without pulling in the framework.

## Contracts

| Contract | Type | Purpose |
|---|---|---|
| `ContainerInterface` | Interface | Dependency injection: `bind()`, `make()`, `has()`, `instance()` |
| `ServiceProvider` | Abstract class | Two-phase lifecycle: `register()` and `boot()`; `deferred()`/`provides()` make it lazy — the kernel then skips it at bootstrap and runs `register()` + `boot()` on the first resolution (direct or autowired) of a `provides()` class |
| `ConfigInterface` | Interface | Configuration access via dot-notation keys |
| `DatabaseInterface` | Interface | Database queries, transactions, PDO access |
| `ExceptionHandlerInterface` | Interface | Convert exceptions to HTTP responses |
| `MiddlewareInterface` | Interface | HTTP middleware pipeline contract |
| `ParameterizedMiddlewareInterface` | Interface | Middleware taking per-registration string parameters (`'can:update,App\Post'`) |
| `CommandRegistryInterface` | Interface | Console command registration: `registerCommand()`, `getCommands()` |
| `TaggedContainerInterface` | Interface | Service tagging: `tag()`, `tagged()` — implemented by the framework `Container` |
| `TranslatorInterface` | Interface | Translate keys with placeholder replacements |
| `JobInterface` | Interface | Queue job contract: `handle()`, `fail()`, attempt/retry accessors |
| `QueueInterface` | Interface | Queue driver contract: `push()`, `pop()`, `size()`, `failed()` |
| `RepositoryInterface` | Interface | Generic repository: `find()`, `save()`, `delete()` |
| `RouterInterface` | Interface | Route registration: `get()`, `post()`, `put()`, `patch()`, `delete()`, `toCache()` — implemented by the framework `Router` (bound by `RouterServiceProvider`), so route-registering modules need not depend on `ez-php/framework` |
| `Schema\SchemaInterface` | Interface | Schema builder contract: `create()`, `table()`, `drop()`, `dropIfExists()`, `hasTable()`, `hasColumn()`, `rename()` |
| `EzPhpException` | Class | Base exception for framework and modules |
| `GateInterface` | Interface | Authorization check `allows(ability, subject)` — implemented by `ez-php/authorization`'s `Gate`, used by the framework's `Controller::authorize()` |
| `SecondFactorResult` | Enum | Shared `Satisfied`/`NotSatisfied`/`NotConfigured` outcome for second-factor verifier modules (e.g. `ez-php/two-factor`, `ez-php/webauthn`) |
