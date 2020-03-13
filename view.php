<?php
  include_once "includes/session.php"
?>
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

    <title>Residents - <?php echo 'View'?> </title>
  </head>
 
<style>
body {
	background-image: url("houses/bg1.jpg");
        background-repeat:no-repeat;
       background-size:cover;
} 

</style>

  
  <body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">Royals Housing</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="index.php">Home</a></li>
          <li><a href="viewresidents.php">View Residents</a></li>
          <li class="active"><a href="view.php"></a></li>
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


<?php
    require_once 'includes/auth_check.php';
    require_once 'db/conn.php';

    if(!isset($_GET['id'])){
        //echo "<h1 class='text-danger'>Please confirm that your details are correct and try again.</h1>";
        include 'includes/errormessage.php';
    }else{
        $id = $_GET['id'];
        $result =$crud->getResidentDetails($id);
    
?>

<div class="jumbotron">
<img src="<?php echo empty($result['avatar_path']) ? "uploads/download.jpg" : $result['avatar_path'] ; ?>" class="rounded-circle" style="width: 100%; height: 100%" />
    <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title"><?php  echo  $result ['firstname'] .' '. $result ['lastname'] ?> </h5>
                <h6 class="card-subtitle mb-2 text-muted"><?php echo  $result ['name'] ?></h6>
                <p class="card-text">Email Address: <?php echo  $result ['emailaddress']; ?></p>
                <p class="card-text">Gender: <?php echo  $result ['gender']; ?></p>
                <p class="card-text">Household Size: <?php echo  $result ['members']; ?></p>
                <p class="card-text">Contact Number: <?php echo  $result ['contactnumber']; ?></p>
            </div>
    </div>
    
    <br>
            <a href ="viewresidents.php" class="btn btn-info">Back to List</a>
            <a href ="edit.php?id=<?php echo $result ['resident_id'] ?>" class="btn btn-warning">Edit</a>
            <a onclick="return confirm('Are you sure you want to permanently remove this record?');" 
            href ="delete.php?id=<?php echo $result ['resident_id'] ?>" class="btn btn-danger">Delete</a>

<?php } ?>
</div>

<br>
<br>
<br>
<br>
<?php require_once 'includes/footer.php'; ?>