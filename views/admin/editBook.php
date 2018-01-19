<script src="js/bookAdderManager.js"></script>
<h2>Edit a Book</h2>
<div><?php if(isset($message))echo $message; ?></div>
<form method='post' action='?controller=admin&action=editBook&id=<?php echo $book->id;?>'>
  <h3>Book Title</h3>

  <input type='hidden' name='bookID' value='<?php echo $book->id?>'>
  <input type='text' placeholder='Title' name='title' value="<?php echo $book->title;?>">
  <input type='hidden' placeholder='ISBN#' name='ISBN' value='value='<?php echo $book->ISBN?>''>
  <hr>
  <h3>Author(s)</h3>
  Number of Authors: <input type='number' list='authors' id = 'numOfAuthor' value='<?php echo sizeof($book->authors);?>' oninput='changenumofAuthor(event)'>
  <div id='currentAuthorNames'>
    <p>Check all authors you wish to remove from this book</p>
    <?php
    foreach($book->authors as $a)
    {
      echo "<input type='checkbox' name='remove[]' value='$a->id'> ".$a->name."<br>";
    }
    ?>
  </div>
  <p>Add Authors</p>
  <div id='authorNames'>
    <input type='text' list='authors' placeholder='Last, First M.I.'   name='authname[]'>

  </div>
  <hr>
  <h3>Series</h3>
  Part of a series?<br>
    Yes: <input type='radio' name='isSeries'  value='true'   oninput='toggleDiv("seriesEntry", event)' <?php if($isSeries) echo "checked";?> >
    No: <input type='radio'   name='isSeries'   value='false'   oninput='toggleDiv("seriesEntry", event)' <?php if(!$isSeries) echo "checked";?> >
    <div id="seriesEntry">
      <input list="series" placeholder='Series Name' name='seriesName' value='<?php if($isSeries)echo $book->series->name;?>'>
      <input type='hidden' name='seriesID' value ="<?php if($isSeries) echo $book->series->id; else echo '0';?>">
      <input type="number" name='bookNumber' value='<?php if($isSeries) echo $book->bookNumber;?>'>
    </div>
  <hr>
  <div> Add to Wishlist?<br> Yes: <input type='radio' name='wishlist' value='1'  <?php if($book->wishlist == '1') echo 'checked';?>> No: <input type='radio' name='wishlist' value='0' <?php if($book->wishlist == '0') echo 'checked';?>>
<hr>  <br><input type='submit' value='Submit'>
</form>

<datalist id='authors'>
  <?php
  foreach($authors as $a)
  {
    echo "<option value='$a->name'>";
  }
  ?>
</datalist>

<datalist id='series'>
  <?php
  foreach($series as $s)
  {
    echo "<option value='$s->name'>";
  }
  ?>
</datalist>
