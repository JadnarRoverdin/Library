<h2>Browsing by <?php echo $searchBy; ?></h2>
<div>
  <form action='?controller=browse&action=byLetter&searchBy=<?php echo $searchBy;?>' method='post'>
    <select name='target'>
      <?php
        $alpha = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
        foreach($alpha as $a)
        {
          if($a === $target)
            echo "<option value='$a' selected='selected'>$a</option>";
          else
            echo "<option value='$a'>$a</option>";
        }
        ?>

    </select>
    <input type='submit' value='Browse'>
  </form>

<?php
if(isset($listSize) && $listSize > 0)
{
    echo "<div class='resultsContainer'>";
    for($i = 0; $i < sizeof($list); $i++)
    {
      echo "<div class='result'>
              <strong> ".$list[$i]->title."</strong><br>

              Author(s): ";
              foreach($list[$i]->authors as $a)
              {
                echo $a->firstName." ".$a->middleName." ".$a->lastName.",";
              }
              if($list[$i]->bookNumber > 0)
                echo "<br>Book ".$list[$i]->bookNumber." of ".$list[$i]->series->name;
            echo "</div><hr>";
    }
    echo "</div>";
  }
  else
    echo "No books";
    ?>
