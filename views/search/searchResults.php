<?php
echo "Searching $searchBy's for '$string' yielded ".sizeof($booklist)." results.<hr><hr>";

echo "<div class='resultsContainer'>";
for($i = 0; $i < sizeof($booklist); $i++)
{
  echo "<div class='result'>
          <strong>".$booklist[$i]->title."</strong><br>

          Author(s): ";
          foreach($booklist[$i]->authors as $a)
          {
            echo $a->name.",";
          }
          if($booklist[$i]->bookNumber > 0)
            echo "<br>Book ".$booklist[$i]->bookNumber." of ".$booklist[$i]->series->name;
        echo "</div><hr>";
}
echo "</div>";
?>
