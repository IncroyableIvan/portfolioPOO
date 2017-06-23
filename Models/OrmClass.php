<?php
  class Orm
  {
    private static $_instance = null;

    //private $user = "";
    //private $password = "";
    private $db = "portfolio";

    private function __construct() {
    }
    public static function getInstance()
    {
      if(is_null(self::$_instance)) {
        self::$_instance = new Orm();
      }
      return self::$_instance;
    }
    public function getAllData($table)
    {
      $db = new PDO('mysql:host=localhost;dbname=' . $this->db . '', $this->user, $this->password);
      $request = $db->prepare('SELECT * FROM ' . $table);
      $request->execute();
      return $request->fetchAll();
    }
    public function getOneData($table)
    {
      $db = new PDO('mysql:host=localhost;dbname=' . $this->db . '', $this->user, $this->password);
      $request = $db->prepare('SELECT * FROM ' . $table);
      $request->execute();
      return $request->fetch();
    }
    public function insertData($table, $name, $description)
    {
      $db = new PDO('mysql:host=localhost;dbname=' . $this->db . '', $this->user, $this->password);
      $request = $db->prepare('INSERT INTO ' . $table . '(name, description) VALUES (:name, :description)');
      $request->bindParam(':name', $name);
      $request->bindParam(':description', $description);
      $request->execute();
      return True;
    }
    public function deleteData($table, $id)
    {
      $db = new PDO('mysql:host=localhost;dbname=' . $this->db . '', $this->user, $this->password);
      $request = $db->prepare('DELETE FROM ' . $table . ' WHERE id = :id');
      $request->bindParam(':id', $id);
      $request->execute();
      return True;
    }
  }
