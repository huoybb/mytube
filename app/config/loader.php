<?php

$loader = new \Phalcon\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */
$config = $this->get('config');
$loader->registerDirs(
    [
        $config->application->controllersDir,
        $config->application->modelsDir,
        $config->application->presentersDir,
        $config->application->middlewaresDir,
        $config->application->formsDir,
        $config->application->events,
        $config->application->eventsHandlers,
    ]
);
return $loader;
