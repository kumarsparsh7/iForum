<?php
session_start();

function csrf_token()
{
  $token = bin2hex(random_bytes(32));
  $_SESSION['token'] = $token;
  return $token;
}

echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container-fluid">
  <a class="navbar-brand" href="/forum">iDiscuss</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="/forum">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about.php">About</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Categories
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          <li><a class="dropdown-item" href="#">Action</a></li>
          <li><a class="dropdown-item" href="#">Another action</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="#">Something else here</a></li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="contact.php">Contact</a>
      </li>
    </ul>';
    
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']== true)
    {
      echo '<form class="form-inline d-inline-flex my-lg-0">
      <input class="form-control mr-sm-2 my-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-success mx-2 my-2" type="submit">Search</button>
      <p class="text-light my-2 mx-2">Welcome, '.$_SESSION['useremail'].'</p>
      <a href="partials/_logout.php" class="btn btn-outline-success ml-2 my-2">Logout</a>
      </form>';
    }
    else
    {
      echo '<form class="form-inline my-lg-0">
      <input class="form-control mr-sm-2 py-2" type="search" placeholder="Search" aria-label="Search">
      </form>

      <button class="btn btn-success mx-2 my-2" type="submit">Search</button>
      <button class="btn btn-outline-success ml-2" data-toggle="modal" data-target="#loginModal">Login</button>
      <button class="btn btn-outline-success mx-2" data-toggle="modal" data-target="#signupModal">SignUp</button>';
    }
    
echo '</div>
</nav>';

if(!empty($_GET['error']))
{
  echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert my-0">
  <strong>Failed!</strong> '. $_GET['error'] .'
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}

include 'partials/_loginModal.php';
include 'partials/_signupModal.php';
if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="true")
{
  echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert my-0">
  <strong>Success!</strong> You can now login.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}

// Add else condition to show the error received in URL
?>