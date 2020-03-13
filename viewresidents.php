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

    <title>Residents - <?php echo 'View Residents'?> </title>
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
          <li class="active"><a href="viewresidents.php">View Residents</a></li>
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
    require_once 'includes/auth_check.php';
    require_once 'db/conn.php';


    $results = $crud->getResidents();
?>

<?php while ($r = $results->fetch(PDO::FETCH_ASSOC)) {?>
<div class="row">
      <div class="col-lg-4">
      <div class = 'jumbotron'>
      <img src="<?php echo empty($r['avatar_path']) ? "uploads/downloads.jpg" : $r['avatar_path'] ; ?>" class="rounded-circle" style="width: 20%; height: 20%" />
        <p><?php echo $r ['resident_id'] ?></p>
        <p><?php echo $r ['firstname'] ?></p>
        <p><?php echo $r ['lastname'] ?></p>
        <p><?php echo $r ['name'] ?></p> 
        <a href ="view.php?id=<?php echo $r ['resident_id'] ?>" class="btn btn-primary">View</a>
        <a href ="edit.php?id=<?php echo $r ['resident_id'] ?>" class="btn btn-warning">Edit</a>
        <a onclick="return confirm('Are you sure you want to permanently remove this record?');" 
        href ="delete.php?id=<?php echo $r ['resident_id'] ?>" class="btn btn-danger">Delete</a>
        <br>
        </div>
      </div><!-- /.col-lg-4 -->
    <?php }?>

<br>
<br>
<br>
<br>
<?php require_once 'includes/footer.php'; ?>