<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iDiscuss - Coding Forum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
    #maincontainer{
        min-height: 100vh;
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

   
  
 <!-- search result -->
    <div class="container my-3" id="maincontainer">
        <h1 class="py-2"> Search Results for <em>"<?php echo $_GET['search']?>"</em></h1>
        <?php
            $noresults = true;
            $query= $_GET['search'];
            $sql="SELECT * FROM threads WHERE MATCH (thread_title, thread_desc) against ('$query')";
            $result = mysqli_query($conn,$sql);
            while($row = mysqli_fetch_assoc($result)){
                $title = $row['thread_title'];
                $desc = $row['thread_desc'];
                $thread_id = $row['thread_id'];
                $url = "threads.php?threadid=".$thread_id;
                $noresults = false;

            //display the results
            echo ' <div class="result">
                        <h3><a href ="'.$url.'" class="text-dark"> '.$title.'</a></h3>
                        <p>'.$desc.'</p>
                    </div>';
            } 
            if($noresults){
                echo '<div class="jumbotron jumbotron-fluid">
                          <div class="containre">
                             <p class="display-4">No Results Found</p>
                             <p class="lead"><b>Suggestion :</b> <ul>
                                             <li>Make sure that all words are spelled correctly.</li>
                                             <li>Try different keywords.</li>
                                             <li>Try more general keywords.</li></ul>  
                             </p>
                          </div>
                         </div>';
            }
        ?>
   
</div>
            
            <?php include 'partials/_footer.php'; ?>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
                crossorigin="anonymous"></script>
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