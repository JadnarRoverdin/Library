<?php
echo "Searching $searchBy's for '$string' yielded ".sizeof($booklist)." results.<hr><hr>";

echo "<div class='resultsContainer'>";
for($i = 0; $i < sizeof($booklist); $i++)
{
  $wishlist ="";
  if($booklist[$i]->wishlist = "1")
    $wishlist ="wishlist";
  echo "<div class='result ".$wishlist."'>
          <a href='?controller=pages&action=viewbook&bookID=".$booklist[$i]->id."'><strong>".$booklist[$i]->title."</strong></a><br>

          Author(s): ";
          $authors = $booklist[$i]->authors;
          for($j=0; $j < sizeof($authors); $j++)
          {
            echo $authors[$j]->name;
            if($j < sizeof($authors)-1)
              echo "; ";
          }
          if($booklist[$i]->bookNumber > 0)
            echo "<br>Book ".$booklist[$i]->bookNumber." of ".$booklist[$i]->series->name;
        echo "</div><hr>";
}
echo "</div>";
?>
