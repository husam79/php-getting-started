<?php

if( isset($_POST['username']) )
{
  echo $_POST['username'];
  echo $_POST['password'];
  
}
else{
  require('../vendor/autoload.php');

  $app = new Silex\Application();
  $app['debug'] = true;

  // Register the monolog logging service
  $app->register(new Silex\Provider\MonologServiceProvider(), array(
    'monolog.logfile' => 'php://stderr',
  ));

  // Register view rendering
  $app->register(new Silex\Provider\TwigServiceProvider(), array(
      'twig.path' => __DIR__.'/views',
  ));

  // Our web handlers

  $app->get('/', function() use($app) {
    $app['monolog']->addDebug('logging output.');
    return $app['twig']->render('index.twig');
  });

  $app->run();
}
/*$handle = fopen("data.txt", "r");
if ($handle) {
    while (($line = fgets($handle)) !== false) {
        // process the line read.
        echo $line;
    }

    fclose($handle);
} else {
    // error opening the file.
    echo 'ERROR';
} */