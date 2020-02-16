<?php

  include_once('config/db_connect.php');

  $category = $title = $content = $location = '';
  $errors = array('category' => '', 'title' => '', 'content' => '', 'location' => '');

  // check whether the submit button is clicked
  if (isset($_POST['submit'])) {

    // escape sql chars to prevent from SQL injection
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);

    // check for empty fields
    if ($category == "Choose a category" ) {
      $errors['category'] = 'Please select a cateogry.';
    } elseif (empty($title)) {
      $errors['title'] = 'Please enter the title.';
    } elseif (empty($content)) {
      $errors['content'] = 'Please enter the content.';
    } elseif (empty($location)) {
      $errors['location'] = 'Please enter the location.';
    } else {

      // construct the query
      $sql = "INSERT INTO post(category, title, content, location) VALUES('$category','$title','$content','$location')";

      // save to DB and check
      if (mysqli_query($conn, $sql)) {
        // success
        header('Location: list.php');
      } else {
        echo 'query error: '. mysqli_error($conn);
      }
    }

  } elseif (isset($_POST['cancle'])) {
    header('Location: list.php');
  }
 ?>

<!DOCTYPE html>
<html lang="en">

  <?php include_once('templates/header.php'); ?>

    <!-- error prompt -->
    <?php if (array_filter($errors)): ?>
      <div class="container border border-danger rounded-lg p-2 mb-3 text-center text-danger col-sm-3">
        <?= $errors['category'] . $errors['title'] . $errors['content'] . $errors['location']; ?>
      </div>
    <?php endif; ?>

    <!-- from body -->
    <form class="container rounded-lg px-5 py-3 mb-5 shadow-lg" method="POST">

      <div class="form-group row">
        <label for="category" class="col-sm-3 col-md-2 col-form-label">Category</label>
        <select id="category" class="form-control col-sm-3" name="category">
          <option disabled>Choose a category</option>
          <option>Entertainment</option>
          <option>Food & Drinks</option>
          <option>Natural Scenery</option>
        </select>
      </div>

      <div class="form-group row">
        <label for="title" class="col-sm-3 col-md-2 col-form-label">Title</label>
        <input type="text" id="title" class="form-control col-sm" name="title" value="<?= htmlspecialchars($title) ?>" >
      </div>

      <div class="form-group row">
        <label for="content" class="col-sm-3 col-md-2 col-form-label">Content</label>
        <textarea id= "content" name="content"> <?= htmlspecialchars($content) ?> </textarea>
      </div>

      <div class="form-group row">
        <label for="location" class="col-sm-3 col-md-2 col-form-label">Location</label>
        <input type="text" id="location" class="form-control col-sm" name="location" value="<?= htmlspecialchars($location) ?>" >
      </div>

      <div class="form-group row mx-0 mt-2 mb-0 justify-content-center p-2 pb-0">
        <input type="submit" class="btn btn-primary col-sm-2 m-2 m-md-0 mr-md-2" name="submit" value="Submit">
        <input type="submit" class="btn btn-outline-secondary col-sm-2 m-2 m-md-0 ml-md-2" name="cancle" value="Cancle">
      </div>
    </form>

    <?php include_once('templates/footer.php'); ?>

    <script src="https://cdn.ckeditor.com/4.11.4/standard/ckeditor.js"></script>
  	<script>
  		CKEDITOR.replace('content');
  	</script>

  </body>
</html>
