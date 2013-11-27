<?php

    $kernel = \AspectMock\Kernel::getInstance();

    $kernel->init([
        'debug'              => TRUE,

        // root of the app
        'appDir'             => __DIR__ . '/..',

        // cached php files
        'cacheDir'           => __DIR__ . '/_cache',

        // apply aspect on files in these directories
        'includePaths'       => [
            __DIR__ . '/../app',
            __DIR__ . '/../vendor',
        ],

        // exclude aspect (e.g. test files)
        'excludePaths'       => [
            __DIR__,
        ],

        // intercept global functions e.g. time()
        'interceptFunctions' => TRUE,
    ]);
