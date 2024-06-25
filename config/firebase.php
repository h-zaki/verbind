<?php

require dirname(__DIR__) . '/vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\Auth;

$serviceAccount = __DIR__ . '/serviceAccountKey.json';

$factory = (new Factory)
    ->withServiceAccount($serviceAccount);

$auth = $factory->createAuth();


