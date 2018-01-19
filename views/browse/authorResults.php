<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>">Back</a>
<h2>Browsing by <?php echo $searchBy; ?></h2>
<div>
  <form action='?controller=browse&action=browse&searchBy=author' method='post'>
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
  </form>

<?php
if(isset($listSize) && $listSize > 0)
{

    for($i = 0; $i < sizeof($list); $i++)
    {
      echo "<div class='result'>";
      echo "<a href='?controller=browse&action=browseByAuthor&id=".$list[$i]->id."'>".$list[$i]->name."</a>";
      echo "</div>";
    }

  }
  else
    echo "No Authors";
    ?>
  </div>
