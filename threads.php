<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>iDiscuss - Coding Forum</title>
</head>

<body>
    <?php include 'partial/_dbconnect.php'; ?>
    <?php include 'partial/header.php'; ?>

    <?php

    $id = $_GET['threadid'];
    $sql = "SELECT * FROM `threads` WHERE thread_id = $id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $title = $row['thread_title'];
        $desc = $row['thread_desc'];
        $commentedby = $row['thread_user_id'];
        $sql2 = "SELECT user_email FROM `users1` WHERE srno=$commentedby";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        $posted_by = $row2['user_email'];
    }
    ?>

    <?php
    $showAlert = false;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $comment = $_POST['comment'];
        $srno = $_POST['srno'];
        // $th_desc = $_POST['desc'];
        // $th_id = $_POST['thid'];
        $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$comment', '$id', '$srno', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $showAlert = true;
            if ($showAlert) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong>Your comment added successfully!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
            }
        }
    }
    ?>

    <div class="container my-3">
        <div class="jumbotron">
            <h1 class="display-4"><?php echo $title; ?></h1>
            <p class="lead"><?php echo $desc; ?></p>
            <hr class="my-4">
            <p class="lead"><b>Posted by : <?php echo $posted_by; ?></b></p>
        </div>
    </div>

    <?php
    if (isset($_SESSION['loggedin']) && ($_SESSION['loggedin'] == true)) {
        echo '<div class="container">
         <h1 class="my2">Post a Comment</h1>
         <form action=" ' . $_SERVER["REQUEST_URI"] . ' " method="post">
             <div class="form-group">
                 <label for="exampleInputPassword1">Type of comment</label>
                 <input type="text" class="form-control" name="comment" id="commentz" placeholder="Description">
                 <input type="hidden" name="srno" value=" ' . $_SESSION["srno"] . ' ">
             </div>
             <button type="submit" class="btn btn-success">Post Comment</button>
         </form>
     </div>';
    } else {
        echo '
        <div class="container"> 
        <h1 class="my2">Post a Comment</h1>
                <h1 class="lead"><b>You are not logged-in. Please login to able to start Comments.</b></h1>
            </div>';
    }
    ?>

    <div class="container mt-5">
        <h1 class="my2">Comments</h1>

        <?php
        $id = $_GET['threadid'];
        $sql = "SELECT * FROM `comments` WHERE thread_id = $id";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['comment_id'];
            $content = $row['comment_content'];
            $comment_time = $row['comment_time'];
            $comment_id = $row['comment_by'];
            $sql2 = "SELECT user_email FROM `users1` WHERE srno=$comment_id";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);


            echo '<div class="media my-3  ">
            <img class="mr-3" width="80px" height="80px" src="default_user.jpg" alt="Generic placeholder image">
            <div class="media-body">
                  <h5 class="mt-0"><a class="text-dark" href= "thread.php"><b>Commented by: </b>' . $row2['user_email'] . ' at ' . $comment_time . '</a></h5> 
                ' . $content . '
            </div>
        </div>';
        }
        ?>

        <?php include 'partial/footer.php'; ?>
        
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
        </script>
</body>

</html>