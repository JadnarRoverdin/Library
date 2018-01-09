<?php
  class Db
  {
    private static $instance = NULL;
    private function __construct()
    {
      $server   = "localhost";
      $database = "connection";
      $username = "root";
      $password = "root";
    }
    private function __clone() {}

    public static function getInstance() {
      if (!isset(self::$instance)) {
        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
        self::$instance = new PDO("mysql:host=localhost;dbname=library", "root", "root", $pdo_options);
      }
      return self::$instance;
    }
  }
?>
