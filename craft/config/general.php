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
        'defaultImageQuality' => '65'
    ),

    // Local
    'localhost' => array(
        'devMode' => true,
        'cacheDuration' => 'PT1S',

        'siteUrl' => array(
            'en_us' => 'http://localhost/',
            'es'    => 'http://localhost/es/',
        ),

        'environmentVariables' => array(
            'basePath'  => '/Users/snetman/sites/leatherback-trust/public_html/',
            'baseUrl' => 'http://localhost/',
        )
    ),

    // Local 2
    'leatherback.dev' => array(
        'devMode' => true,
        'cacheDuration' => 'PT1S',

        'siteUrl' => array(
            'en_us' => 'http://leatherback.dev/',
            'es'    => 'http://leatherback.dev/es/',
        ),

        'environmentVariables' => array(
            'basePath'  => '/Users/snetman/sites/leatherback-trust/public_html/',
            'baseUrl' => 'http://leatherback.dev/',
        )
    ),

    // Staging
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