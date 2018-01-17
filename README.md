# flarum-ext-redis-session
Redis session handler for Flarum

## Settings
- host
- port
- db
- password - leave empty for no auth
- locking
- prefix - redis key prefix (default: "session:")
- ttl - session ttl
- spin_lock_wait
- connection_parameters - serialized array of Predis Client connection parameters
- client_options - serialized array of Predis Client options
- handler_options - serialized array of Session Storage Handler options
- storage_options - serialized array of Session Storage options
