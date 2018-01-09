<?php
echo "Searching $searchBy's for '$string' yielded ".sizeof($booklist)." results.<hr><hr>";

echo "<div class='resultsContainer'>";
for($i = 0; $i < sizeof($booklist); $i++)
{
  echo $booklist;
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
?>
