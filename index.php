<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Library</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <!-- <link rel="stylesheet"  type="text/css" href="css/bootstrap.css"> -->
    <link rel="stylesheet"  type="text/css" href="css/basestyle.css">
    <link rel="stylesheet"  type="text/css" href="css/input.css">
  </head>

  <?php
      ini_set('display_errors', 1);
      ini_set('display_startup_errors',1);
      error_reporting(E_ALL);

      require_once('connection.php');
      require_once('views/layout.php');
  ?>

</html>
