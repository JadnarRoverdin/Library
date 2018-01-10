<?php
Class BrowseController
{
  public function browse()
  {
    $searchBy = $_GET['searchBy'];
    $searchByText = " by ".$searchBy;
    $target;
    $list;
    $listSize;
    $return = "";
    $selectActive = true;
    switch($searchBy)
    {
      case 'title':
        if(isset($_GET['refresh']))
          unset($_SESSION['return']);
        if(isset($_POST['target']))
          $target = $_POST['target'];
        if(isset($_GET['target']))
          $target = $_GET['target'];
        echo $return;
        $list = Book::byLetter($target)[1];
        $listSize = sizeof($list);
        require_once('views/browse/bookResults.php');
        break;
      case 'author':
        if(isset($_POST['target']))
          $target = $_POST['target'];
        if(isset($_GET['target']))
          $target = $_GET['target'];
        $list = Author::byLetter($target)[1];
        $listSize = sizeof($list);
        $_SESSION['return'] = $_SERVER['QUERY_STRING']."&target=".$target;
        require_once('views/browse/authorResults.php');
        break;
      case 'series':
        if(isset($_POST['target']))
          $target = $_POST['target'];
        if(isset($_GET['target']))
          $target = $_GET['target'];
        $list = Series::byLetter($target)[1];
        $listSize = sizeof($list);
        $_SESSION['return'] = $_SERVER['QUERY_STRING']."&target=".$target;
        require_once('views/browse/seriesResults.php');
        break;
    }
  }

  public function browseByTitle()
  {
    $selectActive =false;


    $author = Author::id($authorID)[1];
    $searchByText = $author->lastName.", ".$author->firstName." ".$author->middleName;
    $list = Book::getByAuthorID($authorID)[1];
    $listSize = sizeof($list);
    require_once('views/browse/bookResults.php');
  }

  public function browseByAuthor()
  {
    $selectActive =false;
    $authorID = $_GET['id'];
    $searchBy = 'author';
    $author = Author::id($authorID)[1];
    $searchByText = $author->lastName.", ".$author->firstName." ".$author->middleName;
    $list = Book::getByAuthorID($authorID)[1];
    $listSize = sizeof($list);
    require_once('views/browse/bookResults.php');
  }

  public function browseBySeries()
  {
      $selectActive =false;
      $seriesID = $_GET['id'];
      $searchBy = 'series';
      $series = Series::getById($seriesID)[1];
      $searchByText = $series->name;
      $list = Book::getBySeriesID($seriesID)[1];
      $listSize = sizeof($list);
      require_once('views/browse/bookResults.php');
  }
}

?>
