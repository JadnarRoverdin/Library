<?php
Class Book {
  public $id;
  public $title;
  public $ISBN;
  public $authors;
  public $bookNumber;
  public $series;
  public $wishlist;
//=================================================================================== STRUCT
  public function __construct($idin, $titlein, $ISBNin, $bookNumberin, $wishlistin)
  {
    $this->id           = $idin;
    $this->title        = $titlein;
    $this->ISBN         = $ISBNin;
    $this->bookNumber   = $bookNumberin;
    $this->authors      = Author::getByBookId($idin)[1];
    $this->series       = Series::byBookId($idin)[1];
    $this->wishlist    = $wishlistin;
  }
//=================================================================================== CREATE
  public static function create($title, $ISBN, $bookNumber, $wishlist)
  {
    $errorCode;
    $message;
    $check = Book::checkIfExists($title)[1];
    if($check > -1)
    {
      $message = $check;
      $errorCode = 1;
    }
    else
    {
      $db = Db::getInstance();
      $sql = "INSERT INTO book (title, ISBN, bookNumber, wishlist) VALUES (?,?,?,?)";
      $data = array($title, $ISBN, $bookNumber, $wishlist);
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
 //=================================================================================== CREATE
   public static function update($title, $ISBN, $bookNumber, $wishlist, $bookID)
   {
     $errorCode;
     $message;
     $db = Db::getInstance();
     $sql = "UPDATE book SET title = ?, ISBN = ?, bookNumber = ?, wishlist = ? WHERE bookID = ?";
     $data = array($title, $ISBN, $bookNumber, $wishlist, $bookID);
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

     return array($errorCode, $message);
  }
 //===================================================================================
  public static function all()
  {
     $errorCode;
     $message;
     $db = Db::getInstance();
     $sql = "SELECT * FROM book";
     $booklist = array();
     try
     {
       $stmt = $db->prepare($sql);
       $stmt->execute();
       while($r = $stmt->fetch(PDO::FETCH_ASSOC))		//goes through list
       {
         $booklist[] = new Book($r['bookID'],$r['title'],$r['ISBN'],$r['bookNumber'],$r['wishlist']);
       }
       $errorCode  = 1;
       $message    = $booklist;
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
      $sql = "SELECT * FROM book WHERE title LIKE ?";
      $booklist = array();
      $data = array($a."%");
      // $alpha = array('0','1','2','3','4','5','6','7','8','9','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
      try
      {
        $stmt = $db->prepare($sql);
        $stmt->execute($data);
        while($r = $stmt->fetch(PDO::FETCH_ASSOC))		//goes through list
        {
          $booklist[] = new Book($r['bookID'],$r['title'],$r['ISBN'],$r['bookNumber'],$r['wishlist']);
        }
        $errorCode  = 1;
        $message    = $booklist;
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
       $sql = "SELECT DISTINCT * FROM book WHERE bookID = ?";
       $data = array($id);
       try
       {
         $stmt = $db->prepare($sql);
         $stmt->execute($data);
         $r = $stmt->fetch(PDO::FETCH_ASSOC);
         $errorCode  = 1;
         $message    = new Book($r['bookID'],$r['title'],$r['ISBN'],$r['bookNumber'],$r['wishlist']);
       }
       catch(PDOException $e)
       {
         $errorCode  = $e->getCode();
         $message    = $e->getMessage();
       }
       return array($errorCode, $message);
    }
    //===================================================================================
     public static function getByWishlist()
     {
        $errorCode;
        $message;
        $db = Db::getInstance();
        $sql = "SELECT * FROM book WHERE wishlist = 1";
        $data = array($id);
        $booklist = array();
        try
        {
          $stmt = $db->prepare($sql);
          $stmt->execute($data);
          while($r = $stmt->fetch(PDO::FETCH_ASSOC))		//goes through list
          {
            $booklist[] = new Book($r['bookID'],$r['title'],$r['ISBN'],$r['bookNumber'],$r['wishlist']);
          }
          $errorCode  = 1;
          $message    = $booklist;
        }
        catch(PDOException $e)
        {
          $errorCode  = $e->getCode();
          $message    = $e->getMessage();
        }
        return array($errorCode, $message);
     }
 //===================================================================================
  public static function searchByTitle($searchString)
  {
     $errorCode;
     $message;
     $db = Db::getInstance();
     $sql = "SELECT DISTINCT * FROM book WHERE UPPER(title) LIKE UPPER(?)";
     $data = array('%'.$searchString.'%');
     $booklist = array();
     try
     {
       $stmt = $db->prepare($sql);
       $stmt->execute($data);
       while($r = $stmt->fetch(PDO::FETCH_ASSOC))		//goes through list
       {
         $booklist[] = new Book($r['bookID'],$r['title'],$r['ISBN'],$r['bookNumber'],$r['wishlist']);
       }
       $errorCode  = 1;
       $message    = $booklist;
     }
     catch(PDOException $e)
     {
       $errorCode  = $e->getCode();
       $message    = $e->getMessage();
     }
     return array($errorCode, $message);
  }
  //===================================================================================
   public static function searchByISBN($searchString)
   {
      $errorCode;
      $message;
      $db = Db::getInstance();
      $sql = "SELECT DISTINCT * FROM book WHERE UPPER(ISBN) LIKE UPPER(?)";
      $data = array('%'.$searchString.'%');
      $booklist = array();
      try
      {
        $stmt = $db->prepare($sql);
        $stmt->execute($data);
        while($r = $stmt->fetch(PDO::FETCH_ASSOC))		//goes through list
        {
          $booklist[] = new Book($r['bookID'],$r['title'],$r['ISBN'],$r['bookNumber'],$r['wishlist']);
        }
        $errorCode  = 1;
        $message    = $booklist;
      }
      catch(PDOException $e)
      {
        $errorCode  = $e->getCode();
        $message    = $e->getMessage();
      }
      return array($errorCode, $message);
   }
  //===================================================================================
   public static function searchByAuthor($searchString)
   {
      $errorCode;
      $message;
      $db = Db::getInstance();
      $sql = "SELECT * FROM book WHERE bookID IN(SELECT bookID FROM book_author WHERE book_author.authorID IN (SELECT DISTINCT authorID FROM author WHERE UPPER(name) LIKE UPPER(?)))";
      $data = array('%'.$searchString.'%');
      $booklist = array();
      try
      {
        $stmt = $db->prepare($sql);
        $stmt->execute($data);
        while($r = $stmt->fetch(PDO::FETCH_ASSOC))		//goes through list
        {
          $booklist[] = new Book($r['bookID'],$r['title'],$r['ISBN'],$r['bookNumber'],$r['wishlist']);
        }
        $errorCode  = 1;
        $message    = $booklist;
      }
      catch(PDOException $e)
      {
        $errorCode  = $e->getCode();
        $message    = $e->getMessage();
      }
      return array($errorCode, $message);
   }
   //===================================================================================
    public static function searchBySeries($searchString)
    {
       $errorCode;
       $message;
       $db = Db::getInstance();
       $sql = "SELECT * FROM book WHERE bookID IN (SELECT bookID FROM book_series WHERE book_series.seriesID IN (SELECT seriesID FROM series WHERE UPPER(name) LIKE UPPER(?)))";
       $data = array('%'.$searchString.'%');
       $booklist = array();
       try
       {
         $stmt = $db->prepare($sql);
         $stmt->execute($data);
         while($r = $stmt->fetch(PDO::FETCH_ASSOC))		//goes through list
         {
           $booklist[] = new Book($r['bookID'],$r['title'],$r['ISBN'],$r['bookNumber'],$r['wishlist']);
         }
         $errorCode  = 1;
         $message    = $booklist;
       }
       catch(PDOException $e)
       {
         $errorCode  = $e->getCode();
         $message    = $e->getMessage();
       }
       return array($errorCode, $message);
    }

 //===================================================================================
  public static function getByAuthorID($authorID)
  {
     $errorCode;
     $message;
     $db = Db::getInstance();
     $sql = "SELECT * FROM book WHERE bookID IN (SELECT bookID FROM book_author WHERE book_author.authorID = ?)";
     $data = array($authorID);
     $booklist = array();
     try
     {
       $stmt = $db->prepare($sql);
       $stmt->execute($data);
       while($r = $stmt->fetch(PDO::FETCH_ASSOC))		//goes through list
       {
         $booklist[] = new Book($r['bookID'],$r['title'],$r['ISBN'],$r['bookNumber'],$r['wishlist']);
       }
       $errorCode  = 1;
       $message    = $booklist;
     }
     catch(PDOException $e)
     {
       $errorCode  = $e->getCode();
       $message    = $e->getMessage();
     }
     return array($errorCode, $message);
  }
  //===================================================================================
   public static function getBySeriesId($seriesID)
   {
      $errorCode;
      $message;
      $db = Db::getInstance();
      $sql = "SELECT * FROM book WHERE bookID IN (SELECT bookID FROM book_series WHERE book_series.seriesID = ?)";
      $data = array($seriesID);
      $booklist = array();
      try
      {
        $stmt = $db->prepare($sql);
        $stmt->execute($data);
        while($r = $stmt->fetch(PDO::FETCH_ASSOC))		//goes through list
        {
          $booklist[] = new Book($r['bookID'],$r['title'],$r['ISBN'],$r['bookNumber'],$r['wishlist']);;
        }
        $errorCode  = 1;
        $message    = $booklist;
      }
      catch(PDOException $e)
      {
        $errorCode  = $e->getCode();
        $message    = $e->getMessage();
      }
      return array($errorCode, $message);
   }
   //===================================================================================
    public static function getByWishlist()
    {
       $errorCode;
       $message;
       $db = Db::getInstance();
       $sql = "SELECT * FROM book WHERE wishlist = 1";
       $data = array($seriesID);
       $booklist = array();
       try
       {
         $stmt = $db->prepare($sql);
         $stmt->execute($data);
         while($r = $stmt->fetch(PDO::FETCH_ASSOC))
         {
           $booklist[] = new Book($r['bookID'],$r['title'],$r['ISBN'],$r['bookNumber'],$r['wishlist']);
         }
         $errorCode  = 1;
         $message    = $booklist;
       }
       catch(PDOException $e)
       {
         $errorCode  = $e->getCode();
         $message    = $e->getMessage();
       }
       return array($errorCode, $message);
    }
  //===================================================================================
   public static function checkifWithAuthor($bookID, $authorID)
   {

      $errorCode;
      $message;
      $db = Db::getInstance();
      $sql = "SELECT book_authorID FROM book_author WHERE bookID = ? AND authorID = ?";
      $data = array($bookID, $authorID);
      $authorlist = array();
      try
      {
        $stmt = $db->prepare($sql);
        $stmt->execute($data);
        $r = $stmt->fetch(PDO::FETCH_ASSOC);
        $errorCode  = 1;
        $message    = $r['book_authorID'];
      }
      catch(PDOException $e)
      {
        $errorCode  = $e->getCode();
        $message    = $e->getMessage();
      }
      return array($errorCode, $message);
   }
     //===================================================================================
    public static function associateWithAuthor($bookID, $authorID)
    {
      $errorCode;
      $message;
      $check = Book::checkifWithAuthor($bookID, $authorID)[1];
      if($check > -1)
      {
        $message = $check;
        $errorCode = 1;
      }
      else
      {
        $db = Db::getInstance();
        $sql = "INSERT INTO book_author (bookID, authorID) VALUES (?,?)";
        $data = array($bookID, $authorID);
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
  public static function disassociateWithAuthor($bookID, $authorID)
  {
    $errorCode;
    $message;
    $db = Db::getInstance();
    $sql = "DELETE FROM book_author WHERE bookID = ? AND authorID = ?";
    $data = array($bookID, $authorID);
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

    return array($errorCode, $message);
 }
   //===================================================================================
    public static function checkIfInSeries($bookID, $seriesID)
    {

       $errorCode;
       $message;
       $db = Db::getInstance();
       $sql = "SELECT book_seriesID FROM book_series WHERE bookID = ? AND seriesID = ?";
       $data = array($bookID, $seriesID);
       $authorlist = array();
       try
       {
         $stmt = $db->prepare($sql);
         $stmt->execute($data);
         $r = $stmt->fetch(PDO::FETCH_ASSOC);
         $errorCode  = 1;
         $message    = $r['book_seriesID'];
       }
       catch(PDOException $e)
       {
         $errorCode  = $e->getCode();
         $message    = $e->getMessage();
       }
       return array($errorCode, $message);
    }
   //=================================================================================== CREATE
     public static function associateWithSeries($bookID, $seriesID)
     {
       $errorCode;
       $message;
       $check = Book::checkIfInSeries($bookID, $seriesID)[1];
       if($check > -1)
       {
         $message = $check;
         $errorCode = 1;
       }
       else
       {
         $db = Db::getInstance();
         $sql = "INSERT INTO book_series (bookID, seriesID) VALUES (?,?)";
         $data = array($bookID, $seriesID);
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
    //=================================================================================== CREATE
      public static function disassociateWithSeries($bookID, $seriesID)
      {
        $errorCode;
        $message;

        $db = Db::getInstance();
        $sql = "DELETE FROM book_series WHERE bookID = ? AND seriesID = ?";
        $data = array($bookID, $seriesID);
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

        return array($errorCode, $message);
     }

    //===================================================================================
     public static function checkIfExists($title)
     {

        $errorCode;
        $message;
        $db = Db::getInstance();
        $sql = "SELECT bookID FROM book WHERE UPPER(title) = UPPER(?)";
        $data = array($title);
        $authorlist = array();
        try
        {
          $stmt = $db->prepare($sql);
          $stmt->execute($data);
          $r = $stmt->fetch(PDO::FETCH_ASSOC);
          $errorCode  = 1;
          $message    = $r['bookID'];
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
