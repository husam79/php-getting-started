<?php

if( isset($_POST['username']) )
{
  $usr = $_POST['username'];
  $pwd = $_POST['password'];
  
  if(  !(($usr == 'meryem' and $pwd == 'vb') or ($usr == 'sara' and $pwd == 'sd')) )  {
    echo 'no such user!';
  }
  else{
    
    $handle = fopen("data.txt", "r");
    if ($handle) {
        
        while (($line = fgets($handle)) !== false) {
            if (strtolower(trim(explode(' ', $line)[0])) == $usr){
                echo "<b>" . explode(' ', $line)[0] . ":" . explode(' ', $line)[1] . "</b>";
            }
        }

        fclose($handle);
    } else {
        // error opening the file.
        echo 'ERROR';
    }
  }
  
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