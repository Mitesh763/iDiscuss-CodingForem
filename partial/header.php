<?php

    // session_start();
    echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">iDiscuss-Forum</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
   
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.php">About</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Top-Categories
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">';

          $sql = "SELECT category_name,category_id FROM `categories` LIMIT 3";
          $result  = mysqli_query($conn,$sql);
          while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['category_id'];
            echo '<a class="dropdown-item" href="threadslist.php?catid=' . $id . '">' . $row['category_name'] . ' </a>';
          }
            
          echo '</div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contect.php" tabindex="-1">Contect-us</a>
        </li>
      </ul>';

      
      if(isset($_SESSION['loggedin']) && ($_SESSION['loggedin']== true)){
        echo '<form class="form-inline my-2 my-lg-0" method="get" action="search.php">
                <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
                <a class="btn btn-outline-success ml-2" href="partial/_logout.php">Logout</a>
                <p class="text-light my-0 mx-2 ">Welcome ' . $_SESSION['useremail'] . ' </p>
              </form>';
      }
      else{
      echo '<form class="form-inline my-2 my-lg-0" method="get" action="search.php">
              <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
            </form>
            <div class="mx-2">
                <a class="btn btn-outline-success ml-2" href="_login.php">Log-in</a>
                <a class="btn btn-outline-success ml-2" href="_signup.php">Signup</a>
            </div>';
      }
      
    echo '</div>
          </nav>';

          // include_once 'partial/_loginmodal.php';
          // echo "included login file";
          // include_once 'partial/_signupmodal.php';
          // echo "included signup file";


if(isset($_GET['sucsign']) && ($_GET['sucsign'] == "true")){
  echo '<div class="alert alert-success alert-dismissible my-0 fade show" role="alert">
        <strong>Success!</strong>Sign-up successfully!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
}

if(isset($_GET['successlogin']) && ($_GET['successlogin'] == "true")){
  echo '<div class="alert alert-success alert-dismissible my-0 fade show" role="alert">
        <strong>Success!</strong>log-in successfully!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
}

if(isset($_GET['successlogin']) && ($_GET['successlogin'] == "false")){
  echo '<div class="alert alert-danger alert-dismissible my-0 fade show" role="alert">
        <strong>Oops!! </strong>Not Log-in Invalid Credentials        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
}


if(isset($_GET['sucsign']) && ($_GET['sucsign'] == "false")){
  echo '<div class="alert alert-danger alert-dismissible my-0 fade show" role="alert">
        <strong>Oops!! </strong>Not Sign-up Invalid Credentials        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
}

?>