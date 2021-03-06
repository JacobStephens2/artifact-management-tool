<?php if(!isset($page_title)) { $page_title = 'Artifacts'; } ?>

<!DOCTYPE html>

<html lang="en">
  <head>
    
    <title>Artifacts - <?php echo h($page_title); ?></title>
    <meta charset="utf-8">
    <link rel="shortcut icon" type="image/jpg" href="<?php echo url_for('images/favicon.ico') ?>">
    <link rel="stylesheet" media="all" href="../../stylesheets/style.css" />
    <link href="https://fonts.googleapis.com/css2?family=Raleway&display=swap" rel="stylesheet">
    <?php 
      if($page_title == 'Create Use') {
        echo '<script src="' . url_for('/js/public.js') . '"></script>';
      }
    ?>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-VW7XFDFLF9"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-VW7XFDFLF9');
    </script>
  </head>

  <body>
    <header>
      <a class="header-link" href="/index.php">Artifact Management Tool</a>
    </header>

    <nav>
      <?php
        $username = $_SESSION['username'] ?? '';
        $_SESSION['user_group'] = $_SESSION['user_group'] ?? '';
          if($_SESSION['user_group'] == 2) {
            echo '<span>Admin: ' . $username . '</span>';
          } elseif($_SESSION['user_group'] == 1) {
            echo '<span>User: ' . $username . '</span>';
          }
          echo '<span><a href="' . url_for('index.php') . '">Menu</a></span>';
          echo '<span><a href="' . url_for('logout.php') . '">Logout</a></span>';
      ?>
    </nav>

    <?php echo display_session_message(); ?>
