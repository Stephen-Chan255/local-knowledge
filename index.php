
<?php
  include_once('config/db_connect.php');

  session_start();
  if (isset($_SESSION['username'])) {
    header("Location: list.php");
  }

  $username  = $password = $error = "";

  // check whether the submit button is clicked
  if (isset($_POST['submit'])) {
    $username  = $_POST['username'];
    $password  = $_POST['password'];

    // Error handlers
    // Check for empty fields
    if (empty($username) || empty($password)) {
      $error = 'All fields are required.';
    } else {

      // construct the SQL
      $sql = "SELECT username, password FROM user_web WHERE username = '$username' AND password = '$password'";

      // execute query & get the results (a set of rows)
      $result = mysqli_query($conn, $sql);

      // check account correctness
      if (mysqli_num_rows($result)) {

        mysqli_free_result($result); // free the $result from memory
        mysqli_close($conn);  // close the connection

        $_SESSION['username'] = $_POST['username'];

        header('Location: list.php');

      } else {
        $error = 'Incorrect username or password.';
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
  <?php include_once('templates/head.php'); ?>

  <body>
    <div class="container p-5 my-5 col-sm-8 col-md-6 col-lg-5">

      <h1 class="display-5 text-center mb-5">Local Knowledge</h1>

      <!-- error prompt -->
      <?php if ($error != ""): ?>
        <div class="container border border-danger rounded-lg p-2 text-center text-danger">
          <?= $error; ?>
        </div>
      <?php endif; ?>

      <!-- login form -->
      <form class="my-5 border rounded-lg px-5 py-3" method="POST">
        <div class="form-group">
          <label for="username" class="col-form-label font-weight-bold">Username</label>
          <input type="text" id="username" class="form-control" name="username" value="<?= htmlspecialchars($username) ?>">
        </div>
        <div class="form-group">
          <label for="password" class="col-form-label font-weight-bold">Password</label>
          <input type="password" id="password" class="form-control" name="password" value="<?= htmlspecialchars($password) ?>">
        </div>
        <input type="submit" class="btn btn-primary col-12 font-weight-bold my-2" name="submit" value="Sign In">
      </form>
    </div>

    <?php include_once('templates/footer.php'); ?>

  </body>
</html>
