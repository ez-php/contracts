# ez-php/contracts

Shared interfaces and abstract base classes for the ez-php framework.

## Contracts

| Contract | Type | Purpose |
|---|---|---|
| `ContainerInterface` | Interface | Dependency injection: `bind()` and `make()` |
| `ServiceProvider` | Abstract class | Two-phase lifecycle: `register()` and `boot()` |
| `ConfigInterface` | Interface | Configuration access via dot-notation keys |
| `DatabaseInterface` | Interface | Database queries, transactions, PDO access |
| `ExceptionHandlerInterface` | Interface | Convert exceptions to HTTP responses |
| `EzPhpException` | Class | Base exception for framework and modules |
| `MiddlewareInterface` | Interface | HTTP middleware pipeline contract |
