# Performance Analyser
Locate the routes taking too much time to respond

## Installation
```
composer require aditya/performance-analyser
```

## Enable Analyser
Add following in `.env` file
```
ANALYSER_ENABLED=true
```

## Migration
Migrate the migrations after installation
```
php artisan migrate
```

Check `analyser` table in mysql