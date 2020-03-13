<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  

    <!--- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/site.css" />

    <title>Residents - <?php echo 'Success'?> </title>
  </head>
 
<style>
body {
	background-image: url("houses/bg1.jpg");
        background-repeat:no-repeat;
       background-size:cover;
} 

</style>


<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">Royals Housing</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="index.php">Home</a></li>
          <li><a href="viewresidents.php">View Residents</a></li>
          <li  class="active"><a href="view.php">View</a></li>
        </ul>
      </li>
    <ul class="nav navbar-nav navbar-right">
    <?php 
              if(!isset($_SESSION['userid'])){
          ?>
      <li><a class="nav-item nav-link" href="login.php">Login <span class="sr-only">(current)</span></a>
          <?php } else { ?></a></li>
      <li> <a class="nav-item nav-link" href="logout.php">Logout <span class="sr-only">(current)</span></a>
          <?php } ?></li>
    </ul>
  </div>
  </nav>
  
<div class="container">


<body>

 <?php
    require_once 'db/conn.php';
    require_once 'sendemail.php';
?>

<?php
    if(isset($_POST['submit'])){
        $fname = $_POST['firstname'];
        $lname = $_POST['lastname'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        $address = $_POST['address'];
        $members = $_POST['members'];
        $contact = $_POST['phone'];

        $orig_file = $_FILES["avatar"]["tmp_name"];
        $ext = pathinfo($_FILES["avatar"]["name"], PATHINFO_EXTENSION);
        $target_dir = 'uploads/';
        $destination = "$target_dir$contact.$ext";
        move_uploaded_file($orig_file,$destination);

        //check if insert was successful
        $isSuccess = $crud->insertResidents($fname,$lname,$email,$gender,$members,$contact,$address,$destination);
      
        $addressName= $crud->getAddressById($address);

        if($isSuccess){
            SendEmail::sendMail($email, 'Welcome to Royals Housing', 'You have succesfully rented your new home.');
           // echo '<h1 class="text-center text-success">You Have Been Registered!</h1>';
           include 'includes/successmessage.php';

   
        }
        else{
           // echo '<h1 class="text-center text-danger">There Was An Error In Processing!</h1>';
           include 'includes/errormessage.php';

        }

    }
?>
           
        <!-- Print using $_POST-->
        <div class ='jumbotron'  class="text-center">
        <div class="card bg-light mb-3" style="max-width: 18rem;">
        <img src="<?php echo $destination; ?>" class="rounded-circle" style="width: 20%; height: 20%" />
            <div class="card-body">
                <p class="card-title"><?php  echo $_POST ['firstname'] .' '. $_POST ['lastname'] ?> </p>
                <h4 class="card-subtitle mb-2 text-muted"><?php echo  $addressName ['name'] ?></h4>
                <h5 class="card-text">Email: <?php echo  $_POST ['email']; ?></h5>
                <h5 class="card-text">Gender: <?php echo  $_POST ['gender']; ?></h5>
                <h5 class="card-text">Number of Household Members: <?php echo  $_POST ['members']; ?></h5>
                <h5 class="card-text">Contact Number: <?php echo  $_POST ['phone']; ?></h5>
            </div>
         </div>
         </div>

<br>
<br>
<br>
<br>
<?php require_once 'includes/footer.php'; ?>
