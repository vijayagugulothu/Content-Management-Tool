<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./css/index.css" />
    <link rel="stylesheet" href="./css/createPost.css" />
    <?php require "./includes/links.php" ?>
    <title>Post</title>
</head>
<body>
    <!-- Include the necessary scripts -->
    <script src="./js/navBtn.js"></script>
    <script src="./js/feedback.js"></script>
    <script src="./js/createPost.js"></script>

    <!-- Include your navigation bar -->
    <?php require "./includes/nav.php" ?>

    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Include your database connection code here (db.php).
        require "./includes/db.php";

        $topic = $_POST['postTopic'];
        $postContent = $_POST['postContent'];

        // Validate and sanitize user inputs if necessary.
        // ...

        // Handle file uploads for thumbnail and image.
        $thumbnail_store = ""; // Set this to the correct path.
        $file_store = ""; // Set this to the correct path.

        $thumbnail_tmp_name = $_FILES['thumbnail']['tmp_name'];
        $file_tmp_name = $_FILES['file']['tmp_name'];

        if (move_uploaded_file($thumbnail_tmp_name, $thumbnail_store) && move_uploaded_file($file_tmp_name, $file_store)) {
            // Get other data needed for the post.
            $PID = "PID" . date("YmdHis") . substr(microtime(), 2, 3);
            $currentDate = date('l, F j, Y');
            $currentTime = date('H:i');
            $email = $_COOKIE['cms_username'];

            // Include your code for querying the user's name based on their email.
            $name = ""; // Fetch the user's name from the database.

            // Insert the post data into the database using prepared statements.
            $query = "INSERT INTO posts (PID, email, name, topic, postDate, postTime, thumbnail, file, postContent, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($con, $query);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, 'ssssssssss', $PID, $email, $name, $topic, $currentDate, $currentTime, $thumbnail_store, $file_store, $postContent, 'Posted');
                $execute = mysqli_stmt_execute($stmt);

                if ($execute) {
                    echo "<script>alert('Post uploaded successfully!');</script>";
                } else {
                    echo "<script>alert('Post not uploaded!');</script>";
                }

                mysqli_stmt_close($stmt);
            } else {
                echo "<script>alert('Failed to prepare the statement.');</script>";
            }
        } else {
            echo "<script>alert('File uploads failed!');</script>";
        }
    }
    ?>

    <!-- Your HTML form -->
    <div id="createPostTitle">Create Post</div>
    <div id="createPostContainer">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
            <!-- Input fields, file inputs, and submit button -->
            <input type="text" id="postTopic" placeholder="Topic..." name="postTopic" /><br />
            <br />
            <div id="thumbnailTitle">Thumbnail</div>
            <input type="file" id="thumbnail" accept="image/*" name="thumbnail" /><br />
            <br />
            <div id="imgVideoTitle">Upload Image related to content</div>
            <input type="file" id="acceptImgVideo" accept="image/*" name="file" /><br />
            <br />
            <br />
            <textarea id="postContent" placeholder="Write your content here..." name="postContent"></textarea><br />
            <br />
            <button type="submit" id="saveBtn" name="saveBtn">Post</button>
        </form>
    </div>

    <!-- Include your footer -->
    <?php require "./includes/footer.php" ?>
</body>
</html>
