<header class="container-fluid">
  <a href='index.php'><h1>Library</h1></a>
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
