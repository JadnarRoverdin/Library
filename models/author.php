<?php
Class Author {
  public $id;
  public $firstName;
  public $middleName;
  public $lastName;
//=================================================================================== STRUCT
  public function __construct($idin, $firstNamein, $middleNamein, $lastNamein)
  {
    $this->id           = $idin;
    $this->firstName    = $firstNamein;
    $this->middleName   = $middleNamein;
    $this->lastName     = $lastNamein;
  }
//=================================================================================== CREATE
  public static function create($firstName, $middleName, $lastName)
  {
    $errorCode;
    $message;
    $check = Author::checkIfExists($firstName, $middleName, $lastName)[1];
    if($check > -1)
    {
      $message = $check;
      $errorCode = 1;
    }
    else
    {
      $db = Db::getInstance();
      $sql = "INSERT INTO author (firstName, middleName, lastName) VALUES (?,?,?)";
      $data = array($firstName, $middleName, $lastName);
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
       $message    = new Author($r['authorID'],$r['firstName'],$r['middleName'],$r['lastName']);;
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
     $sql = "SELECT * FROM author WHERE lastName LIKE ? ORDER BY lastName";
     $list = array();
     $data = array($a."%");
     try
     {
       $stmt = $db->prepare($sql);
       $stmt->execute($data);
       while($r = $stmt->fetch(PDO::FETCH_ASSOC))		//goes through list
       {
         $list[] = new Author($r['authorID'],$r['firstName'],$r['middleName'],$r['lastName']);
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
        $authorlist[] = new Author($r['authorID'],$r['firstName'],$r['middleName'],$r['lastName']);
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
  public static function checkIfExists($firstName, $middleName, $lastName)
  {

     $errorCode;
     $message;
     $db = Db::getInstance();
     $sql = "SELECT authorID FROM author WHERE UPPER(firstName) = UPPER(?) AND UPPER(middleName) = UPPER(?) AND UPPER(lastName) = UPPER(?)";
     $data = array($firstName, $middleName, $lastName);
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
