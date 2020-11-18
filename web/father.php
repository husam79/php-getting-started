<?php

if( isset($_POST['username']) )
{
  $usr = $_POST['username'];
  $pwd = $_POST['password'];
  
  if(  !($usr == 'baba' and $pwd == 'hus7913')  )  {
    echo 'no such user!';
  }
  else{
    $handle = fopen("data.txt", "r");

    $meryem = '';
    $meryem_b = '';
    $sara = '';
    $sara_b = '';

    if ($handle) {
        
        while (($line = fgets($handle)) !== false) {
            if (strtolower(trim(explode(' ', $line)[0])) == 'meryem'){
                $meryem = trim(explode(' ', $line)[0]);
                $meryem_b = trim(explode(' ', $line)[1]);
            }

            if (strtolower(trim(explode(' ', $line)[0])) == 'sara'){
                $sara = trim(explode(' ', $line)[0]);
                $sara_b = trim(explode(' ', $line)[1]);
            }
        }

        fclose($handle);
    } else {
        // error opening the file.
        echo 'ERROR';
    }


    $handle = fopen("data.txt", "w");

    if ($handle) {
        fwrite($handle, $meryem . ' ' . $meryem_b . '\n' . $sara . ' ' . $sara_b);

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
    return $app['father']->render('father.twig');
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