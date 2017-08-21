<?php
  if(isset($_POST["login"]) && isset($_POST["pwd"])){
    $login = $_POST["login"];
    $pwd = $_POST["pwd"];
    if(isset($_POST["pwd2"])){
      $pwd2 = $_POST["pwd2"];
      echo "La création d'un nouveau compte n'est pas une fonctionnalité disponible. (21/08/2017)";
    }else{
      $config = parse_ini_file("config.ini");
      $admin_login = $config["ADMIN_LOGIN"];
      $admin_mdp = $config["ADMIN_MDP"];
      if($login == $admin_login && $pwd == $admin_mdp){
        session_start();
        $_SESSION["login"] = $login;
        // echo "I'm logged in";
        header("Location: http://localhost/Lion/trunk/admin/");
      }
    }
  }else{
    header("Location: http://localhost/Lion/trunk/en/");
  }
?>
