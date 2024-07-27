<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="contactus.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body>
    <?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_header.php'; ?>

    <?php
       $showalert=false;
       $method =$_SERVER['REQUEST_METHOD'];
       if($method == 'POST')
       {
           $name = $_POST['name'];
           $email = $_POST['email'];
           $message = $_POST['message'];
           $sql = "INSERT INTO `contactus` (`name`, `email`, `message`,`time`) VALUES ('$name', '$email', '$message',current_timestamp())";
           $result = mysqli_query($conn,$sql);
          
           if($result){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                       <strong>Success!</strong> Your message has been submit ! 
                       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
           }
        }
       ?>

    <header>
        <h1>Contact Us</h1>
    </header>
    <section>
        <h2>Send us your query</h2>
        <form action="#" method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="message">Message:</label>
            <textarea id="message" name="message" rows="4" required></textarea>
            <button type="submit">Submit</button>
        </form>
    </section>


    <!-- <?php
   
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
                   <p class="hello"> you are not logged in. please login to able to contact. </p>
           </div>';
}

?> -->


    <?php include 'partials/_footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>