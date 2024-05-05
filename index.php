<?php

// echo "This is the main Page ";
require_once 'functions.php';
// require_once 'router.php';





$routes=[
  
  '/Student/'     => 'controllers/index2.php',

  '/Student/index' => 'controllers/index2.php',

  '/Student/index2' => 'controllers/index2.php' 

];

$uri=parse_url($_SERVER['REQUEST_URI'])['path'];

// echo $uri;

function routestoController($uri,$routes)
{

  if (array_key_exists($uri,$routes))
  {
    // echo $routes[$uri];

  require_once $routes[$uri];
  }
  else
  {
   http_response_code(404);
    echo '404';
  die();
  }
}

routestoController($uri,$routes);










// $uri=$_SERVER['REQUEST_URI'];

// $viewDir = '/views/';

// switch ($request) {
//     case '':
//         require __DIR__ . $viewDir . 'index2.php';
//         break;
//     case '/index2':
//         require __DIR__ . $viewDir . 'index2.php';
//         break;

    // case '/views/users':
    //     require __DIR__ . $viewDir . 'users.php';
    //     break;

    // case '/contact':
    //     require __DIR__ . $viewDir . 'contact.php';
    //     break;

//     default:
//         http_response_code(404);
//         require __DIR__ . $viewDir . '404.php';
// }







