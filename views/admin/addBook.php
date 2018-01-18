<script src="js/bookAdderManager.js"></script>
<h2>Add a Book</h2>
<div><?php echo $message; ?></div>
<form method='post' action='?controller=admin&action=addBook'>
  <h3>Book</h3>

  <input type='text' placeholder='Title' name='title' autofocus>
  <input type='hidden' placeholder='ISBN#' name='ISBN' value='0'>
  <h3>Author</h3>
  Number of Authors: <input type='number' id = 'numOfAuthor' value='1' oninput='changenumofAuthor(event)'>
  <div id='authorNames'>
  <input type='text' placeholder='Last, First M.I.'   name='name[]'>
  </div>
  <h3>Series</h3>
  Part of a series?<br>
  Yes: <input type='radio' name='isSeries'  value='true'   oninput='toggleDiv("seriesEntry", event)' >
  No: <input type='radio'   name='isSeries'   value='false'   oninput='toggleDiv("seriesEntry", event)'checked>
  <div id="seriesEntry">
    <input list="series" placeholder='Series Name' name='seriesName'>
    <input type="number" name='bookNumber'>
  </div>
  <hr>
  <input type='submit' value='Submit'>
  <datalist id='series'>
    <?php foreach($listofSeries as $l)echo "<option value='$l->name'>";?>
  </datalist>

</form>
