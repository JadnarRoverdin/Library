<header>
  <a href='index.php' class='title' >Library</a>
</header>

  <body>
      <?php
          if(isset($_GET['controller']) && isset($_GET['action']))
          {
            $controller = $_GET['controller'];
            $action     = $_GET['action'];
          }
          else
          {
            $controller = 'pages';
            $action     = 'index';
          }
          require_once('routes.php');
      ?>
</body>

<footer>
</footer>
