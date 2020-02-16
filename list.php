<?php

  include_once('config/db_connect.php');

  // fetch data from database
  $sql = "SELECT id, title, img, content, creation_time FROM post ORDER BY creation_time DESC"; // construct the query
  $result = mysqli_query($conn, $sql);  // execute query & get the results (a set of rows)
  $posts = mysqli_fetch_all($result, MYSQLI_ASSOC); // fetch the results and transfer into an array format

  mysqli_free_result($result); // free the $result from memory
  mysqli_close($conn);  // close connection

?>

<!DOCTYPE html>
<html lang="en">

  <?php include_once('templates/header.php'); ?>

    <div class="container">
      <div class="d-flex justify-content-end my-2">
        <p class="text-muted my-auto mr-3"><?= count($posts)?> posts in total</p>
        <a class="btn btn-success text-decoration-none text-write " href="upload.php">+ Post</a>
      </div>

      <!-- post list -->
      <div class="row">
        <?php foreach($posts as $post): ?>
          <a class="col-md-6 col-lg-4 my-3 text-decoration-none text-reset" href="detail.php?id=<?= $post['id'] ?>" >
            <div class="card">
              <img src=<?= $post['img']; ?> class="card-img-top">
              <div class="card-body">
                <h3 class="card-title text-center"><?= htmlspecialchars($post['title']); ?></h3>
                <p class="card-text text-muted"><?= htmlspecialchars($post['content']); ?></p>
              </div>
              <div class="card-footer d-flex justify-content-between">
                <small class="text-muted"><?= htmlspecialchars($post['creation_time']); ?></small>
                <small class="text-muted">comment:18</small>
              </div>
            </div>
          </a>
        <?php endforeach; ?>
      </div>
    </div>

    <?php include_once('templates/footer.php'); ?>

  </body>
</html>
