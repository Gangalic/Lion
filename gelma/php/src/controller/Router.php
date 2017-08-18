<?php
namespace php\src\controller;
/**
* A router defines valid URI formats (corresponding to a RESTful architecture) and how to extract data from those URI
*/
class Router{
  /**
  * Read the URI, extract the parameters and return an appropriate array for the Controller
  */
  static public function read($uri){
    if(preg_match("#^/?$#", $uri) == 1){
      return array("Dashboard");
    }
    elseif(preg_match("#/admin/?$#", $uri) == 1){
      return array("Dashboard");
    }
    elseif(preg_match("#/admin/content/event/?$#", $uri) == 1){
      return array("Content", "event");
    }
    elseif(preg_match("#/admin/content/event/update/[0-9]+/?$#", $uri) == 1){
      $parameters = explode("/", $uri);
      //get last parameter corresponding to the content id
      $last_parameter;
      foreach($parameters as $parameter){
        if(!empty($parameter)){
          $last_parameter = $parameter;
        }
      }
      return array("Content", $last_parameter);
    }
    elseif(preg_match("#/admin/content/event/[0-9]+/?$#", $uri) == 1){
      $parameters = explode("/", $uri);
      //get last parameter corresponding to the content id
      $last_parameter;
      foreach($parameters as $parameter){
        if(!empty($parameter)){
          $last_parameter = $parameter;
        }
      }
      return array("Content", $last_parameter);
    }
    elseif(preg_match("#^/admin/user/?$#", $uri) == 1){
      return array("User");
    }
    elseif(preg_match("#^/admin/user/[0-9]+/?$#", $uri) == 1){
      $parameters = explode("/", $uri);
      //get last parameter corresponding to the content id
      $last_parameter;
      foreach($parameters as $parameter){
        if(!empty($parameter)){
          $last_parameter = $parameter;
        }
      }
      return array("User", $last_parameter);
    }
    else{
    echo "<p>Error 404, unknown URL</p>";
    }
  }
}

?>
