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
    </form><br>
    <a href='?controller=admin&action=addBook'>Add Book</a>
  </div>
</div>
