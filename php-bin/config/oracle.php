<?php

return [
    'oracle' => [
        'driver'        => 'oracle',
        'tns'           => env('DB_TNS', '(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=edwp1-scan01-p.educ.gov.bc.ca)(PORT = 1521))(CONNECT_DATA =(SERVICE_NAME=edw2qry.world)))'),
        'host'          => env('DB_HOST', 'edwp1-scan01-p.educ.gov.bc.ca'),
        'port'          => env('DB_PORT', '1521'),
        'database'      => env('DB_DATABASE', 'edw2qry.world'),
        'username'      => env('DB_USERNAME', 'ESDR_WEB'),
        'password'      => env('DB_PASSWORD', ''), // NOT included in source control. Use .env file for password.  
        'charset'       => 'AL32UTF8', // WE8MSWIN1252 is the actual encoding of the DB. However, UT8 works better. ¯\_(ツ)_/¯
        'prefix'        => env('DB_PREFIX', ''),
        'prefix_schema' => env('DB_SCHEMA_PREFIX', ''),
    ],
];
