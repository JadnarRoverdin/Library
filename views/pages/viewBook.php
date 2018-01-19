
<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>">Back</a>
<h2> Viewing: '<?php echo $book->title;?>' </h2>
<div class='bookAdmin'><a href='?controller=admin&action=editBook&id=<?php echo $book->id;?>'>Edit</a></div>

<div class='bookDetails'>
  <div class='bookAuthor'>
    <h3>Authors</h3>
    <?php
      foreach($book->authors as $a)
      echo "<a href='?controller=browse&action=browseByAuthor&id=".$a->id."'>".$a->name."</a><br>";
    ?>
    </div>
  <?php
  if($book->bookNumber > 0)
  {
    echo "<div class='bookSeries'><h3>Series</h3>";
    echo "Book ".$book->bookNumber." of<a href='?controller=browse&action=browseBySeries&id=".$book->series->id."'>'".$book->series->name."'.</a>";
    echo "</div>";
  }
  if($book->wishlist == '1')
  {
    echo "<div class='bookOther'>This book is in your wishlist</div>";
  }
?>
</div>
