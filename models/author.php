<?php
Class Author {
  public $id;
  public $name;

//=================================================================================== STRUCT
  public function __construct($idin, $namein)
  {
    $this->id      = $idin;
    $this->name    = $namein;
  }
//=================================================================================== CREATE
  public static function create($name)
  {
    $errorCode;
    $message;
    $check = Author::checkIfExists($name)[1];
    if($check > -1)
    {
      $message = $check;
      $errorCode = 1;
    }
    else
    {
      $db = Db::getInstance();
      $sql = "INSERT INTO author (name) VALUES (?)";
      $data = array($name);
      try
      {
        $stmt = $db->prepare($sql);
        $stmt->execute($data);
        $lastID = $db->lastInsertId();
        $errorCode = 1;
        $message = $lastID;
      }
      catch(PDOException $e)
      {
        $errorCode  = $e-> getCode();
        $message    = $e->getMessage();
      }
    }
    return array($errorCode, $message);
 }
 //===================================================================================
  public static function all()
  {
     $errorCode;
     $message;
     $db = Db::getInstance();
     $sql = "SELECT * FROM author";
     $authorlist = array();
     try
     {
       $stmt = $db->prepare($sql);
       $stmt->execute();
       while($r = $stmt->fetch(PDO::FETCH_ASSOC))		//goes through list
       {
         $authorlist[] = new Author($r['authorID'],$r['name']);
       }
       $errorCode  = 1;
       $message    = $authorlist;
     }
     catch(PDOException $e)
     {
       $errorCode  = $e->getCode();
       $message    = $e->getMessage();
     }
     return array($errorCode, $message);
  }
 //===================================================================================
  public static function id($id)
  {
     $errorCode;
     $message;
     $db = Db::getInstance();
     $sql = "SELECT * FROM author WHERE authorID = ?";
     $data = array($id);
     try
     {
       $stmt = $db->prepare($sql);
       $stmt->execute($data);
       $r = $stmt->fetch(PDO::FETCH_ASSOC);
       $errorCode  = 1;
       $message    = new Author($r['authorID'],$r['name']);
     }
     catch(PDOException $e)
     {
       $errorCode  = $e->getCode();
       $message    = $e->getMessage();
     }
     return array($errorCode, $message);
  }
 //===================================================================================
  public static function byLetter($a)
  {
     $errorCode;
     $message;
     $db = Db::getInstance();
     $sql = "SELECT * FROM author WHERE name LIKE ? ORDER BY name";
     $list = array();
     $data = array("%".$a."%");
     try
     {
       $stmt = $db->prepare($sql);
       $stmt->execute($data);
       while($r = $stmt->fetch(PDO::FETCH_ASSOC))		//goes through list
       {
         $list[] = new Author($r['authorID'],$r['name']);
       }
       $errorCode  = 1;
       $message    = $list;
     }
     catch(PDOException $e)
     {
       $errorCode  = $e->getCode();
       $message    = $e->getMessage();
     }
     return array($errorCode, $message);
  }
//===================================================================================
 public static function getByBookId($bookID)
 {

    $errorCode;
    $message;
    $db = Db::getInstance();
    $sql = "SELECT * FROM author WHERE authorID IN (SELECT authorID FROM book_author WHERE book_author.bookID = ?)";
    $data = array($bookID);
    $authorlist = array();
    try
    {
      $stmt = $db->prepare($sql);
      $stmt->execute($data);
      while($r = $stmt->fetch(PDO::FETCH_ASSOC))		//goes through list
      {
        $authorlist[] = new Author($r['authorID'],$r['name']);
      }
      $errorCode  = 1;
      $message    = $authorlist;
    }
    catch(PDOException $e)
    {
      $errorCode  = $e->getCode();
      $message    = $e->getMessage();
    }
    return array($errorCode, $message);
 }
 //===================================================================================
  public static function checkIfExists($name)
  {

     $errorCode;
     $message;
     $db = Db::getInstance();
     $sql = "SELECT authorID FROM author WHERE UPPER(name) = UPPER(?)";
     $data = array($name);
     $authorlist = array();
     try
     {
       $stmt = $db->prepare($sql);
       $stmt->execute($data);
       $r = $stmt->fetch(PDO::FETCH_ASSOC);
       $errorCode  = 1;
       $message    = $r['authorID'];
     }
     catch(PDOException $e)
     {
       $errorCode  = $e->getCode();
       $message    = $e->getMessage();
     }
     return array($errorCode, $message);
  }
}
?>
