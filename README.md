# ez-php/contracts

Shared interfaces and abstract base classes for the ez-php framework.

## Contracts

| Contract | Type | Purpose |
|---|---|---|
| `ContainerInterface` | Interface | Dependency injection: `bind()`, `make()`, `has()`, `instance()` |
| `ServiceProvider` | Abstract class | Two-phase lifecycle: `register()` and `boot()` |
| `ConfigInterface` | Interface | Configuration access via dot-notation keys |
| `DatabaseInterface` | Interface | Database queries, transactions, PDO access |
| `ExceptionHandlerInterface` | Interface | Convert exceptions to HTTP responses |
| `MiddlewareInterface` | Interface | HTTP middleware pipeline contract |
| `CommandRegistryInterface` | Interface | Console command registration: `registerCommand()`, `getCommands()` |
| `TranslatorInterface` | Interface | Translate keys with placeholder replacements |
| `JobInterface` | Interface | Queue job contract: `handle()`, `fail()`, attempt/retry accessors |
| `QueueInterface` | Interface | Queue driver contract: `push()`, `pop()`, `size()`, `failed()` |
| `RepositoryInterface` | Interface | Generic repository: `find()`, `save()`, `delete()` |
| `Schema\SchemaInterface` | Interface | Schema builder contract: `create()`, `table()`, `drop()`, `dropIfExists()`, `hasTable()`, `hasColumn()`, `rename()` |
| `EzPhpException` | Class | Base exception for framework and modules |
| `SecondFactorResult` | Enum | Shared `Satisfied`/`NotSatisfied`/`NotConfigured` outcome for second-factor verifier modules (e.g. `ez-php/two-factor`, `ez-php/webauthn`) |
