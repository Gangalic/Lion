<?php
  namespace trunk\admin;
  require_once(__DIR__."/../gelma/php/src/controller/Controller.php");
  use \php\src\controller as Controller;

  $uri;
  if($_SERVER['REQUEST_METHOD'] == 'GET') {
    $uri = $_GET["url"];
  } elseif($_SERVER['REQUEST_METHOD'] == 'PUT') {
    parse_str(file_get_contents("php://input"),$post_vars);
    $_SERVER['REQUEST_METHOD'] = 'GET';
    $uri = $post_vars["url"];
  }
  define("LANGUAGE", "English");
  define("FK_USER", "1");
  $controller = new Controller\Controller();
  $controller->run($uri);
  $controller->to_html();
?>
