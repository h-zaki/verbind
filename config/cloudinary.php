<?php


require dirname(__DIR__) . '/vendor/autoload.php';

// Use the Configuration class 
use Cloudinary\Configuration\Configuration;

// Configure an instance of your Cloudinary cloud
Configuration::instance([
    'cloud' => [
        'cloud_name' => 'dg1vm1zpr',
        'api_key' => '493722868355542',
        'api_secret' => 'VTy2TGrN1Ba48zrdcm3eGOy5N-o',
    ],
]);