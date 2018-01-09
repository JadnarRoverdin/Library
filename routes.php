<?php

  require_once("models/author.php");
  require_once("models/book.php");
  require_once("models/series.php");

  function call ($controller, $action)
  {
    require_once("controllers/".$controller."_controller.php");

    switch ($controller)
    {
      case 'pages':
        $controller = new PagesController();
        break;
      case 'admin':
        $controller = new AdminController();
        break;
      case 'search':
        $controller = new SearchController();
        break;
    }
    $controller->{$action}();
  }

  $controllers = array (  'pages'     => ['home', 'index'],
                          'admin'     => ['addBook', 'addAuthor'],
                          'search'    => ['search']);

  if(array_key_exists($controller, $controllers))
    if(in_array($action, $controllers[$controller]))
      call($controller, $action);
    else
      call('pages', 'error');
  else
    call('pages', 'error');

?>
