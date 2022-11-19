<?php

return [
    /*
     |--------------------------------------------------------------------------
     | Analyser Settings
     |--------------------------------------------------------------------------
     |
     | Analyser is disabled by default
     | You can override the value by setting enable to true or false instead of null.
     |
     */

    'enabled' => env('ANALYSER_ENABLED', false),

    'middleware_groups' => ['web','api'],

    /*
     |--------------------------------------------------------------------------
     | DataCollectors
     |--------------------------------------------------------------------------
     |
     | Enable/disable DataCollectors
     |
     */

    'collectors'=> [
        'user'      => true,  // user id from auth
        'route'     => true,  // uri called
        'method'    => true,  // GET, POST
        'params'    => true,  // Route parameters
        'referer'   => true,  // Referer in Header of request
        'host'      => true,  // Host from which route is called
        'sqlcalls'  => true,  // No of sql calls made during execution of request
        'sqltime'   => true,  // Total time taken by sql queries
        'starttime' => true,  // datetime at start of request execution
        'endtime'   => true,  // datetime at end of request execution
        'status'    => true,  // Status of the response 0 = failed before response; 1 = sucess (i.e 200 response); -1 = fail
        'time'      => true,  // Total time for execution of request in milliseconds
    ],

    'connection' => 'mysql'

];