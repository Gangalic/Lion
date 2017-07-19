<?php
namespace php\src\user;

use php\src\dao as DAO;
require_once(__DIR__."/../dao/SQLAdaptor.php");

class UserSQLAdaptor extends DAO\SQLAdaptor{
  static public function get(){
    if(func_num_args() == 1){
      $param = func_get_arg(0);
      if(is_int($param)){
        $request = "SELECT PK_User, Login, Password, Signature, LastName, Name, Admin FROM User WHERE PK_User = %d";
        return sprintf($request, $param);
      } else{
        throw new \Exception("bad parameter");
      }
    } else {
      return "SELECT PK_User, Login, Password, Signature, LastName, Name, Admin FROM User";
    }
  }

  static public function insert(){
    $login = func_get_arg(0);
    $password = func_get_arg(1);
    $name = func_get_arg(2);
    $last_name = func_get_arg(3);
    $signature = func_get_arg(4);

    $request = "INSERT INTO User (Login, Password, Name, LastName, Signature) VALUES ('%s', '%s', '%s', '%s', '%s');";
    return sprintf($request, $login, $password, $name, $last_name, $signature);
  }

  static public function update(){
    $pk_user = func_get_arg(0);
    $login = func_get_arg(1);
    $password = func_get_arg(2);
    $name = func_get_arg(3);
    $last_name = func_get_arg(4);
    $signature = func_get_arg(5);

    $request = "UPDATE User SET Login = '%s', Password = '%s', Name = '%s',  LastName = '%s', Signature = '%s' WHERE PK_User = '%d';";
    return sprintf($request, $login, $password, $name, $last_name, $signature, $pk_user);
  }

  static public function delete(){
    $pk_user = func_get_arg(0);
    $request = "DELETE FROM Content WHERE FK_User = '%d'; DELETE FROM User WHERE PK_User = '%d';";
    return sprintf($request, $pk_user, $pk_user);
  }
}
?>
