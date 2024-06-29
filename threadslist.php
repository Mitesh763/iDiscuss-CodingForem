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
    <!-- session_start(); -->
    <?php include 'partial/_dbconnect.php'; ?>
    <?php include 'partial/header.php'; ?>

    <?php
    
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `categories` WHERE category_id = $id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $catname = $row['category_name'];
        $catdesc = $row['category_description'];
    }

    ?>
    <?php
    $showAlert = false;
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $th_title = $_POST['title'];
        $th_desc = $_POST['desc'];
        $srno = $_POST['srno'];
        // $th_id = $_POST['thid'];
        $sql = "INSERT INTO `threads` ( `thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$th_title', '$th_desc', '$id', '$srno', current_timestamp())";
        $result = mysqli_query($conn,$sql);
        if ($result) {
            $showAlert = true;
            if ($showAlert) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong>Your problem added successfully!
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
            <h1 class="display-4">welcome to <?php echo $catname; ?> Forem</h1>
            <p class="lead"><?php echo $catdesc; ?></p>
            <hr class="my-4">
            <p>This is <?php echo $catname; ?> Forum for Sharing knoledge with each other.</p>
            <p class="lead">
                <!-- <a class="btn btn-success btn-lg " href="#" role="button">Learn more</a> -->
            </p>
        </div>
    </div>

    <?php

    if(isset($_SESSION['loggedin']) && ($_SESSION['loggedin']== true)){
         echo '<div class="container">
            <h1 class="my2">Start a Discussion </h1>

                <!-- <form action="/PHP_CWH/forum_web/threadslist.php?catid = ' . $id . '" method= "post"> -->
                <form action=" ' . $_SERVER["REQUEST_URI"] . ' " method= "post">
    <div class="form-group">
        <label for="exampleInputEmail1">Problem Title</label>
        <input type="title" class="form-control" name="title" id="title" aria-describedby="emailHelp"
            placeholder="Enter problem title">
    </div>
    <input type="hidden" name="srno" value=" ' . $_SESSION["srno"] . ' ">
    <div class="form-group">
        <label for="exampleInputPassword1">Ellaborate Your Concern</label>
        <input type="text" class="form-control" name="desc" id="desc" placeholder="Description">
    </div>
    <button type="submit" class="btn btn-success">ADD</button>
    </form>
    </div>
    </br></hr>';

    }
    else {
        echo '
        <div class="container">
        <h1 class="my2">Start a Discussion </h1>
                <h1 class="lead"><b>You are not logged-in. Please login to able to start a Discussions.</b></h1>
            </div>';
    }

    ?>

    <div class="container my-3">
        <h2>Lists of problems:</h2>
        <?php
    
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `threads` WHERE thread_cat_id = $id";
    $result = mysqli_query($conn, $sql);
    $noResult = true;
    while ($row = mysqli_fetch_assoc($result)) {
        $noResult= false;
        $id = $row['thread_id'];
        $title = $row['thread_title'];
        $desc = $row['thread_desc'];
        $thread_time = $row['timestamp'];
        $thread_user_id = $row['thread_user_id'];
        $sql2 = "SELECT user_email FROM `users1` WHERE srno=$thread_user_id";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        // $user = $row2['user_email'];
        echo '<div class="media my-3  ">
            <img class="mr-3" width="80px" height="80px" src="default_user.jpg" alt="Generic placeholder image">
            <div class="media-body">'. 
                '<h5 class="mt-0"><a class="text-dark" href= "threads.php?threadid=' . $id . '">' . $title . '</a></h5> 
                ' . $desc . '</div>'.'<p class="font-weight-bold my-0">Asked by :'. $row2['user_email'] . ' at  ' . $thread_time . '</p> </div>';

    }
    if($noResult){
        echo '<div class="jumbotron jumbotron-fluid">
                <div class="container">
                <h2 class="display-5">No Thread Found</h2>
                <p class="lead">Being a First parson to ask question</p>
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