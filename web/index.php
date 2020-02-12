<?php

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

$app->get('/profile', function() use($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('profile.twig');
});

$app->get('/login', function() use($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('login.twig');
});

$app->get('/matches', function() use($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('matches.twig');
});

$app->get('/search', function() use($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('search.twig');
});

$app->get('/faq', function() use($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('faq.twig');
});

$app->get('/create', function() use($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('create.twig');
});

//db
// $db = parse_url(getenv("DATABASE_URL"));

// $pdo = new PDO("pgsql:" . sprintf(
//     "host=%s;port=%s;user=%s;password=%s;dbname=%s",
//     $db["host"],
//     $db["port"],
//     $db["user"],
//     $db["pass"],
//     ltrim($db["path"], "/")
// ));

// $dbopts = parse_url(getenv('DATABASE_URL'));
// $app->register(new Csanquer\Silex\PdoServiceProvider\Provider\PDOServiceProvider('pdo'),
//                array(
//                 'pdo.server' => array(
//                    'driver'   => 'pgsql',
//                    'user' => $dbopts["user"],
//                    'password' => $dbopts["pass"],
//                    'host' => $dbopts["host"],
//                    'port' => $dbopts["port"],
//                    'dbname' => ltrim($dbopts["path"],'/')
//                    )
//                )
// );

// $app->get('/db/', function() use($app) {
//   $st = $app['pdo']->prepare('SELECT name FROM test_table');
//   $st->execute();

//   $names = array();
//   while ($row = $st->fetch(PDO::FETCH_ASSOC)) {
//     $app['monolog']->addDebug('Row ' . $row['name']);
//     $names[] = $row;
//   }

//   return $app['twig']->render('database.twig', array(
//     'names' => $names
//   ));
// });



$app->run();






// DELETE COWSAY
//$app->get('/cowsay', function() use($app) {
//  $app['monolog']->addDebug('cowsay');
//  return "<pre>".\Cowsayphp\Cow::say("Cool beans")."</pre>";
//});
