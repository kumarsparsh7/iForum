<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>iDiscuss - Thread</title>
  </head>
  <body>
    <?php include 'partials/_header.php';?>
    <?php include 'partials/_dbconnect.php';?>
    <?php
      $id = $_GET['threadid'];
      $sql = "SELECT * FROM `threads` WHERE thread_id=$id";
      $result = mysqli_query($conn,$sql);
      while($row = mysqli_fetch_assoc($result))
      {
        $title = $row['thread_title'];
        $desc = $row['thread_desc'];
      }
    ?>

    <?php
        $showAlert = false;
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == 'POST')
        {
          // Insert comment into DB - XSS Vulnerable
          $comment = $_POST['comment'];

          // Insert comment into DB - XSS Proof
          $comment = strip_tags($_POST['comment']);

          $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_time`, `comment_by`) VALUES ('$comment', '$id', current_timestamp(), '0');";
          
          $result = mysqli_query($conn,$sql);
          $showAlert = true;
          if($showAlert)
          {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Your comment has been added.<button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
          }
        }
    ?>

    <div class="container my-3">
    <!-- Jumbotron used here   -->
        <div class="jumbotron">
            <h1 class="display-4"><?php echo $title; ?></h1>
            <p class="lead">
            <?php echo $desc; ?>
            </p>
            <hr class="my-4">
            <p>This is a peer-to-peer forum for sharing knowledge with each other. No Spam / Advertising / Self-promote in the forums. Do not post copyright-infringing material. Do not post “offensive” posts, links or images. Do not cross post questions. Do not PM users asking for help.
Remain respectful of other members at all times.</p>
            <p>Posted by : <b>Sparsh</b></p>
        </div>
    </div>



    <?php 
  if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true)
  {
    echo 
    '<div class="container">
    <h1 class="py-2">Post a Comment</h1>
    <form action="'
    .$_SERVER['REQUEST_URI'].
    '".$id method="POST">
<div class="form-group my-2">
  <label for="exampleFormControlTextarea1">Type your comment.</label>
  <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
</div>
<button type="submit" class="btn btn-success mb-3">Post</button>
</form>
  </div>'
  ;}
  else
  {
    echo 
    '<div class="container">
    <h1 class="py-2">Login to post a Comment</h1>
    <form>
<div class="form-group my-2">
  <label for="exampleFormControlTextarea1">Type your comment.</label>
  <textarea class="form-control" id="comment" name="comment" rows="3" disabled></textarea>
</div>
<button type="submit" class="btn btn-secondary mb-3 mt-1" disabled>Post</button>
</form>
  </div>'
    ;
  }
?>


    

    <div class="container mb-5" id="ques">
        <h1 class="py-2">Discussions</h1>
          <?php
            $id = $_GET['threadid'];
            $sql = "SELECT * FROM `comments` WHERE thread_id=$id";
            $result = mysqli_query($conn,$sql);
            $noResult = true;
            while($row = mysqli_fetch_assoc($result))
            {
              $noResult = false;
              $id = $row['comment_id'];
              $content = $row['comment_content'];
              $comment_time = $row['comment_time'];
              echo '<div class="media d-flex my-3">
              <img src="profile_img.jpg" width="50px" class="mr-3" alt="...">
              <div class="media-body">
              <p class="my-0"><b>Anonymous User</b> <em>at '.$comment_time.'</em></p>
                '.$content.'
              </div>
            </div>';
            }
            if($noResult)
            {
              echo 
              '<div class="jumbotron jumbotron-fluid">
              <div class="container mb-5">
                <p class="display-4">No results found</p>
                <p class="lead">Be the first one to ask the question.</p>
              </div>
            </div>';
            }
          ?>

    </div>

    <?php include 'partials/_footer.php';?>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> -->

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
  </body>
</html>