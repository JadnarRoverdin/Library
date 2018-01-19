<script src="js/bookAdderManager.js"></script>
<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>">Back</a>
<h2>Add a Book</h2>
<div><?php echo $message; ?></div>
<form method='post' action='?controller=admin&action=addBook'>
  <h3>Book</h3>

  <input type='text' placeholder='Title' name='title' autofocus>
  <input type='hidden' placeholder='ISBN#' name='ISBN' value='0'>
  <hr>
  <h3>Author(s)</h3>
  Number of Authors: <input type='number' id = 'numOfAuthor' value='1' oninput='changenumofAuthor(event)'>
  <div id='authorNames'>
  <input type='text' list='authors' placeholder='Last, First M.I.'   name='name[]'>
  </div>
  <hr>
  <h3>Series</h3>
  Part of a series?<br>
  Yes: <input type='radio' name='isSeries'  value='true'   oninput='toggleDiv("seriesEntry", event)' >
  No: <input type='radio'   name='isSeries'   value='false'   oninput='toggleDiv("seriesEntry", event)'checked>
  <div id="seriesEntry">
    <input list="series" placeholder='Series Name' name='seriesName'>
    <input type="number" name='bookNumber'>
  </div>
  <hr>
  <div> Add to Wishlist?<br> Yes: <input type='radio' name='wishlist' value='1'> No: <input type='radio' name='wishlist' value='0'>
    <hr>
  <input type='submit' value='Submit'>
  <datalist id='series'>
    <?php foreach($listofSeries as $l)echo "<option value='$l->name'>";?>
  </datalist>
  <datalist id='authors'>
    <?php foreach($listofAuthors as $a)echo "<option value='$a->name'>";?>
  </datalist>

</form>
