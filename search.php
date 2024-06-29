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
    
    

    <!-- search result -->
    <div class="container my-3">
        <h1>Search Results for "<?php echo  $_GET['search']; ?>"</h1>

    <?php
        $noresults = true;
        $query = $_GET["search"];
        $sql = "SELECT * FROM `threads` WHERE match (thread_title,thread_desc) against('$query')";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $title = $row['thread_title'];
            $desc = $row['thread_desc'];
            $thread_id = $row['thread_id'];
            $url = "threads.php?threadid=" . $thread_id;
            $noresults = false;
    
            echo '<div class="result">
                        <h2><a class="text-dark" href="' . $url . '">' . $title . '</a></h2>
                        <p>' . $desc . '</p>
                  </div>';
        }

        if($noresults){
            echo '<div class="jumbotron jumbotron-fluid">
            <div class="container">
              <h1 class="display-4">No Result found</h1>
              <p class="lead">Suggestions:<ul> 
                   <li>Make sure that all words are spelled correctectly.</li>
                   <li>Try different keywords.</li>
                   <li>Try moregeneral keywords</li></ul>  
              </p>
            </div>
          </div>';
        }
    ?>
        
    </div>

    <!-- footer -->
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