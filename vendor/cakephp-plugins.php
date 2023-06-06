<?php
$baseDir = dirname(dirname(__FILE__));

return [
    'plugins' => [
        'Ajax' => $baseDir . '/vendor/dereuromark/cakephp-ajax/',
        'Authentication' => $baseDir . '/vendor/cakephp/authentication/',
        'Bake' => $baseDir . '/vendor/cakephp/bake/',
        'CakePdf' => $baseDir . '/vendor/friendsofcake/cakepdf/',
        'Cake/TwigView' => $baseDir . '/vendor/cakephp/twig-view/',
        'DebugKit' => $baseDir . '/vendor/cakephp/debug_kit/',
        'EmailQueue' => $baseDir . '/vendor/lorenzo/cakephp-email-queue/',
        'Icings/Menu' => $baseDir . '/vendor/icings/menu/',
        'Josegonzalez/Upload' => $baseDir . '/vendor/josegonzalez/cakephp-upload/',
        'Migrations' => $baseDir . '/vendor/cakephp/migrations/',
        'Proffer' => $baseDir . '/vendor/davidyell/proffer/',
    ],
];
