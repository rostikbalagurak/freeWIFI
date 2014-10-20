<?php

$loader = new \Phalcon\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerDirs(
    array(
        $config->application->controllersDir,
        $config->application->modelsDir
    )
)->register();

$loader->registerClasses(
	array(
		"User"         => dirname(__DIR__) . "/models/User.php",
		"ResponseMessage"         => dirname(__DIR__) . "/models/ResponseMessage.php",
		"WifiSpot"         => dirname(__DIR__) . "/models/WifiSpot.php",
		"Utils"         => dirname(__DIR__) . "/models/Utils.php",
	)
);

$loader->register();