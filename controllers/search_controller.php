<?php
Class SearchController
{
  public function search()
  {
    $string = $_POST['searchString'];
    $searchBy = $_POST['searchBy'];
    $booklist;
    switch($searchBy)
    {
      case 'title':
        $booklist = Book::searchByTitle($string)[1];
        break;
      case 'author':
        $booklist = Book::searchByAuthor($string)[1];
        break;
      case 'ISBN':
        $booklist = Book::searchByISBN($string)[1];
        break;
      case 'series':
        $booklist = Book::searchBySeries($string)[1];
        break;
    }
  require_once('views/search/searchResults.php');
  }
}

?>
