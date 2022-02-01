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
      $id = $_GET['catid'];
      $sql = "SELECT * FROM `categories` WHERE category_id=$id";
      $result = mysqli_query($conn,$sql);
      while($row = mysqli_fetch_assoc($result))
      {
        $catname = $row['category_name'];
        $catdesc = $row['category_description'];
      }
    ?>
    <!-- Put page content here -->
      <?php
        $showAlert = false;
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == 'POST')
        {
          // Insert thread into DB
          $th_title = $_POST['title'];
          $th_desc = $_POST['desc'];

          $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$th_title', '$th_desc', '$id', '0', current_timestamp());";
          
          $result = mysqli_query($conn,$sql);
          $showAlert = true;
          if($showAlert)
          {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Your thread has been added. Please wait for community to respond.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
          }
        }
      ?>

<!-- Category container starts here -->
    <div class="container my-3">
    <!-- Jumbotron used here   -->
        <div class="jumbotron">
            <h1 class="display-4">Welcome to <?php echo $catname; ?> forums</h1>
            <p class="lead">
            <?php echo $catdesc; ?>
            </p>
            <hr class="my-4">
            <p>This is a peer-to-peer forum for sharing knowledge with each other. No Spam / Advertising / Self-promote in the forums. Do not post copyright-infringing material. Do not post “offensive” posts, links or images. Do not cross post questions. Do not PM users asking for help.
Remain respectful of other members at all times.</p>
            <!-- <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a> -->
        </div>
    </div>





  <?php
  if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true)
  {
    echo 
    '<div class="container">
    <h1 class="py-2">Start a Discussion</h1>
    <form action="'
    .$_SERVER["REQUEST_URI"].
    '".$id method="POST">
    <div class="form-group my-2">
      <label for="exampleInputEmail1">Thread Title</label>
      <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
      <small id="emailHelp" class="form-text text-muted">Keep your title short and crisp.</small>
    </div>
    <div class="form-group my-2">
      <label for="exampleFormControlTextarea1">Elaborate your concern.</label>
      <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
    </div>
    <button type="submit" class="btn btn-success mb-3 mt-1">Submit</button>
    </form>
  </div>'
  ;
}
  else
  {
    echo 
    '
          <div class="container">
          <h1 class="py-2">Login to start a Discussion</h1>
          <form>
          <div class="form-group my-2">
            <label for="exampleInputEmail1">Thread Title</label>
            <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp" disabled>
            <small id="emailHelp" class="form-text text-muted">Login to enable fields.</small>
          </div>
          <div class="form-group my-2">
            <label for="exampleFormControlTextarea1">Elaborate your concern.</label>
            <textarea class="form-control" id="desc" name="desc" rows="3" disabled></textarea>
          </div>
            <button type="submit" class="btn btn-secondary mb-3 mt-1 disabled">Submit</button>
          </form>
        </div>'
        ;
  }
?>



    <div class="container mb-5" id="ques">
        <h1 class="py-2">Browse Questions</h1>
          <?php
            $id = $_GET['catid'];
            $sql = "SELECT * FROM `threads` WHERE thread_cat_id=$id";
            $result = mysqli_query($conn,$sql);
            $noResult = true;
            while($row = mysqli_fetch_assoc($result))
            {
              $noResult = false;
              $id = $row['thread_id'];
              $title = $row['thread_title'];
              $desc = $row['thread_desc'];
              $thread_time = $row['timestamp'];
              echo '<div class="media my-2 d-flex">
              <img src="profile_img.jpg" width="50px" height="50px" class="mr-3" alt="...">
              <div class="media-body">
                <h5 class="my-0 py-0"><a class="text-dark" href="thread.php?threadid='.$id.'">'.$title.'</a></h5>
                <p class="mb-1"><b>Anonymous User</b> <em>at '.$thread_time.'</em></p>
                '.$desc.'
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