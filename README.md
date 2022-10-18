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

## Configuration

The default configuration is given in [config/analyser.php](/config/analyser.php)

Any changes in the configuration can be added in Project `config/analyser.php` file.


## Log Clear

```
php artisan analyser:clear
```

## Log Column Info

The `analyser` table will include following columns

- `user`        (user id from auth)
- `route`       (uri called in raw format i.e. `/path/{param_variable_name}`
- `method`      (GET, POST)
- `params`      (Route parameters variable with value in JSON format)
- `referer`     (Referer in Header of request)
- `host`        (Host from which route is called)
- `sqlcalls`    (No of sql calls made during execution of request)
- `sqltime`     (Total time taken by sql queries in milliseconds)
- `starttime`   (datetime at start of request execution)
- `endtime`     (datetime at end of request execution)
- `status`      (Status of the response 0 = failed before response; 1 = sucess (i.e 200 response); -1 = fail)
- `time`        (Total time for execution of request in seconds)