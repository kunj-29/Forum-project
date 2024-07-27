<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Let`sDiscuss - Coding Forum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
    #ques{
        min-height: 433px;
    }
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
    
    <!-- 1 -->
    <div id="carouselExampleIndicators" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images/slider_2.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="images/slider_1.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="images/slider_3.jpg" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!-- /1 -->
    <!-- 2 -->
    <div class="container my-4" id="ques">
        <h2 class="text-center my-4">Let`sDiscuss - Categories</h2>
        <div class="row">

            <!-- fatch all tah categories -->
            <?php
         $sql="SELECT * FROM `categories`";
         $result = mysqli_query($conn,$sql);
         while($row = mysqli_fetch_assoc($result)){
          $id = $row['categories_id'];
          $cat = $row['categories_name'];
          $desc = $row['categories_description'];
        echo ' <div class="col-md-4 my-3">
                <div class="card" style="width: 18rem;">
                   <img src="images/card-'.$id. '.jpg"  class="card-img-top fixed-size-img" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><a href="threadlist.php?cat_id='. $id .'">'. $cat .'</a></h5>
                        <h5 class="card-title">'. substr($desc,0,90).'.....</h5>    
                        <a href="threadlist.php?cat_id='. $id .'" class="btn btn-primary">View Threads</a>
                    </div>
                </div>
               </div>';              
         }
         ?>

            <!-- /2 -->
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