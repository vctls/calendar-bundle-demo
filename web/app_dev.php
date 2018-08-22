<?php

use Symfony\Component\Debug\Debug;
use Symfony\Component\HttpFoundation\Request;

// If you don't want to setup permissions the proper way, just uncomment the following PHP line
// read https://symfony.com/doc/current/setup.html#checking-symfony-application-configuration-and-setup
// for more information
//umask(0000);

// Paramètres d'environnement qui doivent être définis avant le chargement du conteneur.
// Créez un fichier env.php dans app/config/ à partir de l'exemple
// env.php.dist pour surcharger ces paramètres localement.
$cacheDir = null;
$logDir = null;
$trustedIPs = array('127.0.0.1', '::1');
$envFile = __DIR__.'/../app/config/env.php';
if (file_exists($envFile)) {
    include $envFile;
}

// This check prevents access to debug front controllers that are deployed by accident to production servers.
// Feel free to remove this, extend it, or make something more sophisticated.
if (isset($_SERVER['HTTP_CLIENT_IP'])
    || isset($_SERVER['HTTP_X_FORWARDED_FOR'])
    || !(in_array(@$_SERVER['REMOTE_ADDR'], $trustedIPs) || php_sapi_name() === 'cli-server')
) {
    header('HTTP/1.0 403 Forbidden');
    $message = 'You are not allowed to access this file. Check '.basename(__FILE__).' for more information.';
    if (isset($_SERVER['REMOTE_ADDR'])) {
        $ip = $_SERVER['REMOTE_ADDR'];
        $message .= " Your IP address is $ip.";
    }
    exit($message);
}

require __DIR__ . '/../app/autoload.php';
Debug::enable();

$kernel = new AppKernel('dev', true);
$kernel->loadClassCache();
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
