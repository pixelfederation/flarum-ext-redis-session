# flarum-ext-redis-session
Redis session handler for Flarum

## Installation
```
composer require pixelfederation/flarum-ext-redis-session
```

## Settings
- host
- port
- db
- password
    - leave empty for no auth
- locking
- prefix
    - redis key prefix (default: "session:")
- ttl
    - session ttl
- spin_lock_wait
- connection_parameters
    - serialized array of Predis Client connection parameters
    - **these parameters override "host", "port", "db", "password"**
- client_options
    - serialized array of Predis Client options
- handler_options
    - serialized array of Session Storage Handler options
- storage_options
    - serialized array of Session Storage options

## Warning
After enable this extension at admin, you will get error because of wrong configured redis connection.
**You must set it directly at database.**
