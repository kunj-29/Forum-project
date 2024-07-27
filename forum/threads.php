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
    
    $id=$_GET['threadid'];
    $sql="SELECT * FROM `threads` WHERE thread_id='$id'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);
    
    // while($row = mysqli_fetch_assoc($result)){
    //     $title = $row['thread_title'];
    //     $desc = $row['thread_desc'];
    //     $thread_user_id = $row['thread_user_id'];
    //     $sql2 = "SELECT user_email FROM `users` WHERE sno='$thread_user_id'";
    //     $result2 = mysqli_query($conn,$sql2);
    //     $row2 = mysqli_fetch_assoc($result2);
    //     $posted_by = $row2['user_email'];
    // }


    while ($row = mysqli_fetch_assoc($result)) {
        $title = $row['thread_title'];
        $desc = $row['thread_desc'];
        $thread_user_id = $row['thread_user_id'];
        
        // Query to fetch user_email from users table
        $sql2 = "SELECT user_email FROM `users` WHERE sno='$thread_user_id'";
        $result2 = mysqli_query($conn, $sql2);
        
        if ($result2) {
            // Fetch the user_email if query was successful
            $row2 = mysqli_fetch_assoc($result2);
            $posted_by = $row2['user_email'];
        } else {
            // Handle query failure or no results (optional)
            $posted_by = "Unknown"; // Example fallback value
        }
        
        // Use $posted_by in your output or further processing
    }

    $sql = "SELECT t.thread_title, t.thread_desc, u.user_email 
        FROM threads t 
        JOIN users u ON t.thread_user_id = u.sno";

$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    $title = $row['thread_title'];
    $desc = $row['thread_desc'];
    $posted_by = $row['user_email'];
    
    // Use $title, $desc, $posted_by in your output or further processing
}

    ?>

    <?php
    $showalert=false;
    $method =$_SERVER['REQUEST_METHOD'];
    if($method == 'POST'){
          // insert into comment db
          $comment=$_POST['comment'];
          $comment = str_replace("<" , "<&lt;>" , $comment);
          $comment = str_replace(">" , "<&gt;>" , $comment);
          $sno=$_POST['sno'];
          $sql="INSERT INTO `comments` ( `comment_content`, `thread_id`, `comment_by`, `comment_time`) 
                 VALUES ('$comment', '$id', '$sno', current_timestamp())";
          $result = mysqli_query($conn,$sql);
          $showalert=true;
          if($showalert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                       <strong>Success!</strong> Your comment has been added ! 
                       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
          }
    }
    ?>
    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4"><?php echo $title;?> forum</h1>
            <p class="lead"> <?php echo $desc; ?></P>
            <hr class="my-4">
            <p> This forum is sharing a knowladge </p>
            <p>posted:<em><?php echo $posted_by;?></em></p>
        </div>
    </div>

    <?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']=true){
            echo '<div class="container">
                    <h1 class="py-2 ">Post a Comment</h1>
                    <form action="'.$_SERVER['REQUEST_URI'].'" .$id method="post">
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Type your Comment</label>
                            <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                             <input type="hidden" name="sno" value="'.$_SESSION['sno'].'">
                        </div>
                        <button type="submit" class="btn btn-success">Post Comment</button>
                    </form>
                  </div>';
    }
else{
       echo '<div class="container">
                     <h1 class="py-2 ">Post a Comment</h1>
                    <p class="lead"> you are not logged in. please login to able to start a Post Comment. </p>
            </div>';
}

?>


    <div class="container mb-5" id="#ques">
        <h1 class="py-2">Discussion </h1>
        <?php
    $id=$_GET['threadid'];
    $sql="SELECT * FROM `comments` WHERE thread_id='$id'";
    $result = mysqli_query($conn,$sql);
    $noResult = true;
    while($row = mysqli_fetch_assoc($result)){
        $noResult = false;
        $id = $row['comment_id'];
        $content = $row['comment_content'];
        $comment_time = $row['comment_time'];
        $thread_user_id = $row['comment_by'];
        $sql2 = "SELECT user_email FROM `users` WHERE sno='$thread_user_id'";
        $result2 = mysqli_query($conn,$sql2);
        $row2 = mysqli_fetch_assoc($result2);
          
   
       echo '<div class="d-flex my-3">
            <div class="flex-shrink-0">
                <img src="images/media.jpg" width="54px" class="mr-3" alt="...">
            </div>
            <div class="flex-grow-1 ms-3">
             <p class="fw-bold my-0">'. $row2['user_email'] . ' at '.$comment_time.'</p> 
                '.$content.'
            </div>
        </div>
    </div>';

     }

     if($noResult)
     {
        echo '<div class="jumbotron jumbotron-fluid">
                 <div class="containre">
                    <p class="display-4">No comments Found</p>
                    <p class="lead"> Be the first person to comment</p>
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