<?php 
session_start();

echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container-fluid my-1">
  <a class="navbar-brand" href="/Forum">Let`sDiscuss</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="/Forum">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about.php">About</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Top  Categories
        </a>
        <div class="dropdown-menu" aria-labelledby="navbardropdown"
        <a class="dropdown-item" > </a>';
        $sql = "SELECT categories_name , categories_id FROM `categories` LIMIT 4";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
          echo '<a class="dropdown-item" href="threadlist.php?cat_id=' . $row['categories_id']. '">' .$row['categories_name'] . '</a>';
        }
     echo ' </div>
     </li>
     <li class="nav-item">
        <a class="nav-link" href="contact.php">Contact</a>
      </li>
    </ul> 
    </div class="row mx-2">';

    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']=true){
        echo ' <form class="form-inline my-2 my-lg-0" mathod="get" action="search.php" style="display:flex;">
        <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-success my-2 my-sm-0 " type="submit">Search</button>
        <p class="text-light" style="margin:5px 30px;">welcome'. $_SESSION['userEmail'] .' </p>
        <a href="partials/_logout.php" <button class="btn btn-outline-success ml-2">Logout</button></a>
        </form>';
      }
    else{

    
    echo '<form class="d-flex" role="search">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-success" type="submit">Search</button>
          </form>
      </div>
              <div class="mx-2 login-signup" style="display:flex; gap:10px;">  

              <button class="btn btn-outline-success" data-bs-toggle="modal"data-bs-target="#loginModal" data-bs-toggle="modal" data-bs-target="#loginModal" style="width:120px">Login</button>
              <button class="btn btn-outline-success" data-bs-toggle="modal"data-bs-target="#signupModal" data-bs-toggle="modal" data-bs-target="#signupModal" style="width:120px">Sign Up</button>';  
        } 
   echo '</div>
    </div>
  </div>
</nav>';

include 'partials/_loginmodal.php';
include 'partials/_signupmodal.php';
//var_dump($_GET);
if(isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == 'true'){
    echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
            <strong>success!</strong> You can now login
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';;
}
?>