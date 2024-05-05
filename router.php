<?php

echo"";
$uri=parse_url($_SERVER['REQUEST_URI'])['path'];


$routes=[
  
  '/'     => 'controllers/index2.php',

  '/index' => 'controllers/index2.php',
  
  '/index2' => 'controllers/index2.php' 

];

function routestoController($uri,$routes)
{

  if (array_key_exists($uri,$routes))
  {
  require $routes[$uri];
  }
  else
  {
   http_response_code(404);
    echo '404';
  
  die();
  }
}

routestoController($uri,$routes);
