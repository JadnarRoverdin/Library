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
    echo "Searching $searchBy's for '$string' yielded ".sizeof($booklist)." results.<hr><hr>";

    echo "<div class='resultsContainer'>";
    for($i = 0; $i < sizeof($booklist); $i++)
    {
      echo "<div class='result'>
              Title: ".$booklist[$i]->title."<br>
              ISBN: ".$booklist[$i]->ISBN."<br>
              Author(s): ";
              foreach($booklist[$i]->authors as $a)
              {
                echo $a->firstName." ".$a->middleName." ".$a->lastName.",";
              }
              if($booklist[$i]->bookNumber > 0)
                echo "<br>Book ".$booklist[$i]->bookNumber." of ".$booklist[$i]->series->name;
            echo "</div><hr>";
    }
    echo "</div>";
  }
}

?>
