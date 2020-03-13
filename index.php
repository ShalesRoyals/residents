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

    <title>Residents - <?php echo 'Index'?> </title>
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
      <li class="active"><a href="index.php">Home</a></li>
          <li><a href="viewresidents.php">View Residents</a></li>
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
    require_once 'db/conn.php';

    $results = $crud->getAddresses();

?>
    

    <h1 class= "text-center">Welcome to Royals Housing System</h1>
        <!--<form method="get" action="success.php">-->

      <div class="jumbotron">
        <form method="post" action="success.php" enctype="multipart/form-data">
         <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">First Name</span>
                </div>
                <input required type="text" class="form-control" id="firstname" name="firstname">
            </div><br>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Last Name</span>
                </div>
                <input required type="text" class="form-control" id="lastname" name="lastname">
            </div><br>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Email</span>
                </div>
                <input required type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
            </div><br>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Gender</span>
                </div>
             <select class="form-control" id="gender" name="gender">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
             </select>
            </div><br>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Address</span>
                </div>
                <select class="form-control" id="address" name="address">
                    <?php while($r = $results->fetch(PDO::FETCH_ASSOC)){?>
                        <option value= "<?php echo $r['address_id']?>"><?php echo $r['name']; ?></option>
                   <?php } ?>
                </select>
            </div><br>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Number of Household Members</span>
                </div>
                <input required type="text" class="form-control" id="members" name="members">
            </div><br>
            <div class="input-group">
            <div class="input-group-prepend">
                    <span class="input-group-text">Contact Number</span>
            </div>
                <input type="text" class="form-control" id="phone" name="phone" aria-describedby="phoneHelp">
            </div>
            <br>
            <div class="custom-file">
            <input type="file" accept="image/*" class="custom-file-input" id="avatar" name="avatar" >
            <label class="custom-file-label" for="avatar"></label>
           </div>
            <button type="submit" name="submit" class="btn btn-success btn-block">Submit</button>
        </form>
     </div>
     
     
<br>
<br>
<br>
<br>
<?php require_once 'includes/footer.php'; ?>

