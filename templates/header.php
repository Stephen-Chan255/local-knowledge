
<?php
  session_start();
  $username = $_SESSION['username'];

  if (isset($_POST['submit'])) {
    session_start();
    session_unset();
    session_destroy();
    header("Location: index.php");
  }
?>

  <!-- HTML content -->
  <?php include('templates/head.php'); ?>
  <body>
    <header class="container-fluid row align-items-center px-4 py-3 mx-0 mb-5 border-bottom shadow-sm">
        <a class="mr-auto text-decoration-none text-muted" href="index.php">
          <h4>Local knowledge</h4>
        </a>
        <p class="lead mr-3 my-0">Welcome, <?= htmlspecialchars($username); ?></p>

        <form class="from-group" method="post">
            <button class="btn btn-outline-primary" type="submit" name="submit">Sign Out</button>
        </form>
    </header>
