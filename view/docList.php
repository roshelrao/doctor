<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="libCSS\main.css">
    <script src="https://kit.fontawesome.com/5c4e1169df.js" crossorigin="anonymous"></script>
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
            <li style="float:right;"><a href="index.php?value=profile">Profile <i class="fas fa-user"></i></a></li>
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
  <button class="search" type="button" id="searchButton" onclick="search()">Search <i class="fas fa-search"></i></button>
  <input class="search" type="text" name="search" id="search">
  </h3>
</nav>
<center>
<table style="z-index: 1; color: white; position: absolute; margin-top:10%;">
<?php
$obj = new clinic();
$list = $obj-> doctorList();
$search = $obj->SETsearch();

if(!isset($_SESSION['search'])){
    $arr = $list; 
}
else{
    $arr = $search;
    unset($_SESSION['search']);
}
// print_r($arr);
for($i=0; $i<sizeof($arr); $i++){
// echo $arr[$i][0];
?>
<tr>
<td width=200 height=150><img src="banner3.jpg" width=150 height=100></td>
<td style="width:100%; height: 250px; text-align:center"><b>Dr.<?php echo $arr[$i][0]." ".$arr[$i][1] ?> <br>
<i><?php echo $arr[$i][2] ?></i>
<p>Fee Rs: <?php echo $arr[$i][3] ?></p>
<p><?php echo "from :".$arr[$i][6]." to :".$arr[$i][7]." on ".$arr[$i][5]."'s"; ?></p>
<?php
if(!isset($_SESSION['user'])){
?>

    <button onclick="poplogin()">Book an appointment</button>
 
<?php    
}
else
{
?>

<button name="Book" value="<?php echo $arr[$i][4]; ?>" onclick="bookDoc(<?php echo $arr[$i][4].','.$_SESSION['id']?>,'<?php echo $arr[$i][5] ?>')">Book an appointment</button></td>
<?php    
}
?>


</tr>
<?php
}
?>
</table>
</center>

<div style="padding: 5%">
    <center class="reg" id="reg" style="display: none;">
    <form name="register" method="POST" action="index.php" inactive>
        <input type="text" name="fname" placeholder="First name"><br>
        <input type="text" name="lname" placeholder="Last name"><br>
        <input type="email" name="email" placeholder="Email"><br>
        <input type="number" name="card" placeholder="Credit Card number"><br>
        <input type="password" name="pwd" placeholder="Password"><br>
        <input type="password" name="rpwd" placeholder="Re-type password"><br>
        <input type="button" name="value" value="register" onClick="register1()">
    </form>
    </center>
    <center class="reg" id="log" style="display: none;">
    <form name="login"  action="index.php" method="post">
    <input type="email" name="email" placeholder="username">
    <input type="password" name="pass" placeholder="Passowrd">
    <input type="button" name="value" value="login" onClick="login1()">
    </form>
    </center>
</div>
</body>
</html>