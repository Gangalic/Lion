<?php
  namespace php\src\dao;
  /**
  * SQLAdaptor offer pre-made sql requests
  */
  abstract class SQLAdaptor{
    static abstract public function get();
    static abstract public function insert();
    static abstract public function update();
    static abstract public function delete();
  }
?>
