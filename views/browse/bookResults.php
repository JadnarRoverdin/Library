
<h2>Browsing <?php echo $searchByText; ?></h2>
<div>
  <form action='?controller=browse&action=browse&searchBy=<?php echo $searchBy;?>' method='post'>
    <?php if(isset($_SESSION['return']))
            {
              echo "<a href='?".$_SESSION['return']."'>Back</a>";
              unset($_SESSION['return']);
            }
    if($selectActive)
    {
      ?>
    <select name='target' class='letterselect' oninput='document.forms[0].submit()'>
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
  <?php }?>
  </form>

<?php
if(isset($listSize) && $listSize > 0)
{
    for($i = 0; $i < sizeof($list); $i++)
    {
      echo "<div class='bookresult'>
              <strong>".$list[$i]->title."</strong><hr>

              Author(s): ";
              foreach($list[$i]->authors as $a)
              {
                echo $a->firstName." ".$a->middleName." ".$a->lastName.",";
              }
              if($list[$i]->bookNumber > 0)
                echo "<br>Book ".$list[$i]->bookNumber." of ".$list[$i]->series->name;
            echo "</div>";
    }
  }
  else
    echo "No books";
    ?>
