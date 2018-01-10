<?php
Class Series {
  public $id;
  public $name;
  public $books;
//=================================================================================== STRUCT
  public function __construct($idin, $namein)
  {
    $this->id           = $idin;
    $this->name        = $namein;
    $this->books      = array();
  }
  //=================================================================================== CREATE
    public static function checkifExists($name)
    {
      $errorCode;
      $message;
      $db = Db::getInstance();
      $sql = "SELECT seriesID FROM series WHERE name = ?";
      $data = array($name);
      try
      {
        $stmt = $db->prepare($sql);
        $stmt->execute($data);
        $r = $stmt->fetch(PDO::FETCH_ASSOC);
        $errorCode  = 1;
        $message    = $r['seriesID'];
      }
      catch(PDOException $e)
      {
        $errorCode  = $e-> getCode();
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
       $sql = "SELECT * FROM series WHERE name LIKE ? ORDER BY name";
       $list = array();
       $data = array($a."%");
       try
       {
         $stmt = $db->prepare($sql);
         $stmt->execute($data);
         while($r = $stmt->fetch(PDO::FETCH_ASSOC))		//goes through list
         {
           $list[] =  new Series($r['seriesID'],$r['name']);
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
//=================================================================================== CREATE
  public static function create($name)
  {
    $errorCode;
    $message;
    $check = Series::checkifExists($name)[1];
    if($check > -1)
    {
      $message = $check;
      $errorCode = 1;
    }
    else
    {
      $db = Db::getInstance();
      $sql = "INSERT INTO series (name) VALUES (?)";
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
  public static function getById($id)
  {
     $errorCode;
     $message;
     $db = Db::getInstance();
     $sql = "SELECT * FROM series WHERE seriesID = ?";
     $data = array($id);
     $serieslist = array();
     try
     {
       $stmt = $db->prepare($sql);
       $stmt->execute($data);
       $r = $stmt->fetch(PDO::FETCH_ASSOC);
       $errorCode  = 1;
       $message    = new Series($r['seriesID'],$r['name']);
     }
     catch(PDOException $e)
     {
       $errorCode  = $e->getCode();
       $message    = $e->getMessage();
     }
     return array($errorCode, $message);
  }
  //===================================================================================
   public static function all()
   {
      $errorCode;
      $message;
      $db = Db::getInstance();
      $sql = "SELECT * FROM series";
      $serieslist = array();
      try
      {
        $stmt = $db->prepare($sql);
        $stmt->execute();
        while($r = $stmt->fetch(PDO::FETCH_ASSOC))		//goes through list
        {
          $serieslist[] = new Series($r['seriesID'],$r['name']);
        }
        $errorCode  = 1;
        $message    = $serieslist;
      }
      catch(PDOException $e)
      {
        $errorCode  = $e->getCode();
        $message    = $e->getMessage();
      }
      return array($errorCode, $message);
   }
   //===================================================================================
    public static function byBookId($id)
    {
       $errorCode;
       $message;
       $db = Db::getInstance();
       $sql = "SELECT * FROM series WHERE seriesID IN (SELECT seriesID FROM book_series WHERE book_series.bookID = ?)";
       $data = array($id);
       try
       {
         $stmt = $db->prepare($sql);
         $stmt->execute($data);
         $r = $stmt->fetch(PDO::FETCH_ASSOC);
         $errorCode  = 1;
         $message    = new Series($r['seriesID'],$r['name']);
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
