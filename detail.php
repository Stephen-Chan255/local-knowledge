<?php

  include_once('config/db_connect.php');

  // check GET request id param
  if (isset($_GET['id'])) {

  	// escape sql chars to prevent from SQL injection
  	$id = mysqli_real_escape_string($conn, $_GET['id']);

  	// construct the query
  	$sql = "SELECT * FROM post WHERE id = $id";

    // execute query & get the results (a set of rows)
  	$result = mysqli_query($conn, $sql);

    // fetch the results and transfer into an array format
  	$post = mysqli_fetch_assoc($result);

    // free the $result from memory
  	mysqli_free_result($result);

    // close the connection
  	mysqli_close($conn);

  }

  // perform deletion
  if (isset($_POST['delete'])) {
  	$id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);
    $sql = "DELETE FROM post WHERE id = $id_to_delete";

  	if (mysqli_query($conn, $sql)) {
  		header('Location: list.php');
  	}
    else {
  		echo 'query error: '. mysqli_error($conn);
  	}
  }
?>

<!DOCTYPE html>
<html>

  <?php include_once('templates/header.php'); ?>

  	<div class="container">
  	  <?php if($post): ?>

        <!-- title & date -->
  		  <h4><?= $post['title']; ?></h4>
  		  <p class="text-muted"><?= date($post['creation_time']); ?></p>

        <!-- buttons: Edit, Delete, Back -->
    		<div class="container row align-items-center mb-3">
    		  <a class="btn btn-primary mr-3" href="upload.php">Edit</a>
    		  <form action="detail.php" method="POST" class="mr-3">
    		    <input type="hidden" name="id_to_delete" value="<?= $post['id']; ?>">
    		    <input type="submit" name="delete" value="Delete" class="btn btn-outline-primary">
    		  </form>
    		  <a href="list.php">Back</a>
    		</div>

        <!-- post content -->
    		<p><?= $post['content']; ?></p>

    	<?php else: ?>
    		<h5>No such post exists.</h5>
    	<?php endif ?>
    </div>

    <?php include_once('templates/footer.php'); ?>

  </body>
</html>
