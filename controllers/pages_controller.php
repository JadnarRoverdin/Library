<?php
Class PagesController
{
  public function index()
  {
    require_once('views/pages/index.php');
  }

  public function error()
  {
    require_once('views/pages/error.php');
  }

  public function viewbook()
  {
    $bookID = $_GET['bookID'];
    $book = Book::id($bookID)[1];
    require_once('views/pages/viewBook.php');
  }

}

?>
