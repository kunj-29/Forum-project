<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iDiscuss - Coding Forum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
    #ques {
        min-height: 433px;
    }
    </style>
    <style>
    .fixed-size-img {
        width: 17.9rem;
        height: 12rem;
        object-fit: cover;
    }

    .slide img {
        height: 50vh;
        object-fit: cover;
    }
    </style>
</head>

<body>
    <?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_header.php'; ?>
    
    <?php
    $id=$_GET['cat_id'];
    $sql="SELECT * FROM `categories` WHERE categories_id=$id";
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_assoc($result)){
        $catname = $row['categories_name'];
        $catdesc = $row['categories_description'];
    }
    ?>

    <?php
    $showalert=false;
    $method =$_SERVER['REQUEST_METHOD'];
    if($method == 'POST'){
          // insert into thread db
          $th_title=$_POST['title'];
          $th_desc=$_POST['desc'];

          $th_title = str_replace("<" , "<&lt;>" , $th_title);
          $th_title = str_replace(">" , "<&gt;>" , $th_title);

          $th_desc = str_replace("<" , "<&lt;>" , $th_desc);
          $th_desc = str_replace(">" , "<&gt;>" , $th_desc);

          $sno=$_POST['sno'];
          $sql="INSERT INTO `threads` ( `thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) 
                VALUES ( '$th_title', '$th_desc', '$id', '$sno', current_timestamp())";
          $result = mysqli_query($conn,$sql);
          $showalert=true;
          if($showalert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                       <strong>Success!</strong> Your Thread has been added ! Please wait for community to respond.
                       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
          }
    }
    ?>

    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4">welcome to <?php echo $catname; ?> forum</h1>
            <p class="lead"> <?php echo $catdesc; ?></P>
            <hr class="my-4">
            <p>A forum project is a thread that encourages metagame-specific contribution either from the wider userbase or from a small group of people for the benefit of the wider userbase.
            </p>
            <!-- <a class="btn btn-success btn-lg my-4" href="#" role="button">learn more</a> -->
        </div>
    </div>

    <?php
  
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']=true){
    echo   '<div class="container">
                <h1 class="py-2 ">Start a Discussion </h1>
                <form action="'.$_SERVER["REQUEST_URI"].'" .$id method="post">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Problem Title</label>
                        <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">keep your title as sort and crisp as possible</div>
                    </div>
                     <input type="hidden" name="sno" value="'.$_SESSION['sno'].'">
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Ellaborate your concern</label>
                        <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>';
      }
    else{
           echo '<div class="container">
                         <h1 class="py-2 ">Start a Discussion </h1>
                        <p class="lead"> you are not logged in. please login to able to start a Discussion. </p>
                </div>';
    }

    ?>
    

    <div class="container mb-5" id="#ques">
        <h1 class="py-2 ">Browse  Question </h1>
        <?php
    $id=$_GET['cat_id'];
    $sql="SELECT * FROM `threads` WHERE thread_cat_id=$id";
    $result = mysqli_query($conn,$sql);
    $noResult = true; 
    while($row = mysqli_fetch_assoc($result)){
        $noResult = false;
        $id = $row['thread_id'];
        $title = $row['thread_title'];
        $desc = $row['thread_desc'];
        $thread_time = $row['timestamp'];
        $thread_user_id = $row['thread_user_id'];
        $sno = $row['thread_id'];
        $sql2 = "SELECT user_email FROM `users` WHERE sno='$thread_user_id'";
        $result2 = mysqli_query($conn,$sql2);
        $row2 = mysqli_fetch_assoc($result2);
       

       echo '<div class="d-flex my-3">
            <div class="flex-shrink-0">
                <img src="images/media.jpg" width="54px" class="mr-3" alt="...">
            </div>
            <div class="flex-grow-1 ms-3">'.
                '<h5 class="mt-0"><a class="text-dark" href="threads.php?threadid='.$sno.'">'. $title .'</a></h5>
                '.$desc.' </div>'.' <p class="fw-bold my-0">Ask by : '.$row2['user_email'] .' at '.$thread_time.'</p>
        </div>
    </div>';

     }
     if($noResult)
     {
        echo '<div class="jumbotron jumbotron-fluid">
                 <div class="containre">
                    <p class="display-4">No Threads Found</p>
                    <p class="lead"> Be the first person to ask question</p>
                 </div>
             </div>';
     }
     ?>


        <!-- /2 -->
        <?php include 'partials/_footer.php'; ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
        <script>
        async function fetch_image() {
            const accessKey = 'Yzb4Ks_SXJI44detguKsalcjrhU6SHZuemkAomMO4AE';
            const url = "https://api.unsplash.com/photos/random";

            try {
                const response = await fetch(url, {
                    headers: {
                        'Authorization': Client - ID $ {
                            accessKey
                        }
                    }
                });
                const data = await response.json();
                return data.urls.regular;
            } catch (error) {
                console.error('Error fetching the random image:', error);
                return null;
            }
        }

        async function update_images() {
            const images = document.querySelectorAll("img");
            for (const img of images) {
                const imageUrl = await fetch_image();
                if (imageUrl) {
                    img.src = imageUrl;
                }
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            update_images();
        });
        </script>
</body>

</html>