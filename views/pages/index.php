<div>
  <div>
    <h2>Search</h2>
    <form action='?controller=search&action=search' method='post'>
      Search by <select name='searchBy'>
        <option value ='title'>Title</option>
        <option value ='author'>Author</option>
        <option value ='ISBN'>ISBN</option>
        <option value ='series'>Series</option>
      </select><br>
      <input type='text' name='searchString' placeholder='Search for...'><br>
      <input type='submit' value='Search'>
    </form>
  </div>
  <hr>
  <div>
    <h2>Browse</h2>
    <p><a href='?controller=browse&action=browse&searchBy=title&target=A&refresh=1'>Browse by Title</a></p>
    <p><a href='?controller=browse&action=browse&searchBy=author&target=A'>Browse by Author</a></p>
    <p><a href='?controller=browse&action=browse&searchBy=series&target=A'>Browse by Series</a></p>
  </div>
  <hr>
  <div>
    <h2>Administrate</h2>
    <p><a href='?controller=admin&action=addBook'>Add Book</a></p>
    <p><a href='?controller=admin&action=autoadder'>Auto Adder</a></p>
  </div>
</div>
