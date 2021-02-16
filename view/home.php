<?php
isset($_SESSION['user']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/5c4e1169df.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="libCSS\main.css">
    <script src="libJs\main.js">
    </script>
    <title>Document</title>
</head>
<body>
    <nav>
        <ul>
        <li><a style="font-size:100%;font-family:fantasy;"><b>Doctors.lk</b></a></li>
        <li><a class="active" href="index.php"><i class="fas fa-home"></i> Home</a></li>
            <li><a href="index.php?value=list">All doctors</a></li>
            <?php
           if(!isset($_SESSION['user'])){
              $name = "";
            ?>
            <li><a onclick="show_hide_log()">Login</a></li>
            <li><a onclick="show_hide_reg()">Sign up</a></li>
            <?php
            }
            else if($_SESSION['user'] == "admin@admin.com"){
                $name = "Welcome ".$_SESSION['user'];
            ?>
            <li style="float:right;"><a href="index.php?value=profile">Profile <i class="fas fa-user"></i></a></li>
            <li><a href="index.php?value=modify">Edit</a></li>
            <li><a href="index.php?value=logout">Logout</a></li>
            <?php
            }
            else{
            $name = "Welcome ".$_SESSION['user'];
            ?>
            <li><a href="index.php?value=logout">Logout</a></li>
            <li style="float:right;"><a href="index.php?value=profile">Profile</a></li>
            <?php
            }
            ?>
        </ul>
    </nav>
<nav>
  <h3 style="color:white">
  <?php
  echo $name;
  ?>
  </h3>
</nav>
  <center class="photo">
      <img src="doctor.jpg" width=100%>
  </center>

<div style="padding: 5%">
    <center class="reg" id="reg" style="display: none;">
    <form name="register" method="POST" action="index.php" inactive>
        <input type="text" name="fname" placeholder="First name"><br>
        <input type="text" name="lname" placeholder="Last name"><br>
        <input type="email" name="email" placeholder="Email"><br>
        <input type="password" name="card" placeholder="Credit Card number"><br>
        <input type="password" name="pwd" placeholder="Password"><br>
        <input type="password" name="rpwd" placeholder="Re-type password"><br>
        <input type="button" name="value" value="Register" onClick="register1()">
    </form>
    </center>
    <center class="reg" id="log" style="display: none;">
    <form name="login"  action="index.php" method="POST">
    <input type="email" name="email" placeholder="username">
    <input type="password" name="pass" placeholder="Password">
    <input type="button" name="value" value="Login" onClick="login1()">
    </form>
    </center>
</div>
<footer class="footer">
<p>Telephone number : 0094 7714283670</p>
<p>Email : bookdoctorslk@gmail.com</p>
</footer>
</body>
</html>