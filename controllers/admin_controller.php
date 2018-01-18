<?php

Class AdminController
{
  public function addBook()
  {
    $message = "";
    $listofSeries = Series::all()[1];
    $listofAuthors = Author::all()[1];
    if(isset($_POST['title']))
    {
      $bookID = Book::create($_POST['title'], $_POST['ISBN'],$_POST['bookNumber'],$_POST['wishlist'])[1];
      $authorIDs = array();
      for($i = 0; $i < sizeof($_POST['name']); $i++)
      {
        $authorIDs[] = Author::create($_POST['name'][$i])[1];
      }
      foreach($authorIDs as $authorID)
      {
        Book::associateWithAuthor($bookID, $authorID);
      }
      if($_POST['isSeries'] == 'true')
      {
        $seriesID = Series::create($_POST['seriesName'])[1];
        Book::associateWithSeries($bookID, $seriesID);
      }
      $message = "Successfully added '".$_POST['title']."'.";
    }

    require_once('views/admin/addBook.php');
  }

  public function addAuthor()
  {
    require_once('views/admin/addAuthor.php');
  }

  public function autoadder()
  {
    if(isset($_POST['entryString']))
    {
      $lines = explode("\n", $_POST['entryString']);
      foreach($lines as $l)
      {
        $string =  preg_split("/[\t]/",$l);
        $authorName =  $string[0];
        $title = $string[1];
        $series = $string[2];
        if(sizeof($string) > 3)
          $bookNum = $string[3];
        else {
          $bookNum = 0;
        }

        $bookID = $bookID = Book::create($title, 0, $bookNum, 0)[1];
        $authorID = Author::create($authorName)[1];
        Book::associateWithAuthor($bookID, $authorID);
        if($series != "")
        {
          $seriesID = Series::create($series)[1];
          Book::associateWithSeries($bookID, $seriesID);
        }
      }
    }
    require_once('views/admin/autoadder.php');
  }

}

?>
