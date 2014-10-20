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
		"User"         => __DIR__ . "/../models/User.php",
		"ResponseMessage"         => __DIR__ . "/../models/ResponseMessage.php",
		"WifiSpot"         => __DIR__ . "/../models/WifiSpot.php",
		"Utils"         => __DIR__ . "/../models/Utils.php",
	)
);

$loader->register();
echo __DIR__ . "/../models/User.php" . '<br>';
echo __DIR__ . "/../models/ResponseMessage.php" . '<br>';
echo __DIR__ . "/../models/WifiSpot.php" . '<br>';
echo __DIR__ . "/../models/Utils.php" . '<br>';