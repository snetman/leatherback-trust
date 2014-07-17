<?php

/**
 * General Configuration
 *
 * All of your system's general configuration settings go in here.
 * You can see a list of the default settings in craft/app/etc/config/defaults/general.php
 */

return array(
    '*' => array(
        'omitScriptNameInUrls' => true,
        'defaultImageQuality' => '100'
    ),

    // Local
    'localhost' => array(
        'devMode' => true,
        'cacheDuration' => 'PT1S',

        'siteUrl' => array(
            'en_us' => 'http://localhost:8888/',
            'es'    => 'http://localhost:8888/es/',
        ),

        'environmentVariables' => array(
            'basePath'  => '/Users/snetman/sites/leatherback-trust/public_html/',
            'baseUrl' => 'http://localhost:8888/',
        )
    ),

    // Staging
    // I can use 'staging' here instead of a url because of a setting in my index.php file
    'staging.leatherback.org' => array(
        'cooldownDuration' => 0,

        'siteUrl' => array(
            'en_us' => 'http://staging.leatherback.org/',
            'es'    => 'http://staging.leatherback.org/es/',
        ),

        'environmentVariables' => array(
            'basePath'  => '/storage/av01875/www/public_html/',
            'baseUrl' => 'http://staging.leatherback.org/',
        )
    ),

    // Production
    // I can use 'production' here instead of a url because of a setting in my index.php file
    '216.243.143.149' => array(
        'cooldownDuration' => 0,

        'siteUrl' => array(
            'en_us' => 'http://216.243.143.149/',
            'es'    => 'http://216.243.143.149/es/',
        ),

        'environmentVariables' => array(
            'basePath'  => '/storage/av01875/www/public_html/',
            'baseUrl' => 'http://216.243.143.149/',
        )
    )
);