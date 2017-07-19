<?php
namespace php\src\content;

use php\src\dao as DAO;
require_once(__DIR__."/../dao/SQLAdaptor.php");

class ContentSQLAdaptor extends DAO\SQLAdaptor{
  static public function get(){
    if(func_num_args() == 2){
      $param = func_get_arg(0);
      if(is_numeric($param)){
        $request = "SELECT Content.PK_Content, Content.Type, Content.Date, ContentTranslation.Title, ContentTranslation.Content FROM Content JOIN ContentTranslation ON Content.PK_Content = ContentTranslation.FK_Content WHERE Content.PK_Content = %d AND ContentTranslation.Language = '%s'";
        return sprintf($request, $param, func_get_arg(1));
      } else if (is_string($param)){
        $request = "SELECT Content.PK_Content, Content.Type, Content.Date, ContentTranslation.Title, ContentTranslation.Content FROM Content JOIN ContentTranslation ON Content.PK_Content = ContentTranslation.FK_Content WHERE Content.Type = '%s' AND ContentTranslation.Language = '%s'";
        return sprintf($request, $param, func_get_arg(1));
      } else{
        throw new \Exception("bad parameter");
      }
    } else {
      $request = "SELECT Content.PK_Content, Content.Type, Content.Date, ContentTranslation.Title, ContentTranslation.Content FROM Content JOIN ContentTranslation ON Content.PK_Content = ContentTranslation.FK_Content WHERE ContentTranslation.Language = '%s'";
      return sprintf($request, func_get_arg(0));
    }
  }

  static public function insert(){
    $title = func_get_arg(0);
    $type = func_get_arg(1);
    $content = func_get_arg(2);
    $fk_user = func_get_arg(3);
    $language = func_get_arg(4);
    $request = "INSERT INTO Content (FK_User, Type) VALUES ('%d', '%s'); INSERT INTO ContentTranslation (FK_Content, Title, Content, Language) VALUES ((SELECT PK_Content FROM Content WHERE Type='%s' ORDER BY PK_Content DESC LIMIT 1), '%s', '%s', '%s')";
    return sprintf($request, $fk_user, $type, $type, $title, $content, $language);
  }

  static public function update(){
    $pk_content = func_get_arg(0);
    $title = func_get_arg(1);
    $type = func_get_arg(2);
    $content = func_get_arg(3);
    $date = func_get_arg(4);
    $language = func_get_arg(5);
    $request = "UPDATE Content SET Type = '%s', Date='%s' WHERE PK_Content = '%d'; UPDATE ContentTranslation SET Title = '%s', Content = '%s' WHERE Language = '%s' AND FK_Content = '%d'";
    return sprintf($request, $type, $date, $pk_content, $title, $content, $language, $pk_content);
  }

  static public function delete(){
    $pk_content = func_get_arg(0);
    $request = "DELETE FROM ContentTranslation WHERE FK_Content = '%d'; DELETE FROM Content WHERE PK_Content = '%d';";
    return sprintf($request, $pk_content, $pk_content);
  }
}
?>
