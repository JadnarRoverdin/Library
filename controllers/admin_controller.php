<?php

Class AdminController
{
  public function addBook()
  {
    // require_once("vendor/name-parser-master/src/Parser.php");
    // $parser = new Parser();
    // $name = $parser->parse($_GET['name'][0]);
    $message = "";

    echo $name->getFirstname();


    $listofSeries = Series::all()[1];
    if(isset($_POST['title']))
    {
      $bookID = Book::create($_POST['title'], $_POST['ISBN'],$_POST['bookNumber'])[1];
      $authorIDs = array();
      for($i = 0; $i < sizeof($_POST['firstName']); $i++)
      {
        $authorIDs[] = Author::create($_POST['firstName'][$i],$_POST['middleName'][$i],$_POST['lastName'][$i])[1];
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

}

?>
