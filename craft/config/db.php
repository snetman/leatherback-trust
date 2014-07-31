<?php

/**
 * Database Configuration
 *
 * All of your system's database configuration settings go in here.
 * You can see a list of the default settings in craft/app/etc/config/defaults/db.php
 */

return array(
  '*' => array(
    'tablePrefix' => 'craft',
  ),
  'localhost' => array(
    'server' => 'localhost',
    'user' => 'root',
    'password' => 'root',
    'database' => 'av01875leatherback',
  ),
  'leatherback.dev' => array(
    'server' => 'localhost',
    'user' => 'root',
    'password' => 'root',
    'database' => 'av01875leatherback',
  ),
  'staging.leatherback.org' => array(
    'server' => 'localhost',
    'user' => 'av01875',
    'password' => '7E.er4EdnSer',
    'database' => 'av01875leatherback',
  ),
  '216.243.143.149' => array(
    'server' => 'localhost',
    'user' => 'av01875',
    'password' => '7E.er4EdnSer',
    'database' => 'av01875leatherback',
  ),
);