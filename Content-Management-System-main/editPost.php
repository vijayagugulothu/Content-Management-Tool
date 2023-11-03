<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./css/index.css" />
  <link rel="stylesheet" href="./css/createPost.css" />
  <link rel="stylesheet" href="./css/editPost.css" />
  <?php require "./includes/links.php" ?>
  <title>Edit Post</title>
</head>

<body>
  <?php
  // Include your database connection code here (db.php).
  require "./includes/db.php";

  // Check if the form is submitted
  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $PID = $_COOKIE['cms_PID'];

    // Retrieve post data for editing
    $query = 'select * from posts where PID="' . $PID . '"';
    $result = mysqli_query($con, $query);

    if (!$result) {
      echo "Could not find the post.";
    } else {
      $row = mysqli_fetch_assoc($result);
      $topic = $row["category"];
      $content = $row["content"];
      $thumbnail = $row["thumbnail"];
      $file = $row["file"];
      // You should also fetch and sanitize other necessary data if needed.
    }

    // Check if the "Save" button is clicked
    if (isset($_POST['saveBtn'])) {
      $new_topic = $_POST['postTopic'];
      $new_content = $_POST['postContent'];

      if (strlen($new_topic) > 0 && strlen($new_content) > 0) {
        try {
          // Update the post data in the database
          $query = 'update posts set category = "' . $new_topic . '", content = "' . $new_content . '", status = "Edited" where PID="' . $PID . '";';
          $execute = mysqli_query($con, $query);
        } catch (Exception $e) {
        }

        if ($execute) {
          echo "<script>alert('Post updated successfully!');</script>";
        } else {
          echo "<script>alert('Post not updated!');</script>";
        }
      }
    }

    // Check if the "Delete" button is clicked
    if (isset($_POST['deleteBtn'])) {
      // Display a confirmation dialog for post deletion
      echo '<script>
        if (confirm("Are you sure you want to delete this post?")) {
          document.cookie = "cms_delpost=y"; // Set a flag to confirm the deletion
          window.location.reload();
        }
      </script>';
    }

    // If the user confirms the deletion, proceed with deletion
    if ($_COOKIE['cms_delpost'] == 'y') {
      echo '<script> document.cookie = "cms_delpost=n"; </script>';

      try {
        // Delete the post data from the database and delete associated files
        $query = 'delete from posts where PID="' . $PID . '";';
        $execute = mysqli_query($con, $query);

        // You should also unlink the associated files like $file and $thumbnail
        unlink($file);
        unlink($thumbnail);
      } catch (Exception $e) {
      }

      if ($execute) {
        echo "<script>alert('Post deleted successfully!');</script>";
        echo "<script>window.location = 'index.php';</script>";
      } else {
        echo "<script>alert('Post not deleted!');</script>";
      }
    }
  }
  ?>

  <!-- Your HTML form for editing the post -->
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
    <input type="text" name="postTopic" id="postTopic" placeholder="Topic..." value="<?php echo $topic ?>" /> <br />
    <div id="thumbnailTitle">Thumbnail</div>
    <img src="<?php echo $thumbnail ?>" id="viewThumbnail" /> <br>

    <div id="thumbnailTitle">Image related to content</div>
    <img src="<?php echo $file ?>" alt="" id="viewImage">
    <br />
    <textarea name="postContent" id="postContent" placeholder="Write your content here..."><?php echo $content ?></textarea>
    <br />
    <button type="submit" id="saveBtn" name="saveBtn">Save</button>
    <button type="submit" id="deleteBtn" name="deleteBtn" onclick="confirmDel()">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
        <path
          d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z" />
      </svg>
    </button>
  </form>

  <!-- Include your footer -->
</body>

</html>
